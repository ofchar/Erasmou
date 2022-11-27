<template>
    <RankInfoDisplayComponent :value="parsedValue" :text="text" :hovers="hovers"/>
</template>

<script>
import RankInfoDisplayComponent from './RankInfoDisplayComponent.vue';

export default {
    components: {
        RankInfoDisplayComponent
    },
    props: [
        'value',
        'min',
        'max',
        'text',
        'hovers',
    ],

    data() {
        return {
            parsedValue: null,
        }
    },

    watch: {
        value: function () {
            maxAdjusted = max;
            valueAdjusted = value;

            if(min < 0) {
                maxAdjusted = max + Math.abs(min);
                valueAdjusted = value + Math.abs(min);
            }
            else if (min > 0) {
                maxAdjusted = max - min;
                valueAdjusted = value - min;
            }

            result = valueAdjusted / maxAdjusted;

            if(result <= 0.35) {
                this.parsedValue = -1;
            }
            else if (result >= 0.65) {
                this.parsedValue = 1;
            }
            else {
                this.parsedValue = 0;
            }
        }
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

<style scoped>

</style>