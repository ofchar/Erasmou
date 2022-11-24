<template>
    <div>
        <div class="card text-start mt-3 bg-secondary text-white" v-if="city">
            <h5 class="card-header">Info</h5>
            <div class="card-body">
                <h5 class="card-title">{{ city.name }}</h5>
                <p class="card-text">{{ city.description }}</p>
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
                        <div class="col-md-3 text-start">
                            <div class="row">Name</div>
                            <div class="row"><small>Province</small></div>
                        </div>
                        <div class="col-md-2">Population</div>
                        <div class="col-md-1">Opinion</div>
                        <div class="col-md-1">Prices</div>
                        <div class="col-md-1">Fun</div>
                        <div class="col-md-2">Universities</div>
                        <div class="col-md-2">Esn Sections</div>
                    </div>
                </div>

                <div v-for="university in universities">
                    <div class="hvr p-1" @mouseenter="university.collapsed = true" @mouseleave="university.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-md-3 text-start">
                                <div class="row">
                                    {{ university.name }}
                                </div>
                                <div class="row">
                                    <small>{{ university.province}}</small>
                                </div>
                            </div>
                            <div class="col-md-2">{{ university.population }}</div>
                            <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-2">{{ university.universities }}</div>
                            <div class="col-md-2">1</div>
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
                Showing {{ universities.from }} to {{ universities.to }} of {{ universities.total }} total
            </div>
        </div>
    </div>
</template>

<script>
import { numberify } from '@/services/utils.js'

import RankIconDisplayComponentVue from '@/components/utils/RankIconDisplayComponent.vue';
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue'

export default {
    components: {
        RankIconDisplayComponentVue,
        CollapseTransition,
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