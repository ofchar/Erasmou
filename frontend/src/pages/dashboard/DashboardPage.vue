<template>
	<div class="">
		<header class="masthead">
			<div class="container position-relative">
				<div class="row justify-content-center">
					<div class="col-xl-6">
						<div class="text-center text-white">
							<h1 class="mb-5">Make the most from your Erasmus with Erasmou!</h1>

							<div class="row justify-content-center" v-if="!isLogged">
								<div class="col-md-3">
									<router-link class='nav-link' to="/login"><button class="btn btn-primary btn-lg">I'm back!</button></router-link>

								</div>
								<div class="col-md-3">
									<router-link class='nav-link' to="/register"><button class="btn btn-primary btn-lg">I'm new!</button></router-link>
								</div>
							</div>
							<div class="row justify-content-center lead" v-else>
								Welcome back {{ user.first_name }} {{ user.last_name }}!
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- Icons Grid-->
		<section class="features-icons bg-light text-center">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
							<div class="features-icons-icon d-flex justify-content-center">
								<font-awesome-icon size="4x" icon="fa-solid fa-check-double"/>
							</div>
							<h3>100% verified</h3>
							<p class="lead mb-0">We make sure that data comes only from verified Erasmus students.</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
							<div class="features-icons-icon d-flex justify-content-center">
								<font-awesome-icon size="4x" icon="fa-solid fa-sitemap" />
							</div>
							<h3>Organized for you</h3>
							<p class="lead mb-0">All of the information neatly organized.</p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="features-icons-item mx-auto mb-0 mb-lg-3">
							<div class="features-icons-icon d-flex justify-content-center">
								icon here
							</div>
							<h3>Some other feature</h3>
							<p class="lead mb-0">I'm yet to think of</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
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
            isLogged: false,
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
		let user = localStorage.getItem('user');

        if (user) {
            this.user = JSON.parse(user);
            this.isLogged = true;
        }
        else {
            this.user = null;
            this.isLogged = false;
        }
	},
}
</script>

<style scoped lang="scss">
.features-icons {
    padding-top: 7rem;
    padding-bottom: 7rem;

    .features-icons-item {
        max-width: 20rem;

        .features-icons-icon {
            height: 7rem;

            i {
                font-size: 4.5rem;
            }
        }
    }
}

header.masthead {
    background-color: rgb(93, 93, 93);
    // background: url('../assets/img/bg-masthead.jpg') no-repeat center center;
    background-size: cover;
    padding-top: 8rem;
    padding-bottom: 8rem;

    h1 {
        font-size: 2rem;
    }
}
</style>