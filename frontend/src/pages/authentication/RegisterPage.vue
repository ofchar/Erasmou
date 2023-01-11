<template>
    <div>
        <div class="container mt-4">
            <form>
                <div class="row">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label">First name</label>
                            <input type="text" v-model="first_name" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Last name</label>
                            <input type="text" v-model="last_name" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" v-model="username" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Country</label>
                            <SelectComponent route="countries" v-model="country"/>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label">Email address</label>
                            <input type="email" v-model="email" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" v-model="phone" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" v-model="password" class="form-control" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">City</label>
                            <SelectComponent route="cities" v-model="city" :blocked="!country" :additionalParams="getCityParams"/>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col form-outline mb-4">
                        <label class="form-label">Bio</label>
                        <textarea v-model="bio" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col form-outline mb-4">
                        <label class="form-label">Have verification code? Use it here!</label>
                        <font-awesome-icon class="ms-2" icon="fa-solid fa-question"
                            @mouseenter="showVerificationTooltip = true"
                            @mouseleave="showVerificationTooltip = false"/>

                        <div v-if="showVerificationTooltip">
                            Verification codes are given to you by your hosts, to prove that you are a real Erasmus student.<br>
                            Don't have one? Don't worry! You can still use most of the features of the application.
                        </div>
                        <input type="text" v-model="verification_code" class="form-control"/>
                    </div>
                </div>

                <button type="button" class="btn btn-primary btn-block mb-4" @click="register()">Register</button>
            </form>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'
import SelectComponent from '@/components/utils/SelectComponent.vue'

export default {
    components: {
        SelectComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            first_name: null,
            last_name: null,
            username: null,
            email: null,
            phone: null,
            password: null,
            country: null,
            city: null,

            bio: null,
            verification_code: null,

            showVerificationTooltip: false,
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
        }
    },

    methods: {
        register: function () {
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

                    window.location.replace('/');
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
        },
    },

    mounted() {
        //
    },
}
</script>

<style>

</style>