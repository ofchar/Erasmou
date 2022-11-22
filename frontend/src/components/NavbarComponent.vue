<template>
    <div>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-md">
                <a class="navbar-brand" href="/">Erasmou</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ps-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class='nav-link' to="/countries">Countries</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class='nav-link' to="/cities">Cities</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class='nav-link' to="/universities">Universities</router-link>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="">

</style>