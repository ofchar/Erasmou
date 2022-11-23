<template>
    <div class="container backgrounded p-2" :class="{hover: hovers}">
        <div class="row justify-content-center align-items-center">
            <div class="col-5 txt">
                {{ text }}
            </div>
            <div class="col-5">
                <font-awesome-icon v-if="value >= 0.5"
                    size="2x" icon="fa-regular fa-face-smile" class="middle-icon positive"/>
                <font-awesome-icon v-else-if="value < 0.5 && value > -0.5"
                    size="2x" icon="fa-regular fa-face-meh" class="middle-icon"/>
                <font-awesome-icon v-else
                    size="2x" icon="fa-regular fa-face-frown" class="middle-icon negative"/>
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
        'value',
        'text',
        'hovers',
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

<style scoped>
.backgrounded {
    background-color: #798289;
    border-radius: 25px;
}

.middle-icon {
    vertical-align: middle;
}

.txt {
    display: none;
}

.hover > * .txt {
    display: block;
    -webkit-transform: scaleX(1);
    transform: scaleX(1);
    -webkit-transform-origin: 100% 50%;
    transform-origin: 100% 50%;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
}

.hover > * .positive {
    color: greenyellow;
    transition-duration: 0.3s;
}
.hover > * .negative {
    color: pink;
}
</style>