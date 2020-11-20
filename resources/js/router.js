import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


//Define Route
const router = new Router({
    mdoe: 'history',
    routes: [{
            path: '/',
            name: 'home',
            alias: '/home',
            component: () =>
                import ('./views/Home.vue')
        },
        {
            path: '/donations',
            name: 'donations',
            component: () =>
                import ('./views/Donations.vue')
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
});

export default router