<template>
    <div>
        <div class="card text-start mt-3 bg-secondary text-white" v-if="university">
            <h5 class="card-header">Info</h5>
            <div class="card-body">
                <h5 class="card-title">{{ university.name }}</h5>
                <p class="card-text">{{ university.description }}</p>
            </div>
        </div>

        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <h5>Faculties</h5>
            </div>
            <div class="card-body">
                <div class="bordered p-1">
                    <div class="row m-2 align-items-center text-center">
                        <div class="col-md-3 text-start">Name</div>
                        <div class="col-md-5">Description</div>
                        <!-- <div class="col-md-1">Opinion</div>
                        <div class="col-md-1">Prices</div>
                        <div class="col-md-1">Fun</div>
                        <div class="col-md-2">Universities</div>
                        <div class="col-md-2">Esn Sections</div> -->
                    </div>
                </div>

                <div v-for="faculty in faculties">
                    <div class="hvr p-1" @mouseenter="faculty.collapsed = true" @mouseleave="faculty.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-md-3 text-start">{{ faculty.name }}</div>
                            <div class="col-md-5">{{ faculty.description }}</div>
                            <!-- <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-1"><RankIconDisplayComponentVue value="1"/></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">1</div> -->
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container hvred" v-show="faculty.collapsed">
                            <div class="row p-2 m-2" v-for="faculty in faculty.faculties">
                                {{faculty.name}}
                            </div>
                        </div>
                    </CollapseTransition>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ facultiesMeta.from }} to {{ facultiesMeta.to }} of {{ facultiesMeta.total }} total
            </div>
        </div>

        <DiscussionComponent v-if="uuid" :type="2" :uuid="uuid"/>
    </div>
</template>

<script>
import { numberify } from '@/services/utils.js'

import RankIconDisplayComponentVue from '@/components/utils/RankIconDisplayComponent.vue';
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import DiscussionComponent from '@/components/forum/DiscussionComponent.vue';

export default {
    components: {
        RankIconDisplayComponentVue,
        CollapseTransition,
        DiscussionComponent,
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
        // universitiesSearch: function (value) {
        //     this.loadFaculties(value);
        // }
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
                    // 'filter[search]': search,
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