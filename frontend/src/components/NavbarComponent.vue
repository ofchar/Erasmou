<template>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-md">
            <a class="navbar-brand" href="/">Erasmou</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ps-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class='nav-link' to="/countries">Countries</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class='nav-link' to="/cities">Cities</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class='nav-link' to="/universities">Universities</router-link>
                    </li>
                </ul>

                <div class="text-white">
                    <div v-if="isLogged">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ user.username }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li> -->
                                <!-- <li><hr class="dropdown-divider"></li> -->
                                <li><a class="dropdown-item" @click="logOut()">Log out</a></li>
                            </ul>
                        </li>
                    </div>
                    <div v-else>
                        <router-link class='nav-link' to="/login">login</router-link>
                    </div>
                </div>

            </div>
        </div>
    </nav>
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
            user: null,
            isLogged: false,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        logOut: function () {
            this.$api
                .post('auth/logout', {})
                .then((response) => {
                    localStorage.removeItem('user');
                    localStorage.removeItem('role');

                    window.location.replace('/');
                });
        }
    },

    mounted() {
        let user = localStorage.getItem('user');

        if (user) {
            this.user = JSON.parse(user);
            this.isLogged = true;
        }
        else {
            this.user = null;
            this.isLogged = false;
        }
    },
}
</script>

<style lang="">

</style>