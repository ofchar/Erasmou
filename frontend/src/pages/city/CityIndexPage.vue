<template>
    <div>
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-1">
            <div class="col" v-for="city in cities" v-if="cities">
                <div class="card h-100 bg-secondary text-white"
                    @mouseenter="city.isHovering = true"
                    @mouseleave="city.isHovering = false">
                    <div class="card-body">
                        <h4 class="card-title">{{ city.name }}</h4>
                        <p class="card-text text-start">{{ city.description }}</p>
                        <div class="container justify-content-start m-2 mt-4">
                            <div class="row text-start" v-for="university in city.universities">
                                <div class="col">
                                    {{ university.name }}
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-4 align-middle">
                                <RankInfoDisplayComponentVue value="1" text="overall" :hovers="city.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue value="-1" text="prices" :hovers="city.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue value="1" text="funnes" :hovers="city.isHovering"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <router-link class='btn btn-dark px-5' :to="{name: 'cities-show', params: {uuid: city.uuid}}">Details</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import RankInfoDisplayComponentVue from '@/components/utils/RankInfoDisplayComponent.vue';

export default {
    components: {
        RankInfoDisplayComponentVue,
    },
    props: [
        //
    ],

    data() {
        return {
            cities: null,

            search: null,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadCities: function () {
            this.$api
                .index('cities', {
                    'filter[search]': this.search,
                    'per_page': 16,
                })
                .then((response) => {
                    this.cities = response.data.data;
                    this.cities.isHovering = false;
                })
        }
    },

    mounted() {
        this.loadCities();
    },
}
</script>

<style scoped>

</style>
