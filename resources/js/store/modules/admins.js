import http from '../../utils/axios/admin';

let state = {
    adminsList:{
        data:[],
        meta:{},
        links:{}
    },
    admin:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchAdmins({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/admins').then((response) => {
                    commit('setAdmins', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    fetchAdmin({ commit }, adminId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/admins/'+ adminId).then((response) => {
                    commit('setOldAdmin', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    addNewAdmin({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/admins', data).then((response) => {
                    commit('setNewAdmin', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    if (error.response && error.response.status === 422) {
                        commit('setAdminsErrors', error.response.data.errors);
                    }
                    reject(); 
                });
        });
    },
    updateAdmin({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.patch('/api/v1/admins/'+ data.id, data).then((response) => {
                    commit('setUpdatedAdmin', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    if (error.response && error.response.status === 422) {
                        commit('setAdminsErrors', error.response.data.errors);
                    }
                    reject(); 
                });
        });
    },
    deleteAdmin({ commit }, adminId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/admins/'+ adminId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setAdmins(state,data){
        state.adminsList = data;
    },
    setOldAdmin(state,data){
        state.adminsList = data;
    },
    setNewAdmin(state,data){
        state.admin.data = data;
    },
    setUpdatedAdmin(state,data){
        state.admin.data = data;
    },
    cleanAdminErrors(state,errors){
        state.admin.errors = {};
    },
    setAdminsErrors(state,errors){
        state.admin.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};