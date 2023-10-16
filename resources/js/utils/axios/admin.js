import axios from 'axios';
import store from '../../store/index';
import router from '../../router/index';
import Vue from 'vue';

// Set config defaults when creating the instance
const admin = axios.create();
admin.defaults.baseURL = "http://127.0.0.1:8000";

// request interceptor.
admin.interceptors.request.use((request) => {
    const token = store.getters['admin/authToken'];

    // const token =localStorage.getItem("Authorization");
    // console.log(token);


    // const locale = Vue.i18n.locale();

    if (token) {
        request.headers['Authorization'] = `Bearer ${token}`;
    }

    request.headers['x-localization'] = 'ar';

    // if (locale) {
    // request.headers.common['Accept-Language'] = 'en';
    // }
    return request;
});

// response interceptor
// admin.interceptors.response.use(response => response, error => {
//     const { status } = error.response;
//     if (status >= 500) {

//         alert(error.response);
//     }

//     if (status == 401) {

//         // store.commit('admin/authLogout');

//         // router.push({ name: 'admin.login' });
//         // });
//     }

//     if (status == 403) {
//         router.push({ name: 'admin.dashboard.home' });
//     }

//     return Promise.reject(error)
// });


export default admin;
