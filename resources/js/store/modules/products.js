import http from '../../utils/axios/admin';

let state = {
    products:{
        data:[],
        meta:{},
        links:{}
    },
    product:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchProducts({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/products').then((response) => {
                    commit('setProducts', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    fetchProduct({ commit }, productId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/products/'+productId).then((response) => {
                    commit('setOldProduct', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    NewProduct({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/products', data).then((response) => {
                    commit('setProduct', response.data);
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
    updateProduct({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/products/'+data.id, data).then((response) => {
                    commit('setUpdatedProduct', response.data);
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
    deleteProduct({ commit }, productId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/products/'+ productId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setProducts(state,data){
        state.products = data;
    },
    setOldProduct(state,data){
        state.products = data;
    },
    setProduct(state,data){
        state.product.data = data;
    },
    setUpdatedProduct(state,data){
        state.product.data = data;
    },
    cleanProductErrors(state,errors){
        state.product.errors = {};
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