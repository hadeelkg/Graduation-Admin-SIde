import http from '../../utils/axios/admin';

let state = {
    token: localStorage.getItem('admin/user-token') || '',
    // loggedUserPermissions: localStorage.getItem('forma-permissions'),
    errors: {},
    Loading: false,
};

const getters = {
    authToken(state) {
        return state.token;
    },
    // loggedUserPermissions: (state) => {
    //     return localStorage.getItem('forma-permissions')
    // },
};

const actions = {
    authRequest({ commit }, { email, password}) {
        return new Promise((resolve, reject) => {
            http.post('/api/dashboard/login', {
                    email,
                    password,
                })
                .then(response => {
                    commit('authSuccess', response.data.token);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('authError', error.response.data);
                    }
                    reject(error);
                });
        });
    },

    authLogout({ commit }) {
        return new Promise((resolve, reject) => {
            http.post('/api/dashboard/logout').then((response) => {
                    commit('authLogout');
                    resolve(response);
                })
                .catch((error) => {
                    // commit('authLogout');
                    console.log(error);
                    reject(error);
                });
        });
    },
};

const mutations = {
    authSuccess(state, token) {
        localStorage.setItem('admin/user-token', token);
        state.token = token;
        state.errors = {};
    },
    authError(state, errors) {
        localStorage.removeItem('admin/user-token');
        state.errors = errors.errors;
        state.token = '';
    },
    authLogout(state) {
        localStorage.removeItem('admin/user-token');
        localStorage.removeItem('forma-permissions');
        state.token = '';
    },
    PleaseStopLoading(state) {
        state.Loading = false;
    },
    PleaseStartLoading(state) {
        state.Loading = true;
    },
};

export default {
    state,
    mutations,
    actions,
    getters,
};
