// import http from '@root/utils/axios/admin';
import http from '../../utils/axios/admin';


let state = {
    categories:{
        data:[],
        meta:{},
        links:{}
    },
    category:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchCategories({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/categories').then((response) => {
                    commit('setCategories', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    fetchCategory({ commit }, categoryId) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/categories/'+ categoryId).then((response) => {
                    commit('setOldCategory', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    NewCategory({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/categories', data).then((response) => {
                    commit('setNewCategory', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setCategoryErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    updateCategory({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.patch('/api/admin/v1/categories/'+data.id, data).then((response) => {
                    commit('setUpdatedCategory', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setCategoryErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    deleteCategory({ commit }, categoryId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/categories/'+ categoryId).then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
};

const mutations = {
    setCategories(state,data){
        state.categories = data;
    },
    setOldCategory(state,data){
        state.categories = data;
    },
    setNewCategory(state,data){
        state.category.data = data;
    },
    setUpdatedCategory(state,data){
        state.category.data = data;
    },
    cleanCategoriesErrors(state,errors){
        state.category.errors = {};
    },
    setCategoryErrors(state,errors){
        state.category.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};
