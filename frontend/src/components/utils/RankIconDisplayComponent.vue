<template>
    <font-awesome-icon v-if="value >= 0.5" size="2x" icon="fa-regular fa-face-smile" style=" vertical-align: middle;"/>
    <font-awesome-icon v-else-if="value < 0.5 && value > -0.5" size="2x" icon="fa-regular fa-face-meh" style=" vertical-align: middle;"/>
    <font-awesome-icon v-else size="2x" icon="fa-regular fa-face-frown" style=" vertical-align: middle;"/>
</template>

<script>
export default {
    components: {
        //
    },
    props: [
        'value'
    ],

    data() {
        return {
            //
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        //
    },

    mounted() {
        //
    },
}
</script>

<style>

</style>