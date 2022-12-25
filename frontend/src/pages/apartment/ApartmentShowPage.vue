<template>
    <div>
        <div class="card text-start bg-secondary text-white" v-if="apartment">
            <h5 class="card-header">{{ apartment.name }}</h5>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        {{ apartment.description }}
                    </div>

                    <div class="row mt-2" v-if="apartment.foreign_url">
                        Find out more at {{ apartment.foreign_url }}
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label>City</label>
                            <div class="addressText">{{ apartment.city.name }}</div>
                        </div>
                        <div class="col">
                            <label>Road</label>
                            <div class="addressText">{{ apartment.road }}</div>
                        </div>
                        <div class="col">
                            <label>Building number</label>
                            <div class="addressText">{{ apartment.building_number }}</div>
                        </div>
                        <div class="col">
                            <label>Apartment number</label>
                            <div class="addressText" v-if="apartment.apartment_number">{{ apartment.apartment_number }}</div>
                            <div class="addressText" v-else><i>--</i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DiscussionComponent v-if="uuid" :type="3" :uuid="uuid"/>

        <RatesDisplayComponent v-if="uuid" targetable_type="App\Models\Apartment" :targetable_uuid="uuid"/>
    </div>
</template>

<script>
import DiscussionComponent from '@/components/forum/DiscussionComponent.vue';
import RatesDisplayComponent from '@/components/rate/RatesDisplayComponent.vue';

export default {
    components: {
        DiscussionComponent,
        RatesDisplayComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            uuid: null,

            apartment: null,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadData: function () {
            this.$api
                .show('apartments', this.uuid)
                .then((response) => {
                    this.apartment = response.data.data;
                });
        }
    },

    mounted() {
        this.uuid = this.$route.params.uuid;

        this.loadData();
    },
}
</script>

<style scoped>
.addressText {
    font-size: large;
}

label {
    font-size: small;
}
</style>