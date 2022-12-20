<template>
    <div>
        <div class="container mt-5" style="max-width: 60%; margin-top: 5rem !important;">
            <form>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label">Email address</label>
                    <input type="email" v-model="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" v-model="password" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                    </div>

                    <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="button" class="btn btn-primary btn-block mb-4" @click="login()">Sign in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
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
        },
    },

    mounted() {
        //
    },
}
</script>

<style>

</style>