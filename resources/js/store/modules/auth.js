import http from '../../utils/axios/admin';

let state = {
    token: localStorage.getItem('admin/user-token') || '',
    errors: {},
    Loading: false,
};

const getters = {
    authToken(state) {
        return state.token;
    },
};

const actions = {
    authRequest({ commit }, { email, password}) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/login', {
                    email,
                    password,
                })
                .then(response => {
                    commit('authSuccess', response.data);
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

    authLogout({ commit }, id) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/logout', {id}).then((response) => {
                    commit('authLogout');
                    resolve(response);
                })
                .catch((error) => {
                    console.log(error);
                    reject(error);
                });
        });
    },
};

const mutations = {
    authSuccess(state, data) {
        localStorage.setItem('admin/user-token', data.token);
        localStorage.setItem('admin/user-id', data.id);
        state.token = data.token;
        state.errors = {};
    },
    authError(state, errors) {
        localStorage.removeItem('admin/user-token');
        state.errors = errors.errors;
        state.token = '';
    },
    authLogout(state) {
        localStorage.removeItem('admin/user-token');
        localStorage.removeItem('admin/user-id');
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
