import {
    CHECK,
    LOGIN,
    LOGOUT,
    SET_USER
} from './mutation-types';
import axios from 'axios'

export default {
    [CHECK](state) {
        state.authenticated = !!localStorage.getItem('access_token')
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`
    },

    [LOGIN](state, data) {
        const token = data.auth.access_token
        state.authenticated = true
        state.user = data.user

        if (data.user.roles[0].id == 1) {
            state.checkAdmin = true
        }
        localStorage.setItem('access_token', token)
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    },

    [LOGOUT](state) {
        state.authenticated = false
        state.user = ''
        localStorage.removeItem('access_token')
        localStorage.removeItem('user')
        axios.defaults.headers.common['Authorization']
    },

    [SET_USER](state, user) {
        state.user = user

        if (typeof state.user.roles[0] != 'undefined' && state.user.roles[0].id == 1) {
            state.checkAdmin = true
        }
    },


};