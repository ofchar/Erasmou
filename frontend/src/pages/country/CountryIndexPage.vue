<template>
    <div>
        <div class="container" v-for="country in countries">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { assertExpressionStatement } from '@babel/types';

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

        }
    },

    mounted() {
        //
    },
}
</script>

<style>

</style>