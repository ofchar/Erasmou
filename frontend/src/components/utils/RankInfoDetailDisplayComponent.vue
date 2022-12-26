<template>
    <div class="container backgrounded p-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-5">
                <span v-if="!textOnly">
                    {{ text ?? 'no data'}} - {{ value_original ?? '-' }}
                </span>
                <span v-else>
                    {{ text ?? 'no data'}}
                </span>
            </div>

            <div class="col-3">
                <span v-if="value != undefined && !textOnly">
                    <font-awesome-icon v-if="value >= 0.5"
                        size="2x" icon="fa-regular fa-face-smile" class="middle-icon positive"/>
                    <font-awesome-icon v-else-if="value < 0.5 && value > -0.5"
                        size="2x" icon="fa-regular fa-face-meh" class="middle-icon"/>
                    <font-awesome-icon v-else
                        size="2x" icon="fa-regular fa-face-frown" class="middle-icon negative"/>
                </span>

                <span v-if="value == undefined && !textOnly">
                    <font-awesome-icon size="2x" icon="fa-regular fa-face-meh-blank" class="middle-icon"/>
                </span>
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
        'value_original',
        'text',
        'textOnly',
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
</style>