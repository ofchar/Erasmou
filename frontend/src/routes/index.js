import { createWebHistory, createRouter } from "vue-router";
import DashboardPage from '../pages/dashboard/DashboardPage.vue';
import CountryIndexPage from '../pages/country/CountryIndexPage.vue';

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: DashboardPage,
    },
    // {
    //     path: "/login",
    //     name: "login",
    //     component: LoginPage,
    //     beforeEnter: (to, from, next) => {
    //         next(handleLogged('/'))
    //     },
    // },
    // {
    //     path: "/register",
    //     name: "register",
    //     component: RegisterPage,
    //     beforeEnter: (to, from, next) => {
    //         next(handleLogged('/'))
    //     },
    // },
    {
        path: "/countries",
        name: "countries",
        component: CountryIndexPage,
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