<template>
    <div v-if="apartments">
        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Apartments</h5></div>
                    <div class="col-md-4 text-end mt-auto">
                        <input class="form-control" v-model="search" placeholder="search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="bordered p-1">
                    <div class="row m-2 align-items-center text-center">
                        <div class="col-4 text-start">
                            <div class="row">Name</div>
                        </div>
                        <div class="col-2">Price / month</div>
                        <div class="col-2">Cleanliness</div>
                    </div>
                </div>
                <div v-for="apartment in apartments">
                    <div class="hvr p-1" @mouseenter="apartment.collapsed = true" @mouseleave="apartment.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-4 text-start">{{ apartment.name }}</div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="1" text="2000" :hovers="apartment.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="1" text="2000" :hovers="apartment.collapsed"/>
                            </div>
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container hvred" v-show="apartment.collapsed">
                            <div class="row">
                                <div class="col-9">
                                    <div class="container">
                                        <div class="row align-items-center"><small>freshest reply</small></div>
                                        <!-- <div class="row align-items-center text-center">{{ apartment.post.title }}</div> -->

                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row"><small>total replies</small></div>
                                    <div class="row">{{ apartment.posts_count }}</div>
                                </div>
                            </div>
                        </div>
                    </CollapseTransition>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ apartmentsMeta.from }} to {{ apartmentsMeta.to }} of {{ apartmentsMeta.total }} total
            </div>
        </div>
    </div>
</template>

<script>
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import RankIconDisplayComponent from '../utils/RankIconDisplayComponent.vue';
import RankInfoDisplayComponent from '../utils/RankInfoDisplayComponent.vue';

export default {
    components: {
    CollapseTransition,
    RankIconDisplayComponent,
    RankInfoDisplayComponent
},
    props: [
        'uuid'
    ],

    data() {
        return {
            apartments: null,
            apartmentsMeta: null,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadApartments: function () {
            this.$api
                .index('apartments', {
                    'filter[city_uuid]': this.uuid
                })
                .then((response) => {
                    this.apartments = response.data.data;
                    this.apartmentsMeta = response.data.meta;
                });
        }
    },

    mounted() {
        this.loadApartments();
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