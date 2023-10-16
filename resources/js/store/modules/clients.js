import http from '../../utils/axios/admin';


let state = {
    clients:{
        data:[],
        meta:{},
        links:{}
    },
    client:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchClients({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/clients').then((response) => {
                    commit('getClients', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    fetchClient({ commit }, clientId) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/clients/'+ clientId).then((response) => {
                    commit('setOldClient', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    NewClient({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/clients', data).then((response) => {
                    commit('setClient', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    updateClient({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/clients/'+ data.id, data).then((response) => {
                    commit('setUpdatedClient', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    deleteClient({ commit }, clientId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/clients/'+ clientId).then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
};

const mutations = {
    getClients(state,data){
        state.clients = data;
    },
    setOldClient(state,data){
        state.clients = data;
    },
    setClient(state,data){
        state.client.data = data;
    },
    setUpdatedClient(state,data){
        state.client.data = data;
    },
    cleanErrors(state,errors){
        state.client.errors = {};
    },
    setErrors(state,errors){
        state.client.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};
