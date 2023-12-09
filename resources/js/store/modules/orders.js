import http from '../../utils/axios/admin';

let state = {
    orders:{
        data:[],
        meta:{},
        links:{}
    },
    order:{
        data:'',
        errors:''
    },
    orderProducts:{
        data:[],
        meta:{},
        links:{}
    }
};

const actions = {
    fetchOrders({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/orders').then((response) => {
                    commit('setOrders', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });

    },
    fetchOrderProducts({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/order_products').then((response) => {
                    commit('getOrderProducts', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    fetchOrder({ commit }, orderId) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/orders/'+ orderId).then((response) => {
                    commit('getOldOrder', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    NewOrder({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/orders', data).then((response) => {
                    commit('setNewOrder', response.data);
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
    updateOrder({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/orders/'+ data.get('id'), data).then((response) => {
                    commit('setUpdatedOrder', response.data);
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
    deleteOrder({ commit }, orderId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/orders/'+ orderId).then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
};

const mutations = {
    setOrders(state,data){
        state.orders = data;
    },
    getOrderProducts(state,data){
        state.orderProducts = data;
    },
    getOldOrder(state,data){
        state.orders = data;
    },
    setNewOrder(state,data){
        state.order.data = data;
    },
    setUpdatedOrder(state,data){
        state.order.data = data;
    },
    cleanOrdersErrors(state,errors){
        state.order.errors = {};
    },
    setOrdersErrors(state,errors){
        state.order.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};
