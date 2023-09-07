import http from '../../utils/axios/admin';

let state = {
    prescriptionOrders:{
        data:[],
        meta:{},
        links:{}
    },
};

const actions = {
    fetchPrescriptionOrders({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/prescription_order').then((response) => {
                    commit('setPrescriptionOrders', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    fetchPreOrder({ commit }, preOrderId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/prescription_order/'+ preOrderId).then((response) => {
                    commit('getOldPreOrder', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    // NewCategory({ commit }, data) {
    //     return new Promise((resolve, reject) => {
    //         http.post('/api/v1/categories', data).then((response) => {
    //                 commit('setCategory', response.data);
    //                 resolve(response);
    //             })
    //             .catch((error) => { 
    //                 reject(); 
    //             });
    //     });
    // },
    // updateCategory({ commit }, data) {
    //     return new Promise((resolve, reject) => {
    //         http.post('/api/v1/categories/'+ data.get('id')).then((response) => {
    //                 commit('updateCategory', response.data);
    //                 resolve(response);
    //             })
    //             .catch((error) => { 
    //                 reject(); 
    //             });
    //     });
    // },
    deletePreOrder({ commit }, preOrderId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/prescription_order/'+ preOrderId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setPrescriptionOrders(state,data){
        state.prescriptionOrders = data;
    },
    getOldPreOrder(state,data){
        state.prescriptionOrders = data;
    },
    // setCategory(state,data){
    //     state.category.data = data;
    // },
    // updateCategory(state,data){
    //     state.category.data = data;
    // },
};

export default {
    state,
    actions,
    mutations
};