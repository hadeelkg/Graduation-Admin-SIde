import http from '../../utils/axios/admin';


let state = {
    pharmacists:{
        data:[],
        meta:{},
        links:{}
    },
    pharmacist:{
        data:'',
        errors:''
    },
};

const actions = {
    fetchPharmacists({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/pharmacists').then((response) => {
                    commit('setPharmacists', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });

    },
    fetchPharmacist({ commit }, pharmacistId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/pharmacists/'+ pharmacistId).then((response) => {
                    commit('setOldPharmacist', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    NewPharmacist({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/pharmacists', data).then((response) => {
                    commit('setPharmacist', response.data);
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
    updatePharmacist({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.patch('/api/v1/pharmacists/'+ data.id, data).then((response) => {
                    commit('setUpdatedPharmacist', response.data);
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
    deletePharmacist({ commit }, pharmaId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/pharmacists/'+ pharmaId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setPharmacists(state,data){
        state.pharmacists = data;
    },
    setOldPharmacist(state,data){
        state.pharmacists = data;
    },
    setPharmacist(state,data){
        state.pharmacist.data = data;
    },
    setUpdatedPharmacist(state,data){
        state.pharmacist.data = data;
    },
    cleanPharmacistErrors(state,errors){
        state.pharmacist.errors = {};
    },
    setErrors(state,errors){
        state.pharmacist.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};