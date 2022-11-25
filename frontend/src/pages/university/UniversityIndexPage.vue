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
            <div class="col" v-for="university in universities" v-if="universities">
                <div class="card h-100 bg-secondary text-white"
                    @mouseenter="university.isHovering = true"
                    @mouseleave="university.isHovering = false">
                    <div class="card-body">
                        <h4 class="card-title">{{ university.name }}</h4>
                        <p class="card-text text-start">{{ university.description }}</p>
                        <div class="container justify-content-start m-2 mt-4">
                            <div class="row text-start" v-for="university in university.universities">
                                <div class="col">
                                    {{ university.name }}
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-4 align-middle">
                                <RankInfoDisplayComponentVue value="1" text="overall" :hovers="university.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue value="-1" text="prices" :hovers="university.isHovering"/>
                            </div>
                            <div class="col-4">
                                <RankInfoDisplayComponentVue value="1" text="funnes" :hovers="university.isHovering"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <router-link class='btn btn-dark px-5' :to="{name: 'universities-show', params: {uuid: university.uuid}}">Details</router-link>
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
            universities: null,

            search: null,
            countryQuery: null,
        }
    },

    watch: {
        search: function () {
            this.loadUniversities();
        },
        countryQuery: function () {
            this.loadUniversities();
        }
    },
    computed: {
        //
    },

    methods: {
        loadUniversities: function () {
            this.$api
                .index('universities', {
                    'filter[search]': this.search,
                    // 'filter[country_uuid]': this.countryQuery ? this.countryQuery.uuid : null,
                    'per_page': 16,
                })
                .then((response) => {
                    this.universities = response.data.data;
                    this.universities.isHovering = false;
                })
        }
    },

    mounted() {
        this.loadUniversities();
    },
}
</script>

<style scoped>

</style>
