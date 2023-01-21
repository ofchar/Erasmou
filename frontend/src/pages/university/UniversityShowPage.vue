<template>
    <div>
        <div class="card text-start mt-3 bg-secondary text-white" v-if="university">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Info</h5></div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ university.name }}</h5>
                <p class="card-text">{{ university.description }}</p>

                <div class="row align-items-center mt-3">
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="university.rates.overall" :value_original="university.rates.overall_original" text="overall"/>
                    </div>
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="university.rates.education" :value_original="university.rates.education_original" text="education"/>
                    </div>
                    <div class="col">
                        <RankInfoDetailDisplayComponent :value="university.rates.friendliness" :value_original="university.rates.friendliness_original" text="friendliness"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <h5>Faculties</h5>
            </div>
            <div class="card-body">
                <div class="bordered p-1">
                    <div class="row m-2 align-items-center text-center">
                        <div class="col text-start">Name</div>
                        <div class="col">Description</div>
                    </div>
                </div>

                <div v-for="faculty in faculties">
                    <div class="hvr p-1" @mouseenter="faculty.collapsed = true" @mouseleave="faculty.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col text-start">{{ faculty.name }}</div>
                            <div class="col">{{ faculty.description }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ facultiesMeta.from }} to {{ facultiesMeta.to }} of {{ facultiesMeta.total }} total
            </div>
        </div>

        <DiscussionComponent v-if="uuid" :type="2" :uuid="uuid"/>

        <RatesDisplayComponent v-if="uuid" targetable_type="App\Models\University" :targetable_uuid="uuid"/>
    </div>
</template>

<script>
import { numberify } from '@/services/utils.js'

import RankIconDisplayComponentVue from '@/components/utils/RankIconDisplayComponent.vue';
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import DiscussionComponent from '@/components/forum/DiscussionComponent.vue';
import RaterComponent from '@/components/rate/RaterComponent.vue';
import RatesDisplayComponent from '@/components/rate/RatesDisplayComponent.vue';
import RankInfoDetailDisplayComponent from '@/components/utils/RankInfoDetailDisplayComponent.vue';

export default {
    components: {
        RankIconDisplayComponentVue,
        CollapseTransition,
        DiscussionComponent,
        RaterComponent,
        RatesDisplayComponent,
        RankInfoDetailDisplayComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            uuid: null,
            university: null,

            faculties: [],
            facultiesMeta: [],
            facultiesSearch: null,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadUniversity: function () {
            this.$api
                .show('universities', this.uuid)
                .then((response) => {
                    this.university = response.data.data;
                });
        },

        loadFaculties: function (search) {
            this.$api
                .index('faculties', {
                    'filter[university_uuid]': this.uuid,
                })
                .then((response) => {
                    this.faculties = response.data.data;
                    this.facultiesMeta = response.data.meta;
                })
        },

        format: function (val) {
            return numberify(val);
        },
    },

    mounted() {
        this.uuid = this.$route.params.uuid;

        this.loadUniversity();
        this.loadFaculties();
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