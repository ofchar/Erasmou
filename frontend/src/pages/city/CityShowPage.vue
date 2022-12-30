<template>
    <div>
        <div class="card text-start bg-secondary text-white" v-if="city">
            <h5 class="card-header">Info</h5>
            <div class="card-body">
                <h5 class="card-title">{{ city.name }}</h5>
                <p class="card-text">{{ city.description }}</p>

                <div class="row align-items-center mt-3">
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="city.rates.overall" :value_original="city.rates.overall_original" text="overall"/>
                    </div>
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="city.rates.prices" :value_original="city.rates.prices_original" text="prices"/>
                    </div>
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="city.rates.funnes" :value_original="city.rates.funnes_original" text="funnes"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Universities</h5></div>
                    <div class="col-md-4 text-end mt-auto">
                        <input class="form-control" v-model="universitiesSearch" placeholder="search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="bordered p-1">
                    <div class="row m-2 align-items-center text-center">
                        <div class="col-5 text-start">Name</div>
                        <div class="col-2">Overall /10</div>
                        <div class="col-2">Education /10</div>
                        <div class="col-2">Friendliness /10</div>
                    </div>
                </div>

                <div v-for="university in universities">
                    <div class="hvr p-1" @mouseenter="university.collapsed = true"
                        @mouseleave="university.collapsed = false" @mousedown="gotoUniversity(university)">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-5 text-start">{{ university.name }}</div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="university.rates.overall" :text="university.rates.overall_original" :hovers="university.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="university.rates.education" :text="university.rates.education_original" :hovers="university.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="university.rates.friendliness" :text="university.rates.friendliness_original" :hovers="university.collapsed"/>
                            </div>
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container hvred" v-show="university.collapsed">
                            <div class="row p-2 m-2" v-for="faculty in university.faculties">
                                {{faculty.name}}
                            </div>
                        </div>
                    </CollapseTransition>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ universitiesMeta.from }} to {{ universitiesMeta.to }} of {{ universitiesMeta.total }} total
            </div>
        </div>

        <DiscussionComponent v-if="uuid" :type="1" :uuid="uuid"/>

        <RatesDisplayComponent v-if="uuid" targetable_type="App\Models\City" :targetable_uuid="uuid"/>

        <ApartmentDisplayComponent v-if="uuid" :uuid="uuid"/>
    </div>
</template>

<script>
import { numberify } from '@/services/utils.js'

import RankIconDisplayComponentVue from '@/components/utils/RankIconDisplayComponent.vue';
import RankInfoDisplayComponent from '@/components/utils/RankInfoDisplayComponent.vue';
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import DiscussionComponent from '@/components/forum/DiscussionComponent.vue';
import ApartmentDisplayComponent from '@/components/apartment/ApartmentDisplayComponent.vue';
import RatesDisplayComponent from '@/components/rate/RatesDisplayComponent.vue';
import RankInfoDetailDisplayComponent from '@/components/utils/RankInfoDetailDisplayComponent.vue';

export default {
    components: {
        RankIconDisplayComponentVue,
        RankInfoDisplayComponent,
        CollapseTransition,
        DiscussionComponent,
        ApartmentDisplayComponent,
        RatesDisplayComponent,
        RankInfoDetailDisplayComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            uuid: null,
            city: null,

            universities: [],
            universitiesMeta: [],
            universitiesSearch: null,
        }
    },

    watch: {
        universitiesSearch: function (value) {
            this.loadUniversities(value);
        }
    },
    computed: {
        //
    },

    methods: {
        loadCity: function () {
            this.$api
                .show('cities', this.uuid)
                .then((response) => {
                    this.city = response.data.data;
                });
        },

        loadUniversities: function (search) {
            this.$api
                .index('universities', {
                    'filter[city_uuid]': this.uuid,
                    'filter[search]': search,
                })
                .then((response) => {
                    this.universities = response.data.data;
                    this.universitiesMeta = response.data.meta;
                })
        },

        format: function (val) {
            return numberify(val);
        },

        gotoUniversity: function (university) {
            this.$router.push({ name: 'universities-show', params: { uuid: university.uuid } });
        },
        gotoForum: function (university) {
            this.$router.push({ name: 'universities-show', params: { uuid: university.uuid } });
        },
        gotoApartment: function (university) {
            this.$router.push({ name: 'universities-show', params: { uuid: university.uuid } });
        },
    },

    mounted() {
        this.uuid = this.$route.params.uuid;

        this.loadCity();
        this.loadUniversities();
    },
}
</script>

<style scoped>
.hvr:hover, .hvr:focus, .hvr:active {
    background-color: gray;
    color: greenyellow;
    transition-duration: 0.3s;
}

.hvred {
    background-color: #707070;
}

.bordered {
    border-bottom: 2px solid rgba(255,255,255,0.7);
}
</style>