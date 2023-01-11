import { createWebHistory, createRouter } from "vue-router";
import DashboardPage from '../pages/dashboard/DashboardPage.vue';

import LoginPage from '../pages/authentication/LoginPage.vue';
import RegisterPage from '../pages/authentication/RegisterPage.vue';

import CountryIndexPage from '../pages/country/CountryIndexPage.vue';
import CountryShowPage from '../pages/country/CountryShowPage.vue';

import CityIndexPage from '../pages/city/CityIndexPage.vue';
import CityShowPage from '../pages/city/CityShowPage.vue';

import UniversityIndexPage from '../pages/university/UniversityIndexPage.vue';
import UniversityShowPage from '../pages/university/UniversityShowPage.vue';

import ForumShowPage from '../pages/forum/ForumShowPage.vue';

import ApartmentShowPage from '../pages/apartment/ApartmentShowPage.vue';

import VerificationCodeIndexPage from '../pages/verificationCode/VerificationCodeIndexPage.vue';

import UserPage from '../pages/authentication/UserPage.vue';

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: DashboardPage,
    },

    {
        path: "/login",
        name: "login",
        component: LoginPage,
        // beforeEnter: (to, from, next) => {
        //     next(handleLogged('/'))
        // },
    },
    {
        path: "/register",
        name: "register",
        component: RegisterPage,
    },

    {
        path: "/countries",
        name: "countries",
        component: CountryIndexPage,
    },
    {
        path: "/countries/:uuid",
        name: "countries-show",
        component: CountryShowPage,
    },

    {
        path: "/cities",
        name: "cities",
        component: CityIndexPage,
    },
    {
        path: "/cities/:uuid",
        name: "cities-show",
        component: CityShowPage,
    },

    {
        path: "/universities",
        name: "universities",
        component: UniversityIndexPage,
    },
    {
        path: "/universities/:uuid",
        name: "universities-show",
        component: UniversityShowPage,
    },

    {
        path: "/forums/:uuid",
        name: "forums-show",
        component: ForumShowPage,
    },

    {
        path: "/apartments/:uuid",
        name: "apartments-show",
        component: ApartmentShowPage,
    },

    {
        path: "/verification-codes",
        name: "verification-codes",
        component: VerificationCodeIndexPage,
    },

    {
        path: "/me",
        name: "me",
        component: UserPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

function isAuthorized(requiredAuthLevel = 1, notAuthorizedPath = '/login') {
    var auth = localStorage.getItem('rank');

    if (auth == 0) {
        return '/login'
    } else if (auth >= requiredAuthLevel) {
        return
    } else {
        return notAuthorizedPath
    }
}

function handleLogged(pathLogged) {
    var auth = localStorage.getItem('rank');

    if (auth == 0) {
        return
    } else {
        return pathLogged
    }
}

export default router;