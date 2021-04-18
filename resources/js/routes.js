import VueRouter from "vue-router";

import Login from "./auth/Login";
import Logout from "./auth/Logout";

import App from "./app/App";
import Admin from "./admin/Admin";
import StoreTitle from "./admin/StoreTitle";
import EditTitle from "./admin/EditTitle";

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
        props: {table: 1}
    },
    {
        path: '/series/:channel',
        component: App,
        name: 'series',
        props: {table: 0}
    },
    {
        path: '/admin/filmes/:channel',
        component: Admin,
        name: 'admin-movies',
        props: {table: 1}
    },
    {
        path: '/admin/series/:channel',
        component: Admin,
        name: 'admin-series',
        props: {table: 0}
    },
    {
        path: '/admin/novo/filme',
        component: StoreTitle,
        name: 'store-movies',
        props: {table: 1}
    },
    {
        path: '/admin/nova/serie',
        component: StoreTitle,
        name: 'store-series',
        props: {table: 0}
    },
    {
        path: '/admin/editar/filme',
        component: EditTitle,
        name: 'edit-movie',
    },
    {
        path: '/admin/editar/series',
        component: EditTitle,
        name: 'edit-series',
    },
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;
