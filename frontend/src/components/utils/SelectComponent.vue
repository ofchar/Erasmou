<template>
    <div>
        <v-select class="bg-light text-dark" :options="options" label="name" v-model="query" @search="searchData"/>
    </div>
</template>

<script>
export default {
    components: {
        //
    },
    props: {
        'route': String,
        'modelValue': String,
    },
    emits: [
        'update:modelValue',
    ],

    data() {
        return {
            options: [],
            query: null,
        }
    },

    watch: {
        query: function(value) {
            this.$emit('update:modelValue', this.query);
        }
    },
    computed: {
        //
    },

    methods: {
        loadData: function() {
            this.$api
                .index(this.route)
                .then((response) => {
                    this.options = response.data.data;
                })
        },

        searchData: function (search, loading) {
            loading(true);

            this.$api
                .index(this.route, {
                    'filter[search]': search,
                })
                .then((response) => {
                    this.options = response.data.data;
                    loading(false);
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