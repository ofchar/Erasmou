<template>
    <div>
        <button type="button" :class="setClass" @click="clicked" :disabled="disabled">
            <div v-if="loading" class="spinner-border spinner-border-sm"></div>
            <div v-else><slot></slot></div>
        </button>
    </div>
</template>

<script>
export default {
    components: {
        //
    },
    props: {
        setClass: {
            default: "btn btn-primary"
        },
        loading: {
            default: false,
        },
        disabled: {
            default: false,
        }
    },

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
        clicked: function () {
            this.$emit('clicked');
        },
    },

    mounted() {
        //
    },
}
</script>

<style></style>