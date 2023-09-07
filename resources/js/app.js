// window.Vue = require("vue").default;
import './bootstrap';

import { createApp } from 'vue';
import App from './pages/App.vue';
import router from "./router/index";
import store from './store/index';

const app = createApp(App).use(router).use(store).mount("#app");
