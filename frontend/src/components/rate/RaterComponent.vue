<template>
    <div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addOpinionModal" :disabled="(!loggedIn || loading)">Start discussion</button>


        <div class="modal fade text-dark" id="addOpinionModal" tabindex="-1" aria-labelledby="opinionModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="opinionModal">Add new opinion!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div v-for="rateable in rateables">
                            <span v-if="(rateable.data_type == 2)">
                                <label>{{ rateable.name }}</label>

                                <div class="d-flex flex-row bd-highlight mb-2">
                                    <div class="p-2 flex-fill bd-highlight" v-for="index in getIndexes(rateable.min_value, rateable.max_value)">
                                        <input
                                            type="radio"
                                            class="btn-check"
                                            :name="rateable.name + 'options'"
                                            :id="rateable.name + 'option' + index"
                                            autocomplete="off"
                                            v-model="newOpinion.opinions[rateable.uuid]"
                                            :value="index">

                                        <label class="btn btn-outline-secondary py-2 px-4" :for="rateable.name + 'option' + index">{{ index }}</label>
                                    </div>
                                </div>
                            </span>
                            <span v-else>
                                <label>{{ rateable.name }}</label>
                                <input class="form-control" v-model="newOpinion.opinions[rateable.uuid]" :placeholder="(rateable.min_value + '-' + rateable.max_value)"/>
                            </span>
                        </div>

                        <label>Comment</label>
                        <input class="form-control" v-model="newOpinion.comment" placeholder="Comment"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveOpinion()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {
        //
    },
    props: [
        'targetable_type',
        'rateable_uuid',
    ],

    data() {
        return {
            rank: null,

            rateables: [],
            loading: true,

            newOpinion: {
                opinions: {},
            },
        }
    },

    watch: {
        //
    },
    computed: {
        loggedIn: function () {
            return localStorage.getItem('user') != undefined ? true : false
        },
    },

    methods: {
        loadRateables: function () {
            this.loading = true;

            this.$api
                .index('rateables', {
                    'filter[targetable_type]': this.targetable_type,
                })
                .then((response) => {
                    this.rateables = response.data.data;

                    this.loading = false;
                });
        },

        getIndexes: function(min, max) {
            var list = [];

            for (var i = min; i <= max; i++) {
                list.push(i);
            }

            return list;
        },

        saveOpinion: function () {
            // this.$api
            //     .create('rate', {
            //         targetable_type' => 'required|string',
            //         'targetable_uuid' => 'required|uuid',
            //         'rateable_uuid' => 'required|uuid',
            //         'value' => 'required|string',
            //         'comment' => 'nullable|string',
            //     })
        },
    },

    mounted() {
        this.loadRateables();
    },
}
</script>

<style>

</style>