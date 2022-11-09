<template>
    <div>
        <div class="container row justify-content-center row-cols-1 row-cols-md-1 g-4">
            <div class="card mb-2 bg-secondary" v-for="country in countries">
                <img :src="country.flag_url" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title">{{ country.name }}</h5>
                    <p class="card-text">{{ country.description }}</p>
                    <a href="#" class="btn btn-dark">Country page</a>
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
    height: 90%;
}
</style>
