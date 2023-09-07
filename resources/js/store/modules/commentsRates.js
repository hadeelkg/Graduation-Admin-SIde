import http from '../../utils/axios/admin';

let state = {
    comments:{
        data:[],
        meta:{},
        links:{}
    },
    comment:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchComments({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/comments').then((response) => {
                    commit('setComments', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    fetchComment({ commit }, commentId) {
        return new Promise((resolve, reject) => {
            http.get('/api/v1/comments/'+ commentId).then((response) => {
                    commit('setOldComment', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
    NewComment({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/v1/comments', data).then((response) => {
                    commit('setCategory', response.data);
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
    // updateCategory({ commit }, data) {
    //     return new Promise((resolve, reject) => {
    //         http.post('/api/v1/comments/'+ data.get('id')).then((response) => {
    //                 commit('updateCategory', response.data);
    //                 resolve(response);
    //             })
    //             .catch((error) => { 
    //                 reject(); 
    //             });
    //     });
    // },
    deleteComment({ commit }, commentId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/v1/comments/'+ commentId).then((response) => {
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setComments(state,data){
        state.comments = data;
    },
    setOldComment(state,data){
        state.comments = data;
    },
    setCategory(state,data){
        state.category.data = data;
    },
    // updateCategory(state,data){
    //     state.category.data = data;
    // },
    cleanErrors(state,errors){
        state.comment.errors = {};
    },
    setErrors(state,errors){
        state.comment.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};