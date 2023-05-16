<template>
    <div>
        <div class="container py-5 h-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1.5rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2">erasmou</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                <div class="mb-4">
                                    <input type="email" v-model="email" class="form-control form-control-lg" />
                                    <label class="form-label">Email</label>
                                </div>

                                <div>
                                    <input type="password" v-model="password" class="form-control form-control-lg" />
                                    <label class="form-label">Password</label>
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                <button-component :setClass="'btn btn-lg px-5 ' + buttonClass" @clicked="login()"
                                    :loading="loading">Login</button-component>
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

        <div id="login_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-body text-center">
                        <h1 class="display-4">Hello</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'
import ButtonComponent from '@/components/nav/ButtonComponent.vue';
import { Modal } from "bootstrap";

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

            modalRef: null,
        }
    },

    watch: {
        //
    },
    computed: {
        buttonClass: function () {
            if (!this.email || !this.password) {
                return "btn-outline-warning"
            }

            return "btn-outline-success"
        }
    },

    methods: {
        login: function () {
            let self = this;

            this.loading = true;

            this.$api
            .post('auth/login', {
                    'email': this.email,
                    'password': this.password,
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                    localStorage.setItem('role', response.data.user.type);

                    this.loading = false;

                    this.modalRef.show();
                    setTimeout(function() {
                        self.modalRef.hide()

                        window.location.replace('/');
                    }, 1000);
                })
                .catch((error) => {
                    showSwal(this, 1, 'Login failed :(');
                })
        },
    },

    mounted() {
        this.modalRef = new Modal('#login_modal', {})
    },
}
</script>

<style scoped>
</style>