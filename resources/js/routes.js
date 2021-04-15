import VueRouter from "vue-router";

import Login from "./auth/Login";
import Logout from "./auth/Logout";

import Titles from "./frontend/Titles";
const routes = [
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/logout',
        component: Logout,
        name: 'logout'
    },
    {
        path: '/filmes/:channel',
        component: Titles,
        name: 'movies',
        props: {table: 'movies'}
    },
    {
        path: '/series/:channel',
        component: Titles,
        name: 'series',
        props: {table: 'series'}
    },
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;
