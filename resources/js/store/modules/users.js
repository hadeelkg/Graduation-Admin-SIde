import http from '../../utils/axios/admin';
let state = {
    users: {
        data: {},
        error: {},
    },
    user:{
        data:'',
        errors:''
    },
}


let actions = {

    fetchUsersList({ commit }){
        return new Promise((resolve, reject) => {
            http.get('/api/dashboard/users').then((response) => {
                commit('setUserList', response.data);
                resolve(response);
            }).catch((errors) => {
                reject(errors);
            })
        })
    },

    createUser({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/dashboard/users', data).then((response) => {
                commit('setUser', response.data);
                resolve(response);
            }).catch((error) => {
                if (error.response && error.response.status === 422) {
                    commit('setUserError', error.response.data.errors);
                }
                reject(error.response);
            })
        });
    },

    fetchSpecificUser({ commit }, uuid) {
        return new Promise((resolve, reject) => {
            http.get('/api/dashboard/users/'+uuid).then((response) => {
                commit('setOldUser', response.data);
                resolve(response);
            }).catch((errors) => {
                reject(errors);
            })
        })
    },

    updateUser({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/dashboard/users/' + data.get('id'), data).then((response) => {
                commit('setUpdatedUser', response.data);
                resolve(response);
            }).catch((error) => {
                if (error.response && error.response.status === 422) {
                    commit('setUserError', error.response.data.errors);
                }
                reject(error.response);
            })
        });
    },

    deleteUser({commit}, uuid){
        return new Promise((resolve, reject) => {
            http.delete('/api/dashboard/users/'+ uuid).then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject();
            });
        });
    },


}


let mutations = {
    setUserInfo(state, user) {
        state.AuthUser = user;
    },
    setUserList(state, data) {
        state.users = data;
    },
    setOldUser(state, data){
        state.users = data;
    },
    setUser(state, data) {
        state.user.data = data;
    },
    setUpdatedUser(state, data){
        state.User.data = data;
    },
    setUserError(state, errors) {
        state.user.errors = errors;
    },
    cleanUserErrors(state, error) {
        state.user.errors = {};
    },
}

export default {
    state,
    actions,
    mutations,
}
