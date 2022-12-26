<template>
    <div>
        <div class="card mb-2 bg-secondary text-white">
            <h5 class="card-header">Query</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input class="form-control" v-model="search" placeholder="search"/>
                    </div>
                    <div class="col">
                        <SelectComponent route='countries' v-model="countryQuery"/>
                    </div>
                </div>
            </div>
        </div>

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
                                <RankInfoDisplayComponentVue :value="city.rates.overall" text="overall" :hovers="city.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue :value="city.rates.prices" text="prices" :hovers="city.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue :value="city.rates.funnes" text="funnes" :hovers="city.isHovering"/>
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
import SelectComponent from '@/components/utils/SelectComponent.vue';

export default {
    components: {
        RankInfoDisplayComponentVue,
        SelectComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            cities: null,

            search: null,
            countryQuery: null,
        }
    },

    watch: {
        search: function () {
            this.loadCities();
        },
        countryQuery: function () {
            this.loadCities();
        }
    },
    computed: {
        //
    },

    methods: {
        loadCities: function () {
            this.$api
                .index('cities', {
                    'filter[search]': this.search,
                    'filter[country_uuid]': this.countryQuery ? this.countryQuery.uuid : null,
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
