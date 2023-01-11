<template>
    <div>
        <div class="container mt-4" style="max-width: 50%">
            <form>
                <div class="form-outline mb-4">
                    <label class="form-label">Email address</label>
                    <input type="email" v-model="email" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" v-model="password" class="form-control" />
                </div>

                <button type="button" class="btn btn-primary btn-block mb-4" @click="login()">Sign in</button>

                <div class="text-center">
                    <p>Don't have an account yet? <router-link :to="{name: 'register'}">Register!</router-link></p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'

export default {
    components: {
        //
    },
    props: [
        //
    ],

    data() {
        return {
            email: null,
            password: null,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        login: function () {
            this.$api
                .post('auth/login', {
                    'email': this.email,
                    'password': this.password,
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                    localStorage.setItem('role', response.data.user.type)

                    window.location.replace('/');
                })
                .catch((error) => {
                    showSwal(this, 1, 'Login failed :(');
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