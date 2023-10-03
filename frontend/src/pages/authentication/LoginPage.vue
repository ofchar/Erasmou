<template>
    <div>
        <div class="container py-5 h-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1.5rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2">Welcome back!</h2>
                                <p class="text-white-50 mb-5">Please fill your credentials.</p>

                                <div class="mb-4">
                                    <input type="email" v-model="email" class="form-control form-control-lg text-center" placeholder="Email"/>
                                    <label class="form-label">Email</label>
                                </div>

                                <div>
                                    <input type="password" v-model="password" class="form-control form-control-lg text-center" placeholder="Password"/>
                                    <label class="form-label">Password</label>
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                <button-component :setClass="'btn btn-lg px-5 ' + buttonClass" @clicked="login()"
                                    :loading="loading" :disabled="!isFormValid">Login</button-component>
                            </div>

                            <div>
                                <p>Don't have an account yet? <router-link class="text-white-50 fw-bold"
                                    :to="{ name: 'register' }">Register!</router-link></p>
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
import ButtonComponent from '@/components/nav/ButtonComponent.vue';

export default {
    components: {
        ButtonComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            email: null,
            password: null,

            loading: false,
        }
    },

    watch: {
        //
    },
    computed: {
        isFormValid: function () {
            if (
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
        }
    },

    methods: {
        login: function () {
            this.loading = true;

            this.$api
                .post('auth/login', {
                    'email': this.email,
                    'password': this.password,
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                    localStorage.setItem('role', response.data.user.type);

                    showSwal(this, 3, 'Hello!', null, 1500)
                        .then(() => {
                            window.location.replace('/');
                        });
                })
                .catch((error) => {
                    showSwal(this, 1, 'Login failed :(', 'Your credentials do not match.');
                })
                .finally(() => {
                    this.loading = false;
                })
        },
    },

    mounted() {
        //
    },
}
</script>

<style scoped>
</style>