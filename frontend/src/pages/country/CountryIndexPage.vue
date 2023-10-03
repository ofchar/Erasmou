<template>
    <div>
        <div class="container row justify-content-center row-cols-1 row-cols-md-1 g-4">
            <!-- <div class="card mb-2 bg-secondary text-white" v-for="country in countries">
                <img :src="'https://flagsapi.com/' + country.code + '/flat/64.png'" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title fs-3">{{ country.name }}</h5>
                    <p class="card-text fs-5">{{ country.description }}</p>
                    <router-link class='btn btn-dark' :to="{name: 'countries-show', params: {uuid: country.uuid}}">Country page</router-link>
                </div>
            </div> -->


            <div class="card mb-2 bg-secondary text-white " v-for="country in countries" @click="$router.push({name: 'countries-show', params: {uuid: country.uuid}})">
                <div class="card-body">
                    <div class="row row-5 mb-0 pb-0">
                        <div class="col fs-2">
                            {{ country.name }}
                        </div>
                    </div>

                    <div class="row row-10 mt-0 pt-0">
                        <div class="col-3">
                            <img :src="'https://www.worldometers.info/img/flags/' + country.code.toLowerCase() + '-flag.gif'" class="fit-img" />
                        </div>
                        <div class="col-9">
                            <div class="row row-5">
                                {{ getTruncated(country.description) }}
                            </div>
                            <div class="row row-5">
                                <div class="col-4">
                                    <div class="backgrounded p-1">
                                        <label>Population</label>
                                        <div>{{ getFormatted(country.population) }}</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="backgrounded p-1">
                                        <label>Registered cities</label>
                                        <div>{{ getFormatted(country.cities_count) }}</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="backgrounded p-1">
                                        <label>Registered universities</label>
                                        <div>{{ getFormatted(country.universities_count) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        //
    ],

    data() {
        return {
            countries: [],
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        loadCountries: function () {
            this.$api
                .index('countries')
                .then((response) => {
                    this.countries = response.data.data;
                })
        },

        getFormatted: function (number) {
            return new Intl.NumberFormat().format(number)
        },

        getTruncated: function (text) {
            if (text.length > 200) {
                return text.substring(0, 200) + '...';
            } else {
                return text;
            }
        }
    },

    mounted() {
        this.loadCountries();
    },
}
</script>

<style scoped>
.card {
    flex-direction: row;
    align-items: center;
    transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover {
  transform: scale(1.01);
  box-shadow: 0 0 10px rgba(34, 34, 34, 0.7), 0 0 10px rgba(34, 34, 34, 0.7), 0 0 10px rgba(34, 34, 34, 0.7);
  cursor: pointer;
}

.card-title {
    font-weight: bold;
    font-size:x-large;
}

.fit-img {
    max-height: 80%;
    max-width: 80%;
}

.row-10 {
    height: 120px;
}
.row-5 {
    height: 60px;
}

.backgrounded {
    background-color: #798289;
    border-radius: 25px;
}
</style>
