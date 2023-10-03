<template>
    <div>
        <div class="container py-5 h-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-10 col-xl-8">
                    <div class="card bg-dark text-white" style="border-radius: 1.5rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2">Let's get to know each other!</h2>
                                <p class="text-white-50 mb-5">Tell us about yourself.</p>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <input type="text" v-model="firstName" :class="'form-control text-center ' + validateInput('firstName')" placeholder="First name"/>
                                        <label class="form-label">First Name</label>
                                    </div>

                                    <div class="col-6">
                                        <input type="text" v-model="lastName" :class="'form-control text-center ' + validateInput('lastName')" placeholder="Last name"/>
                                        <label class="form-label">Last Name</label>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <input type="email" v-model="email" :class="'form-control text-center ' + validateInput('email')" placeholder="Email address (used to login later)"/>
                                        <label class="form-label">Email address</label>
                                    </div>

                                    <div class="col-6">
                                        <input type="text" v-model="phone" class="form-control text-center" placeholder="Phone number"/>
                                        <label class="form-label">Phone Number</label>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <input type="text" v-model="username" :class="'form-control text-center ' + validateInput('username')" placeholder="Username"/>
                                        <label class="form-label">Username</label>
                                    </div>

                                    <div class="col-6">
                                        <input type="password" v-model="password" :class="'form-control text-center ' + validateInput('password')" placeholder="Password"/>
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-6">
                                        <SelectComponent route="countries" v-model="country" additionalClasses="text-center"/>
                                        <label class="form-label">Country</label>
                                    </div>

                                    <div class="col-6">
                                        <SelectComponent route="cities" v-model="city" :blocked="!country" :additionalParams="getCityParams"/>
                                        <label class="form-label">City</label> <small v-if="!country">Please select your country first</small>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <textarea v-model="bio" class="form-control text-center" placeholder="Tell other users something about yourself!"></textarea>
                                    <label class="form-label">Bio</label>
                                </div>

                                <div>
                                    <div class="col form-outline mb-4">
                                        <label class="form-label">Have verification code? Use it here!</label>
                                        <font-awesome-icon class="ms-2" icon="fa-solid fa-question"
                                            @mouseenter="showVerificationTooltip = true"
                                            @mouseleave="showVerificationTooltip = false"/>

                                        <div v-if="showVerificationTooltip" class="mb-3">
                                            Verification codes are given to you by your hosts, to prove that you are a real Erasmus student.<br>
                                            Don't have one? Don't worry! You can still use most of the features of the application.
                                        </div>
                                        <input type="text" v-model="verification_code" class="form-control text-center" placeholder="Verification code "/>
                                    </div>
                                </div>

                                <button-component :setClass="'btn btn-lg px-5 mt-2 ' + buttonClass" @clicked="register()"
                                    :loading="loading" :disabled="isFormValid">Register</button-component>
                            </div>

                            <div>
                                <p>Already have an account? <router-link class="text-white-50 fw-bold"
                                    :to="{ name: 'login' }">Login!</router-link></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'
import SelectComponent from '@/components/utils/SelectComponent.vue'
import ButtonComponent from '@/components/nav/ButtonComponent.vue'

export default {
    components: {
        SelectComponent,
        ButtonComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            firstName: null,
            lastName: null,
            username: null,
            email: null,
            phone: null,
            password: null,
            country: null,
            city: null,

            bio: null,
            verification_code: null,

            showVerificationTooltip: false,

            loading: false,

            required: [
                'firstName',
                'lastName',
                'username',
                'email',
                'password',
            ]
        }
    },

    watch: {
        //
    },
    computed: {
        getCityParams: function () {
            return {
                'filter[country_uuid]': this.country ? this.country.uuid : null,
            };
        },
        isFormValid: function () {
            if (
                !this.firstName ||
                !this.lastName ||
                !this.username ||
                !this.email ||
                !this.password
            ) {
                return false;
            }

            return true;
        },
        buttonClass: function () {
            if (!this.isFormValid) {
                return "btn-outline-warning";
            }

            return "btn-outline-success";
        },
    },

    methods: {
        register: function () {
            this.loading = true;

            this.$api
                .post('auth/register', {
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'username': this.username,
                    'email': this.email,
                    'phone': this.phone,
                    'password': this.password,
                    'country_uuid': this.country ? this.country.uuid : null,
                    'city_uuid': this.city ? this.city.uuid : null,
                    'bio': this.bio,
                    'verification_code': this.verification_code,
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.data));
                    localStorage.setItem('role', response.data.data.type)

                    showSwal(this, 3, 'Hello!', null, 1500)
                        .then(() => {
                            window.location.replace('/');
                        });
                })
                .catch((error) => {
                    if (error.response) {
                        if (error.response.status == 422 || error.response.status == 400) {
                            showSwal(this, 1, 'Not all fields were correctly filled', error.response.data.message);
                        }
                    }
                    else {
                        showSwal(this, 1, 'An error occurred');
                    }
                })
                .finally(() => {
                    this.loading = false;
                })
        },

        validateInput: function (model) {
            if (this.required.includes(model) && !this[model]) {
                return 'border border-4 border-warning';
            }

            return '';
        }
    },

    mounted() {
        //
    },
}
</script>

<style>

</style>