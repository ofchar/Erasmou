<template>
    <div>
        <div class="card mb-2 bg-secondary text-white">
            <h5 class="card-header">New Code</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label>Specify amount of uses, or -1 for infinity</label>
                        <input class="form-control" v-model="uses" placeholder="uses"/>
                    </div>
                    <div class="col">
                        <label>Press to create, code will be displayed</label>
                        <button class="form-control btn btn-dark" @click="addCode">Add code</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4 mt-1">
            <div class="col" v-for="code in codes" v-if="codes">
                <div class="card h-100 bg-secondary text-white">
                    <div class="card-body">
                        <h4 class="card-title">Code: {{ code.code }}</h4>
                        <p class="card-text text-center">Uses left: {{ code.uses_left }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger px-5" @click="removeCode(code)">Remove code</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'

export default {
    components: {
        //
    },
    props: [
        //
    ],

    data() {
        return {
            codes: [],

            uses: null,
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
                .index('verification-codes', {
                    params: {
                        //
                    }
                })
                .then((response) => {
                    this.codes = response.data.data;
                });
        },

        addCode: function () {
            this.$api
                .create('verification-codes', {
                    'uses': this.uses,
                })
                .then((response) => {
                    showSwal(this, 3, 'Success!', 'your code: ' + response.data.data.code);

                    this.loadData();
                })
                .catch((error) => {
                    showSwal(this, 1);
                });
        },

        removeCode: function (code) {
            this.$api
                .delete('verification-codes', code.uuid)
                .then((response) => {
                    this.loadData();
                })
                .catch((error) => {
                    showSwal(this, 1);
                });
        }
    },

    mounted() {
        this.loadData();
    },
}
</script>

<style>

</style>