import vueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(vueRouter)

import index from "./views/index";
import edit from "./views/edit";

const routes = [
    {
        path: "/",
        component: index
    },
    {
        path: '/edit',
        component: edit
    }
]

export default new vueRouter({
    mode: "history",
    routes: routes
})
