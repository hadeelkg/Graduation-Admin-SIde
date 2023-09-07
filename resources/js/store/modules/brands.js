// import http from '@root/utils/axios/admin';
import http from '../../utils/axios/admin';


let state = {
    brands:{
        data:[],
        meta:{},
        links:{}
    },
    brand:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchBrands({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/brands').then((response) => {
                    commit('setBrands', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    fetchBrand({ commit }, brandId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/brands/'+ brandId).then((response) => {
                    commit('setOldBrand', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    NewBrand({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/brands', data).then((response) => {
                    commit('setNewBrand', response.data);
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
    updateBrand({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.patch('/api/v1/brands/'+ data.id, data).then((response) => {
                    commit('setUpdatedBrand', response.data);
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
    deleteBrand({ commit }, brandId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/brands/'+ brandId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setBrands(state,data){
        state.brands = data;
    },
    setOldBrand(state,data){
        state.brands = data;
    },
    setNewBrand(state,data){
        state.brand.data = data;
    },
    setUpdatedBrand(state,data){
        state.brand.data = data;
    },
    cleanBrandErrors(state,errors){
    state.brand.errors = {};
    },
    setErrors(state,errors){
        state.brand.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};