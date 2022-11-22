<template>
    <div>
        <div class="container row justify-content-center row-cols-1 row-cols-md-1 g-4">
            <div class="card mb-2 bg-secondary text-white" v-for="country in countries">
                <img :src="country.flag_url" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title fs-3">{{ country.name }}</h5>
                    <p class="card-text fs-5">{{ country.description }}</p>
                    <router-link class='btn btn-dark' :to="{name: 'countries-show', params: {uuid: country.uuid}}">Country page</router-link>
                </div>
            </div>
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
            countries: [],
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadCountries: function () {
            this.$api
                .index('countries')
                .then((response) => {
                    this.countries = response.data.data;
                })
        }
    },

    mounted() {
        this.loadCountries();
    },
}
</script>

<style scoped>
.card {
    flex-direction: row;
    align-items: center;
}

.card-title {
    font-weight: bold;
    font-size:x-large;
}

.card img {
    width: 25%;
    height: 75%;
}
</style>
