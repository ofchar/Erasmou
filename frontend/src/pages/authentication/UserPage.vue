<template>
    <div>
        <div class="card text-start mt-3 bg-secondary text-white" v-if="user">
            <div class="card-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-4 mt-auto"><h5>Your profile</h5></div>
                </div>
            </div>
            <div class="card-body container">
                <h5 class="card-title">Welcome {{ user.first_name }} {{ user.last_name }}</h5>
                <div class="row justify-content-start">
                    <div class="col">
                        Your current rank is: <b>{{ getRankName(user.type) }}</b>
                        <button class="mx-3 btn btn-dark btn-sm" v-if="user.type < 30" data-bs-toggle="modal"
                            data-bs-target="#verifyModal">Verify now</button>
                    </div>
                </div>

                <div class="row mt-5 mb-2">
                    <div class="col">
                        <label class="h5">Your details:</label>
                    </div>
                    <div class="col">
                        <button class="btn btn-dark" @click="editing = (editing ? false : true)">Edit</button>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col">
                        <label class="mt-2">Username</label>
                        <div v-if="!editing">{{ user.username }}</div>
                        <input class="form-control" v-else v-model="editUsername"/>

                        <label class="mt-2">Email</label>
                        <div v-if="!editing">{{ user.email }}</div>
                        <input class="form-control" v-else v-model="editEmail"/>
                    </div>
                    <div class="col">
                        <label class="mt-2">Phone</label>
                        <div v-if="!editing">{{ user.phone }}</div>
                        <input class="form-control" v-else v-model="editPhone"/>

                        <label class="mt-2">Country, city</label>
                        <div>{{ user.country.name }}, {{ user.city.name }}</div>
                    </div>
                </div>

                <div class="row justify-content-start">
                    <label class="mt-2">Bio</label>
                    <div v-if="!editing">{{ user.bio }}</div>
                    <textarea class="form-control" v-else v-model="editBio"/>
                </div>

                <div class="row">
                    <button v-if="editing" class="mt-3 btn btn-dark form-control" @click="saveChanges">Save changes</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyModal">Verify account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Please paste the verification code given by ESN Section</label>
                        <input class="form-control" v-model="verificationCode">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="verify()">Verify!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { showSwal } from '@/services/swalDisplay.js'
import { Modal } from 'bootstrap';

export default {
    components: {
        //
    },
    props: [
        //
    ],

    data() {
        return {
            user: null,

            verificationCode: null,

            ranks: {
                10: 'Not verified',
                20: 'Future Erasmus',
                30: 'Verified Erasmus',
                40: 'ESN member',
                100: 'Admin',
            },

            editing: false,
        }
    },

    watch: {
        //
    },
    computed: {
        //
    },

    methods: {
        getRankName: function (rank) {
            return this.ranks[rank];
        },

        verify: function () {
            this.$api
                .put('webapi/users/' + this.user.uuid + '/verify', {
                    'verification_code': this.verificationCode,
                })
                .then((response) => {
                    showSwal(this, 3, 'Success!', 'Changes will appear after a relog')
                    .then((action) => {
                        this.closeModal();
                    });
                })
                .catch((error) => {
                    showSwal(this, 1, 'Ooops', 'This did not work :(');
                });
        },
        closeModal: function () {
            var myModalEl = document.getElementById('verifyModal')
            var modal = Modal.getInstance(myModalEl);
            modal.hide();
        },

        saveChanges: function () {
            this.$api
                .update('users', this.user.uuid, {
                    'username': this.editUsername,
                    'phone': this.editPhone,
                    'email': this.editEmail,
                    'bio': this.editBio,
                })
                .then((response) => {
                    showSwal(this, 3, 'Success!', 'Changes will appear after a relog')
                    .then((action) => {
                        this.editing = false;
                    });
                })
                .catch((error) => {
                    showSwal(this, 1, 'Ooops', 'This did not work :(');
                });
        },
    },

    mounted() {
        this.user = JSON.parse(localStorage.getItem('user'));

        this.editUsername = this.user.username;
        this.editEmail = this.user.email;
        this.editPhone = this.user.phone;
        this.editBio = this.user.bio;
    },
}
</script>

<style>
label {
    font-weight: bold;
}

</style>