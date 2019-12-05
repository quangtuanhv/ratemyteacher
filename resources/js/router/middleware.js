import Vue from 'vue'
import store from '../store'
import Router from 'vue-router'
import { getUser } from './router'
import {get } from '../helpers/api'


Vue.use(Router)

/**
 * Create a router instance.
 *
 * @param  {Array} routes
 * @return {Router}
 */
export default function router(routes) {
    const router = new Router({
        routes,
        scrollBehavior,
        mode: 'history'
    })

    router.beforeEach((to, from, next) => {
        const components = router.getMatchedComponents(to)
        const access_token = localStorage.getItem('access_token')
            //check access token exists within Api local storage
        if (access_token) {
            store.dispatch('auth/check')
                // get info user
            get(getUser).then((res) => {
                    store.dispatch('auth/setUser', res.data)
                    localStorage.setItem('user', JSON.stringify(res.data))
                    if (localStorage.getItem('redirect_after_login')) {
                        next(localStorage.getItem('redirect_after_login'))
                        localStorage.removeItem('redirect_after_login')
                    } else {
                        next()
                    }
                })
                .catch((err) => {
                    store.dispatch('auth/logout')
                    next({ name: 'login' })
                })
        } else {
            next()
        }

    })

    return router
}

/**
 * Add the "authenticated" guard.
 *
 * @param  {Array} routes
 * @return {Array}
 */
export function authGuard(routes) {
    return guard(routes, (to, from, next) => {
        if (store.state.auth.authenticated) {
            next()
        } else {
            localStorage.setItem('redirect_after_login', to.path)
            next('/login')
        }
    })
}

/**
 * Add the "guest" guard.
 *
 * @param  {Array} routes
 * @return {Array}
 */
export function guestGuard(routes) {
    return guard(routes, (to, from, next) => {
        if (store.state.auth.authenticated) {
            next('/')
        } else {
            next()
        }
    })
}

/**
 * @param  {Array} routes
 * @param  {Function} guard
 * @return {Array}
 */
function guard(routes, guard) {
    routes.forEach(route => {
        route.beforeEnter = guard
    })

    return routes
}

/**
 * @param  {Route} to
 * @param  {Route} from
 * @param  {Object|undefined} savedPosition
 * @return {Object}
 */
function scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
        return savedPosition
    }

    const position = {}

    if (to.hash) {
        position.selector = to.hash
    }

    if (to.matched.some(m => m.meta.scrollToTop)) {
        position.x = 0
        position.y = 0
    }

    return position
}