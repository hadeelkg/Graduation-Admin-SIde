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
            http.get('/api/admin/v1/comments').then((response) => {
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
            http.get('/api/admin/v1/comments/'+ commentId).then((response) => {
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
            http.post('/api/admin/v1/comments', data).then((response) => {
                    commit('setNewComment', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setCommentErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    updateComment({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/comments/'+ data.get('id'), data).then((response) => {
                    commit('setUpdatedComment', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        commit('setCommentErrors', error.response.data.errors);
                    }
                    reject();
                });
        });
    },
    deleteComment({ commit }, commentId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/comments/'+ commentId).then((response) => {
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
    setNewComment(state,data){
        state.comment.data = data;
    },
    setUpdatedComment(state,data){
        state.comment.data = data;
    },
    cleanCommentErrors(state,errors){
        state.comment.errors = {};
    },
    setCommentErrors(state,errors){
        state.comment.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations
};
