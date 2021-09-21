import Router from 'vue-router'
import Vue from "vue";
Vue.use(Router)
import home from "./components/home";
import login from "./components/login";
import logout from "./components/logout";
import adminusers from "./components/adminusers";
import tags from "./components/tags";
import role from "./components/role";
import permission from "./components/permission";

const routes = [
    {
        path: '/',
        component: home,
        name: '/'
    },
    {
        path: '/login',
        component: login,
        name: 'login'
    },
    {
        path: '/logout',
        component: logout,
        name: 'logout'
    },
    {
        path: '/adminusers',
        component: adminusers,
        name: 'adminusers'
    },
    {
        path: '/tags',
        component: tags,
        name: 'tags'
    },
    {
        path: '/role',
        component: role,
        name: 'role'
    },
    {
        path: '/permission',
        component: permission,
        name: 'permission'
    },
]

export default new Router({
    mode: 'history',
    routes
})
