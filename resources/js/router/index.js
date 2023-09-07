import { createRouter, createWebHistory } from "vue-router";
const routes = [
    {
        path: '/',
        component: () =>
            import ('../pages/Authentication/Login.vue'),
        name: 'admin.login',
        meta: {
            guest: true,
        }
    },
    {
        
        path: '/home',
        component: () =>
            import ('../pages/Home.vue'),
        children: [{
                path: '/home',
                component: () =>
                    import ('../pages/Dashboard/Dashboard.vue'),
                name: 'admin.dashboard.home',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/admins/list',
                component: () =>
                    import ('../pages/Dashboard/AdminsManagement/AdminsList.vue'),
                name: 'admin.dashboard.admins.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/admin',
                component: () =>
                    import ('../pages/Dashboard/AdminsManagement/AdminForm.vue'),
                name: 'admin.dashboard.admin.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/admin/:id',
                component: () =>
                    import ('../pages/Dashboard/AdminsManagement/AdminForm.vue'),
                name: 'admin.dashboard.admin.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/admin/:id/details',
                component: () =>
                    import ('../pages/Dashboard/AdminsManagement/AdminDetails.vue'),
                name: 'admin.dashboard.admin.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/brands/list',
                component: () =>
                    import ('../pages/Dashboard/BrandsManagement/BrandsList.vue'),
                name: 'admin.dashboard.brands.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/brand',
                component: () =>
                    import ('../pages/Dashboard/BrandsManagement/BrandForm.vue'),
                name: 'admin.dashboard.brand.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/brand/:id',
                component: () =>
                    import ('../pages/Dashboard/BrandsManagement/BrandForm.vue'),
                name: 'admin.dashboard.brand.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/brand/:id/details',
                component: () =>
                    import ('../pages/Dashboard/BrandsManagement/BrandDetails.vue'),
                name: 'admin.dashboard.brand.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/categories/list',
                component: () =>
                    import ('../pages/Dashboard/CategoriesManagement/CategoriesList.vue'),
                name: 'admin.dashboard.categories.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/category/create',
                component: () =>
                    import ('../pages/Dashboard/CategoriesManagement/CategoryForm.vue'),
                name: 'admin.dashboard.category.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/category/:id',
                component: () =>
                    import ('../pages/Dashboard/CategoriesManagement/CategoryForm.vue'),
                name: 'admin.dashboard.category.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/category/:id/details',
                component: () =>
                    import ('../pages/Dashboard/CategoriesManagement/CategoryDetails.vue'),
                name: 'admin.dashboard.category.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/cities/list',
                component: () =>
                    import ('../pages/Dashboard/CitiesManagement/CitiesList.vue'),
                name: 'admin.dashboard.cities.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/city/create',
                component: () =>
                    import ('../pages/Dashboard/CitiesManagement/CityForm.vue'),
                name: 'admin.dashboard.city.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/city/:id',
                component: () =>
                    import ('../pages/Dashboard/CitiesManagement/CityForm.vue'),
                name: 'admin.dashboard.city.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/city/:id/details',
                component: () =>
                    import ('../pages/Dashboard/CitiesManagement/CityDetails.vue'),
                name: 'admin.dashboard.city.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/clients/list',
                component: () =>
                    import ('../pages/Dashboard/ClientsManagement/ClientsList.vue'),
                name: 'admin.dashboard.clients.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/client',
                component: () =>
                    import ('../pages/Dashboard/ClientsManagement/ClientForm.vue'),
                name: 'admin.dashboard.client.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/client/:id',
                component: () =>
                    import ('../pages/Dashboard/ClientsManagement/ClientForm.vue'),
                name: 'admin.dashboard.client.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/client/:id/details',
                component: () =>
                    import ('../pages/Dashboard/ClientsManagement/ClientDetails.vue'),
                name: 'admin.dashboard.client.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/comments/list',
                component: () =>
                    import ('../pages/Dashboard/CommentsManagement/CommentsList.vue'),
                name: 'admin.dashboard.comments.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/comment',
                component: () =>
                    import ('../pages/Dashboard/CommentsManagement/CommentForm.vue'),
                name: 'admin.dashboard.comment.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/update/comment/:id',
                component: () =>
                    import ('../pages/Dashboard/CommentsManagement/CommentForm.vue'),
                name: 'admin.dashboard.comment.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/comment/:id/details',
                component: () =>
                    import ('../pages/Dashboard/CommentsManagement/CommentDetails.vue'),
                name: 'admin.dashboard.comment.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/orders/list',
                component: () =>
                    import ('../pages/Dashboard/OrdersManagement/OrdersList.vue'),
                name: 'admin.dashboard.orders.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/order',
                component: () =>
                    import ('../pages/Dashboard/OrdersManagement/OrderForm.vue'),
                name: 'admin.dashboard.order.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/order/:id',
                component: () =>
                    import ('../pages/Dashboard/OrdersManagement/OrderForm.vue'),
                name: 'admin.dashboard.order.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/order/:id/details',
                component: () =>
                    import ('../pages/Dashboard/OrdersManagement/OrderDetails.vue'),
                name: 'admin.dashboard.order.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/pharmacists/list',
                component: () =>
                    import ('../pages/Dashboard/PharmacistsManagement/PharmacistsList.vue'),
                name: 'admin.dashboard.pharmacists.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/pharmacist',
                component: () =>
                    import ('../pages/Dashboard/PharmacistsManagement/PharmacistForm.vue'),
                name: 'admin.dashboard.pharmacist.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/pharmacist/:id',
                component: () =>
                    import ('../pages/Dashboard/PharmacistsManagement/PharmacistForm.vue'),
                name: 'admin.dashboard.pharmacist.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/pharmacist/:id/details',
                component: () =>
                    import ('../pages/Dashboard/PharmacistsManagement/PharmacistDetails.vue'),
                name: 'admin.dashboard.pharmacist.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/prescriptionOrders/list',
                component: () =>
                    import ('../pages/Dashboard/PrescriptionOrdersManagement/PrescriptionOrdersList.vue'),
                name: 'admin.dashboard.prescriptionOrders.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/prescriptionOrders',
                component: () =>
                    import ('../pages/Dashboard/PrescriptionOrdersManagement/PrescriptionForm.vue'),
                name: 'admin.dashboard.prescriptionOrders.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/prescriptionOrders/:id',
                component: () =>
                    import ('../pages/Dashboard/PrescriptionOrdersManagement/PrescriptionForm.vue'),
                name: 'admin.dashboard.prescriptionOrders.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/prescriptionOrders/:id/details',
                component: () =>
                    import ('../pages/Dashboard/PrescriptionOrdersManagement/PrescriptionDetails.vue'),
                name: 'admin.dashboard.prescriptionOrders.details',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/products/list',
                component: () =>
                    import ('../pages/Dashboard/ProductsManagement/ProductsList.vue'),
                name: 'admin.dashboard.products.list',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/create/product',
                component: () =>
                    import ('../pages/Dashboard/ProductsManagement/ProductForm.vue'),
                name: 'admin.dashboard.product.create',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/edit/product/:id',
                component: () =>
                    import ('../pages/Dashboard/ProductsManagement/ProductForm.vue'),
                name: 'admin.dashboard.product.edit',
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: '/product/:id/details',
                component: () =>
                    import ('../pages/Dashboard/ProductsManagement/ProductDetails.vue'),
                name: 'admin.dashboard.product.details',
                meta: {
                    requiresAuth: true,
                },
            },
        ],

    },

    {
        path: '/:pathMatch(.*)*',
        component: () =>
            import ('../pages/Helpers/Page404.vue'),
    }

];




/**
 * # Auth Middleware.
 * ----------------------
 * Redirect any route that requires auth to login view.
 */

// router.beforeEach((to, from, next) => {
//     let userToken = localStorage.getItem('admin/user-token');

//     // console.log(to);
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         let name = 'admin.login';

//         if (userToken === null) {
//             next({
//                 name: name,
//                 params: { nextUrl: to.fullPath }
//             });
//         } else {
//             next();
//         }
//     } else if (to.matched.some(record => record.meta.guest)) {
//         if (userToken == null) {
//             next();
//         } else {
//             next({ name: 'admin.dashboard.home' });
//         }
//     } else {
//         next();
//     }
// });

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL),
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
                behavior: "smooth",
            };
        }
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});
export default router;