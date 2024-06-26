<template>
    <div v-if="forums">
        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto">
                        <h5>Discussions</h5>
                    </div>
                    <div class="col-md-5 text-end mt-auto">
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" v-model="search" placeholder="search">
                            </div>
                            <div class="col-4 px-3">
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addForumModal" :disabled="!loggedIn">Start discussion</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-for="forum in forums">
                    <div class="hvr p-1" @mouseenter="forum.collapsed = true" @mouseleave="forum.collapsed = false"
                        @mousedown="$router.push({ name: 'forums-show', params: { uuid: forum.uuid } });">
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
                                        <div class="row align-items-center text-center" v-if="forum.post">{{ forum.post.title }}</div>
                                        <div class="row align-items-center text-center" v-else>No replies yet</div>
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
                <div class="row">
                    <div class="col">
                        Showing {{ forumsMeta.from }} to {{ forumsMeta.to }} of {{ forumsMeta.total }} total
                    </div>
                    <div class="col text-end">
                        <button class="btn btn-sm btn-dark" @click="prevPage">&lt;&lt;</button>
                        <button class="btn btn-sm btn-dark" @click="nextPage">>></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addForumModal" tabindex="-1" aria-labelledby="forumModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forumModal">Start new discussion!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Title</label>
                        <input class="form-control" v-model="newForum.name" placeholder="Title"/>

                        <label class="mt-3">Body</label>
                        <textarea class="form-control" v-model="newForum.description" rows="5" placeholder="Body"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveForum()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'

import { Modal } from 'bootstrap';
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
            forumsMeta: {
                current_page: 1,
            },

            search: null,

            newForum: {
                name: null,
                description: null,
            }
        }
    },

    watch: {
        search: function () {
            this.loadForums();
        }
    },
    computed: {
        forumableType: function () {
            switch (this.type) {
                case 1:
                    return 'App\\Models\\City';
                case 2:
                    return 'App\\Models\\University';
                case 3:
                    return 'App\\Models\\Apartment';
            }
        },

        loggedIn: function () {
            return localStorage.getItem('user') != undefined ? true : false;
        }
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
        },

        prevPage: function () {
            if(this.forumsMeta.current_page > 1) {
                this.forumsMeta.current_page--;
                this.loadForums();
            }
        },
        nextPage: function () {
            if(this.forumsMeta.current_page < this.forumsMeta.last_page) {
                this.forumsMeta.current_page++;
                this.loadForums();
            }
        },

        saveForum: function () {
            this.$api
                .create('forums', {
                    'forumable_type': this.forumableType,
                    'forumable_uuid': this.uuid,
                    'name': this.newForum.name,
                    'description': this.newForum.description,
                })
                .then((response) => {
                    this.loadForums();
                    this.closeModal();
                })
                .catch((error) => {
                    showSwal(this, 1);
                });
        },

        closeModal: function () {
            var myModalEl = document.getElementById('addForumModal')
            var modal = Modal.getInstance(myModalEl);
            modal.hide();
        },
    },

    mounted() {
        this.loadForums();
    },
}
</script>

<style scoped>
.hvr:hover,
.hvr:focus,
.hvr:active {
    background-color: gray;
    color: greenyellow;
    transition-duration: 0.3s;
}

.hvred {
    background-color: #707070;
}

.bordered {
    border-bottom: 2px solid rgba(255, 255, 255, 0.7);
}
</style>