<template>
    <div>
        <div class="card text-start mt-3 bg-secondary text-white" v-if="forum">
            <h5 class="card-header">Discussion</h5>
            <div class="card-body">
                <h5 class="card-title">{{ forum.name }}</h5>
                <p class="card-text">{{ forum.description }}</p>
            </div>
        </div>

        <div class="card text-start mt-3 bg-secondary text-white">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto">
                        <h5>Responses</h5>
                    </div>
                    <div class="col-md-5 text-end mt-auto">
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" v-model="postsSearch" placeholder="search">
                            </div>
                            <div class="col-4 px-3">
                                <button class="btn btn-dark px-5" data-bs-toggle="modal" data-bs-target="#replyModal" :disabled="!loggedIn">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-for="post in posts">
                    <div class="hvr p-1" @mouseenter="post.collapsed = true" @mouseleave="post.collapsed = false">
                        <div class="row m-2 align-items-center text-center">
                            <div class="col-6 text-start">{{ post.title }}</div>
                            <div class="col-3">by {{ post.user.username }}</div>
                            <div class="col-3">{{ formattedDate(post.created_at) }}</div>
                        </div>
                    </div>
                    <CollapseTransition>
                        <div class="container py-2 hvred" v-show="post.collapsed">
                            {{ post.body }}
                        </div>
                    </CollapseTransition>
                </div>
                <div v-if="posts.length == 0">No replies yet, be the first one to reply!</div>
            </div>
            <div class="card-footer">
                Showing {{ postsMeta.from }} to {{ postsMeta.to }} of {{ postsMeta.total }} total
            </div>
        </div>


        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="forumModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forumModal">Reply to the discussion!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Title</label>
                        <input class="form-control" v-model="newPost.title" placeholder="Title"/>

                        <label class="mt-3">Body</label>
                        <textarea class="form-control" v-model="newPost.body" rows="5" placeholder="Body"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveReply()">Reply!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'
import { formatDate } from '@/services/formatDate.js';

import { Modal } from 'bootstrap';
import RankIconDisplayComponentVue from '@/components/utils/RankIconDisplayComponent.vue';
import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue';
import DiscussionComponent from '@/components/forum/DiscussionComponent.vue';

export default {
    components: {
        RankIconDisplayComponentVue,
        CollapseTransition,
        DiscussionComponent,
    },
    props: [
        //
    ],

    data() {
        return {
            uuid: null,
            forum: null,

            posts: [],
            postsMeta: [],
            postsSearch: null,

            newPost: {
                title: null,
                body: null,
            }
        }
    },

    watch: {
        // universitiesSearch: function (value) {
        //     this.loadPosts(value);
        // }
    },
    computed: {
        loggedIn: function () {
            return localStorage.getItem('user') != undefined ? true : false
        }
    },

    methods: {
        loadForum: function () {
            this.$api
                .show('forums', this.uuid)
                .then((response) => {
                    this.forum = response.data.data;
                });
        },

        loadPosts: function (search) {
            this.$api
                .index('posts', {
                    'filter[forum_uuid]': this.uuid,
                    // 'filter[search]': search,
                })
                .then((response) => {
                    this.posts = response.data.data;
                    this.postsMeta = response.data.meta;
                })
        },

        saveReply: function () {
            this.$api
                .create('posts', {
                    'forum_uuid': this.uuid,
                    'title': this.newPost.title,
                    'body': this.newPost.body,
                })
                .then((response) => {
                    this.loadPosts();
                    this.closeModal();
                })
                .catch((error) => {
                    showSwal(this, 1);
                });
        },

        closeModal: function () {
            var myModalEl = document.getElementById('replyModal')
            var modal = Modal.getInstance(myModalEl);
            modal.hide();
        },

        formattedDate: function (date) {
            return formatDate(date);
        }
    },

    mounted() {
        this.uuid = this.$route.params.uuid;

        this.loadForum();
        this.loadPosts();
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