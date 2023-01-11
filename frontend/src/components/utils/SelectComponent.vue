<template>
    <div>
        <v-select class="bg-light text-dark" :options="options" label="name" v-model="query" @search="searchData"
            v-bind:class="{ disabled: blocked }"/>
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
        'blocked': Boolean,
        'additionalParams': Object,
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
        },
        additionalParams: {
            handler(newValue, oldValue) {
                this.loadData();
            },
            deep: true
    }
    },
    computed: {
        //
    },

    methods: {
        loadData: function() {
            this.$api
                .index(this.route, this.additionalParams)
                .then((response) => {
                    this.options = response.data.data;
                })
        },

        searchData: function (search, loading) {
            loading(true);

            this.$api
                .index(this.route, {
                    'filter[search]': search,
                    ...this.additionalParams,
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

<style scoped>
.disabled {
    pointer-events:none;
    color: #bfcbd9;
    cursor: not-allowed;
    background-image: none;
    background-color: #eef1f6;
    border-color: #d1dbe5;
}
</style>