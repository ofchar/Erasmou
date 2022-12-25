<template>
    <div class="card text-start mt-3 bg-secondary text-white">
        <div class="card-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4 mt-auto">
                    <h5>Rates</h5>
                </div>
                <div class="col-md-5 text-end mt-auto">
                    <div class="row">
                        <div class="col-8">
                            <input class="form-control" v-model="search" placeholder="search">
                        </div>
                        <div class="col-4 px-3">
                            <!-- <button class="btn btn-dark px-4" data-bs-toggle="modal" data-bs-target="#addForumModal"
                                :disabled="!loggedIn">rate this</button> -->

                            <RaterComponent :targetable_type="targetable_type" :rateable_uuid="targetable_uuid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row container mb-4 hvr p-1" v-for="ratesGroup in rates">
                    <div class="row">Rates by {{ ratesGroup.values[0].user.username }}, created on {{ formattedDate(ratesGroup.values[0].created_at) }}</div>
                    <div class="row mt-1 col" v-for="rate in ratesGroup.values">
                        {{ rate.rateable.name }}: {{ formattedRate(rate) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            Showing freshest rates for this object.
        </div>
    </div>
</template>

<script>
import { formatDate } from '@/services/formatDate.js';
import RaterComponent from './RaterComponent.vue';

export default {
    components: {
        RaterComponent,
    },
    props: [
        'targetable_type', 'targetable_uuid'
    ],

    data() {
        return {
            rates: [],
            meta: {},
        }
    },

    watch: {
        //
    },
    computed: {
        loggedIn: function () {
            return localStorage.getItem('user') != undefined ? true : false;
        },
    },

    methods: {
        loadData: function () {
            this.$api
                .index('rates', {
                    'filter[targetable_type]': this.targetable_type,
                    'filter[targetable_uuid]': this.targetable_uuid,
                    'per_page': 24,
                })
                .then((response) => {
                    this.rates = this.groupBy(response.data.data, 'user_uuid');
                });
        },

        groupBy(xs, key) {
            return xs.reduce(function (rv, x) {
                let v = key instanceof Function ? key(x) : x[key];
                let el = rv.find((r) => r && r.key === v);

                if (el) {
                    el.values.push(x);
                } else {
                    rv.push({ key: v, values: [x] });
                }

                return rv;
            }, []);
        },

        formattedDate: function (date) {
            return formatDate(date);
        },
        formattedRate: function (rate) {
            if(rate.rateable.data_type == 2) {
                return rate.value + "  in " + rate.rateable.min_value + "-" + rate.rateable.max_value + " scale";
            }
            else {
                return rate.value;
            }
        }
    },

    mounted() {
        this.loadData();
    },
}
</script>

<style>
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