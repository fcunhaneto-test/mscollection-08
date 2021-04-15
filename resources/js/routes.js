import VueRouter from "vue-router";

import Login from "./auth/Login";
import Logout from "./auth/Logout";

import App from "./app/App";
import Admin from "./admin/Admin";
import StoreTitle from "./admin/StoreTitle";
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
        component: App,
        name: 'movies',
        props: {table: 'movies'}
    },
    {
        path: '/series/:channel',
        component: App,
        name: 'series',
        props: {table: 'series'}
    },
    {
        path: '/admin/filmes/:channel',
        component: Admin,
        name: 'admin-movies',
        props: {table: 'movies'}
    },
    {
        path: '/admin/series/:channel',
        component: Admin,
        name: 'admin-series',
        props: {table: 'series'}
    },
    {
        path: '/admin/novo/filme',
        component: StoreTitle,
        name: 'store-movies',
        props: {table: 'movies'}
    },
    {
        path: '/admin/nova/serie',
        component: StoreTitle,
        name: 'store-series',
        props: {table: 'series'}
    },
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;
