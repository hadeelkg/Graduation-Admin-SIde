import http from '../../utils/axios/admin';

let state = {
    statistics:{
        data:[],
        meta:{},
        links:{}
    },
};

const actions = {
    fetchStatistics({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/statistics').then((response) => {
                    commit('setStatistics', response.data);
                    resolve(response);
                })
                .catch((error) => { 
                    reject(); 
                });
        });
    },
};

const mutations = {
    setStatistics(state,data){
        state.statistics = data;
    },
};

export default {
    state,
    actions,
    mutations
};