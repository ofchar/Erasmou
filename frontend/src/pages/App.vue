<template>
    <div class="my-app">
        <NavbarComponent />

        <div class="container app-content">
            <router-view />
        </div>

        <FooterComponent />
    </div>
</template>

<script>
import FooterComponent from '@/components/FooterComponent.vue';
import NavbarComponent from '@/components/NavbarComponent.vue'

export default {
    name: 'App',
    components: {
    NavbarComponent,
    FooterComponent
},

    mounted () {
        this.$api
            .get('/sanctum/csrf-cookie')
    }
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 80px;
    margin-bottom:70px;
    overflow:auto;
}

html {
    background-color: #cccccd;
}
</style>

<style scoped>
* {
    background-color: #cccccd;
}
</style>
