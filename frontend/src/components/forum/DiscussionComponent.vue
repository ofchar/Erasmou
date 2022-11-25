<template>
    <div v-if="forums">
        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Discussions</h5></div>
                    <div class="col-md-4 text-end mt-auto">
                        <input class="form-control" v-model="search" placeholder="search">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-for="forum in forums">
                    <div class="hvr p-1" @mouseenter="forum.collapsed = true" @mouseleave="forum.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-4 text-start">
                                {{ forum.name }}
                            </div>
                            <div class="col"><small>{{ forum.description }}</small></div>
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container hvred" v-show="forum.collapsed">
                            <div class="row">
                                <div class="col-9">
                                    <div class="container">
                                        <div class="row align-items-center"><small>freshest reply</small></div>
                                        <div class="row align-items-center text-center">{{ forum.post.title }}</div>

                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row"><small>total replies</small></div>
                                    <div class="row">{{ forum.posts_count }}</div>
                                </div>
                            </div>
                        </div>
                    </CollapseTransition>
                </div>
            </div>
            <div class="card-footer">
                Showing {{ forumsMeta.from }} to {{ forumsMeta.to }} of {{ forumsMeta.total }} total
            </div>
        </div>
    </div>
</template>

<script>
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';

export default {
    components: {
        CollapseTransition,
    },
    props: [
        'type',
        'uuid',
    ],

    data() {
        return {
            forums: null,
            forumsMeta: null,

            search: null,
        }
    },

    watch: {
        //
    },
    computed: {
        forumableType: function () {
            switch (this.type) {
                case 1:
                    return 'App\\Models\\City';
                case 2:
                    return 'App\\Models\\University';
            }
        },
    },

    methods: {
        loadForums: function () {
            this.$api
                .index('forums', {
                    'filter[forumable_type]': this.forumableType,
                    'filter[forumable_uuid]': this.uuid,
                    'filter[search]': this.search,
                })
                .then((response) => {
                    this.forums = response.data.data;
                    this.forumsMeta = response.data.meta;
                })
        }
    },

    mounted() {
        this.loadForums();
    },
}
</script>

<style scoped>
.hvr:hover, .hvr:focus, .hvr:active {
    background-color: gray;
    color: greenyellow;
    transition-duration: 0.3s;
}

.hvred {
    background-color: #707070;
}

.bordered {
    border-bottom: 2px solid rgba(255,255,255,0.7);
}
</style>