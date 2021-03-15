// vuex
import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () => import('../screens/Login')
    },
    {
        path: '*',
        redirect: '/404'
    },
    {
        path: '/404',
        name: '404',
        component: () => import('../screens/Error404'),
    },
    {
        path: '/app',
        redirect: '/app/home',
        name: 'App',
        component: () => import('../screens/App'),
        children: [
            {
                path: '/app/home',
                name: 'Home',
                component: () => import('../screens/Home'),
                meta: {
                    requiresAuth: true,
                    // role: 'admin|super-admin'
                }
            },
            {
                path: '/app/password',
                name: 'Password',
                component: () => import('../screens/Password'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                path: '/app/profile',
                name: 'Profile',
                component: () => import('../screens/Profile'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                path: '/app/slider',
                name: 'Slider',
                component: () => import('../screens/Slider'),
                meta: {
                    requiresAuth: true,
                }
            },
        ],
    },
];

const router = new VueRouter({
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: routes
});

var NProgress = require('nprogress');

router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start();
    }
    next();
});

router.afterEach((to, from) => {
    NProgress.done();
});


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if(store.state.auth == false){
            next({path: '/pages/login'});
        }
        if (to.matched.some(record => record.meta.role)) {
            let auth = store.state.auth;
            let userRole = auth.data.role;
            let metaRole = to.meta.role;
            let splitMetaRole = metaRole.split('|');
            if (splitMetaRole.indexOf(userRole) > -1) {
                next();
            } else {
                next({path: '/pages/404'});
            }
        }
        next();
    } else {
        next();
    }
});


//end generated views

window.NProgress = require('nprogress');

const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
};

Vue.use(VueRouter);

export default router;
