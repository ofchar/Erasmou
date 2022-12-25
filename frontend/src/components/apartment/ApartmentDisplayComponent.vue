<template>
    <div v-if="apartments">
        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Apartments</h5></div>
                    <div class="col-md-5 text-end mt-auto">
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" v-model="search" placeholder="search">
                            </div>
                            <div class="col-4 px-3">
                                <button class="btn btn-dark px-3" data-bs-toggle="modal" data-bs-target="#addApartmentModal">Add apartment</button>
                            </div>
                        </div>
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
                        <div class="col-2">Cleanliness /10</div>
                        <div class="col-2">Location /10</div>
                        <div class="col-2">Overall /10</div>
                    </div>
                </div>
                <div v-for="apartment in apartments">
                    <div class="hvr p-1" @mouseenter="apartment.collapsed = true" @mouseleave="apartment.collapsed = false"
                        @mousedown="gotoApartment(apartment)">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-4 text-start">{{ apartment.name }}</div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :textOnly="true" :text="apartment.Price" :hovers="apartment.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="apartment.Cleanliness" :text="apartment.Cleanliness_original" :hovers="apartment.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="apartment.Location" :text="apartment.Location_original" :hovers="apartment.collapsed"/>
                            </div>
                            <div class="col-2">
                                <RankInfoDisplayComponent :value="apartment.Overall" :text="apartment.Overall_original" :hovers="apartment.collapsed"/>
                            </div>
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container hvred" v-show="apartment.collapsed">
                            <!-- <div class="row">
                                <div class="col-9">
                                    <div class="container">
                                        <div class="row align-items-center"><small>freshest reply</small></div>
                                        <div class="row align-items-center text-center">{{ apartment.post.title }}</div>

                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row"><small>total replies</small></div>
                                    <div class="row">{{ apartment.posts_count }}</div>
                                </div>
                            </div> -->
                        </div>
                    </CollapseTransition>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ apartmentsMeta.from }} to {{ apartmentsMeta.to }} of {{ apartmentsMeta.total }} total
            </div>
        </div>


        <div class="modal fade" id="addApartmentModal" tabindex="-1" aria-labelledby="apartmentModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="apartmentModal">Start new discussion!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Landlord</label>
                        <SelectComponent route="landlords" v-model="newApartment.landlord" />

                        <label>Landlord</label>
                        <input class="form-control" v-model="newApartment.name" placeholder="Title"/>

                        <label>Body</label>
                        <textarea class="form-control" v-model="newApartment.description" rows="5" placeholder="Body"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveForum()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import RankIconDisplayComponent from '../utils/RankIconDisplayComponent.vue';
import RankInfoDisplayComponent from '../utils/RankInfoDisplayComponent.vue';
import RankInfoParseDisplayComponent from '../utils/RankInfoParseDisplayComponent.vue';
import SelectComponent from '../utils/SelectComponent.vue';

export default {
    components: {
        CollapseTransition,
        RankIconDisplayComponent,
        RankInfoDisplayComponent,
        RankInfoParseDisplayComponent,
        SelectComponent,
    },
    props: [
        'uuid'
    ],

    data() {
        return {
            apartments: null,
            apartmentsMeta: null,

            search: null,

            newApartment: {
                landlord: null,
                name: null,
                description: null,
                url: null,
                road: null,
                building_number: null,
                apartment_number: null,
            },

            newLandlord: {
                name: null,
                phone: null,
                email: null,
                website: null,
            },
        }
    },

    watch: {
        search: function () {
            this.loadApartments();
        }
    },
    computed: {
        //
    },

    methods: {
        loadApartments: function () {
            this.$api
                .index('apartments', {
                    'filter[city_uuid]': this.uuid,
                    'filter[search]': this.search,
                })
                .then((response) => {
                    this.apartments = response.data.data;
                    this.apartmentsMeta = response.data.meta;
                });
        },

        gotoApartment: function (apartment) {
            this.$router.push({ name: 'apartments-show', params: { uuid: apartment.uuid } });
        },
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

label {
    margin-top: 1rem;
}
</style>