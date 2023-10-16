import http from '../../utils/axios/admin';


let state = {
    cities:{
        data:[],
        meta:{},
        links:{}
    },
    city:{
        data:'',
        errors:''
    }
};

const actions = {
    fetchCities({ commit }) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/cities').then((response) => {
                    commit('setCities', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    fetchCity({ commit }, cityId) {
        return new Promise((resolve, reject) => {
            http.get('/api/admin/v1/cities/'+ cityId).then((response) => {
                    commit('setOldCity', response.data);
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
    NewCity({ commit }, data) {
        return new Promise((resolve, reject) => {
            http.post('/api/admin/v1/cities', data).then((response) => {
                    commit('setNewCity', response.data);
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
    updateCity({commit}, data){
        return new Promise((resolve, reject) => {
            http.patch('/api/admin/v1/cities/'+data.id, data).then((response) => {
                commit('setUpdatedCity', response.data);
                resolve(response);
            })
            .catch((error) => {
                if (error.response && error.response.status === 422) {
                    commit('setErrors', error.response.data.errors);
                }
                reject(error);
            });
        });
    },
    deleteCity({ commit }, cityId) {
        return new Promise((resolve, reject) => {
            http.delete('/api/admin/v1/cities/'+ cityId).then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    reject();
                });
        });
    },
};

const mutations = {
    setCities(state,data){
        state.cities = data;
    },
    setOldCity(state,data){
        state.cities = data;
    },
    setNewCity(state,data){
        state.city.data = data;
    },
    setUpdatedCity(state,data){
        state.city.data = data;
    },
    cleanCitiesErrors(state,errors){
        state.city.errors = {};
    },
    setErrors(state,errors){
        state.city.errors = errors;
    }
};

export default {
    state,
    actions,
    mutations,
};
