import Vuex from 'vuex';
import auth from './modules/auth';
import admins from './modules/admins';
import brands from './modules/brands';
import categories from './modules/categories';
import cities from './modules/cities';
import clients from './modules/clients';
import commentsRates from './modules/commentsRates';
import orders from './modules/orders';
import products from './modules/products';
import presOrders from './modules/presOrders';
import pharmacists from './modules/pharmacists';
import statistics from './modules/statistics';


const store = new Vuex.Store({
    modules: {
        admin: {
            namespaced: true,
            modules: {
                Authentication:auth,
                Admins:admins,
                Brands:brands,
                Categories:categories,
                Cities:cities,
                Clients:clients,
                CommentsAndRates:commentsRates,
                Orders:orders,
                Products:products,
                PrescriptionOrders:presOrders,
                Pharmacists:pharmacists,
                Statistics:statistics,
            }
        }
    }
})

export default store;

