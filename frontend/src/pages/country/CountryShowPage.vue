<template>
    <div>
        <div class="card text-start bg-secondary text-white">
            <h5 class="card-header">Info</h5>
            <div class="card-body">
                <h5 class="card-title">{{ country.name }}</h5>
                <p class="card-text">{{ country.description }}</p>
            </div>
        </div>

        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Cities</h5></div>
                    <div class="col-md-4 text-end mt-auto">
                        <input class="form-control" v-model="citiesSearch" placeholder="search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="bordered p-1">
                    <div class="row m-2 align-items-center text-center">
                        <div class="col text-start">
                            <div class="row">Name</div>
                            <div class="row"><small>Province</small></div>
                        </div>
                        <div class="col">Population</div>
                        <div class="col">Opinion</div>
                        <div class="col">Prices</div>
                        <div class="col">Fun</div>
                        <div class="col">Universities</div>
                    </div>
                </div>

                <div v-for="city in cities">
                    <div class="hvr p-1" @mousedown="$router.push({ name: 'cities-show', params: { uuid: city.uuid } });"
                        @mouseenter="city.collapsed = true" @mouseleave="city.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col text-start">
                                <div class="row">
                                    {{ city.name }}
                                </div>
                                <div class="row">
                                    <small>{{ city.province}}</small>
                                </div>
                            </div>
                            <div class="col">{{ format(city.population) }}</div>

                            <div class="col">
                                <RankInfoDisplayComponent :value="city.rates.overall" :text="city.rates.overall_original" :hovers="city.collapsed"/>
                            </div>
                            <div class="col">
                                <RankInfoDisplayComponent :value="city.rates.prices" :text="city.rates.prices_original" :hovers="city.collapsed"/>
                            </div>
                            <div class="col">
                                <RankInfoDisplayComponent :value="city.rates.funnes" :text="city.rates.funnes_original" :hovers="city.collapsed"/>
                            </div>
                            <div class="col">{{ city.universities.length }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ citiesMeta.from }} to {{ citiesMeta.to }} of {{ citiesMeta.total }} total
            </div>
        </div>


        <!-- <div class="card text-start mt-3 bg-secondary text-white">
            <h5 class="card-header">Universities</h5>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div> -->

    </div>
</template>

<script>
import { numberify } from '@/services/utils.js'

import RankInfoDisplayComponent from '@/components/utils/RankInfoDisplayComponent.vue';
import DiscussionComponentVue from '@/components/forum/DiscussionComponent.vue';

export default {
    components: {
        RankInfoDisplayComponent,
        DiscussionComponentVue,
    },
    props: [
        //
    ],

    data() {
        return {
            uuid: null,
            country: [],

            cities: [],
            citiesMeta: [],
            citiesSearch: null,
        }
    },

    watch: {
        citiesSearch: function (value) {
            this.loadCities(value);
        }
    },
    computed: {
        //
    },

    methods: {
        loadCountry: function () {
            this.$api
                .show('countries', this.uuid)
                .then((response) => {
                    this.country = response.data.data;
                });
        },

        loadCities: function (search) {
            this.$api
                .index('cities', {
                    'filter[country_uuid]': this.uuid,
                    'filter[search]': search,
                })
                .then((response) => {
                    this.cities = response.data.data;
                    this.citiesMeta = response.data.meta;
                })
        },

        format: function (val) {
            return numberify(val);
        },
    },

    mounted() {
        this.uuid = this.$route.params.uuid;

        this.loadCountry();
        this.loadCities();
    },
}
</script>

<style scoped>
.hvr:hover, .hvr:focus, .hvr:active {
    background-color: gray;
    color: greenyellow;
    transition-duration: 0.3s;
}

.bordered {
    border-bottom: 2px solid rgba(255,255,255,0.7);
}
</style>