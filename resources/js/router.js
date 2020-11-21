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
            path: '/blogs',
            name: 'blogs',
            component: () =>
                import ('./views/Blogs.vue')
        },
        {
            path: '/campaigns',
            name: 'campaigns',
            component: () =>
                import ('./views/Campaigns.vue')
        },
        {
            path: '/campaign/:id',
            name: 'campaign',
            component: () =>
                import ('./views/Campaign.vue')
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
});

export default router