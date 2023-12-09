import http from '../../utils/axios/admin';

let state = {
    prescriptionOrders:{
        data:[],
        meta:{},
        links:{}
    },
    preOrder:{
        data:'',
        errors:''
    },
};

const actions = {
    fetchPrescriptionOrders({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/prescription_order').then((response) => {
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
            http.get('/api/admin/v1/prescription_order/'+ preOrderId).then((response) => {
                    commit('getOldPreOrder', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    updatePreOrder({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/prescription_order/'+ data.get('id'), data).then((response) => {
                    commit('setUpdatedPreOrder', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setOrdersErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    deletePreOrder({ commit }, preOrderId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/prescription_order/'+ preOrderId).then((response) => {
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
    setUpdatedPreOrder(state,data){
        state.preOrder.data = data;
    },
};

export default {
    state,
    actions,
    mutations
};
