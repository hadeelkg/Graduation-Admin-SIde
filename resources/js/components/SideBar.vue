<template>
    <div class="sidebar" data-color="purple" data-background-color="white">
      <div class="logo">
        <img src="/img/logo_main.png" alt="logo" class="center-logo">
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <NavSingle MainTitle="لوحة التحكم" Path="admin.dashboard.home" Icon="apps" />
            <NavSingle :Active="$route.name.includes('admin.dashboard.cit')" MainTitle="إدارة المدن" Path="admin.dashboard.cities.list" Icon="apartment"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.categor')" MainTitle="إدارة الفئات" Path="admin.dashboard.categories.list" Icon="category"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.brand')" MainTitle="إدارة العلامات التجارية" Path="admin.dashboard.brands.list" Icon="star_rate"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.product')" MainTitle="ادارة المنتجات" Path="admin.dashboard.products.list" Icon="medical_services"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.client')" MainTitle="إدارة العملاء" Path="admin.dashboard.clients.list" Icon="group_add"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.comment')" MainTitle="إدارة التعليقات" Path="admin.dashboard.comments.list" Icon="rate_review"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.order')" MainTitle="إدارة الطلبيات" Path="admin.dashboard.orders.list" Icon="article"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.prescriptionOrder')" MainTitle="ادارة الوصفات الطبية" Path="admin.dashboard.prescriptionOrders.list" Icon="medication_liquid"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.pharmacist')" MainTitle="ادارة الصيادلة" Path="admin.dashboard.pharmacists.list" Icon="badge"/>
            <NavSingle :Active="$route.name.includes('admin.dashboard.admin')" MainTitle="ادارة المسؤولون" Path="admin.dashboard.admins.list" Icon="admin_panel_settings"/>
            <NavSingle  MainTitle="تسجيل الخروج " Icon="logout" class="myColor"  @logout="logout()" />
        </ul>
      </div>
    </div>
</template>

<script>
  import NavSingle from './NavSingle';
  import store from '../store/index';
  import { mapState,mapGetters} from 'vuex';

  export default {

    data(){
        return{
            id:""
        }
    },

    components:{
        NavSingle
    },

    created(){
        this.id = localStorage.getItem("admin/user-id");
    },

    methods:{

      logout(){
        store.commit('admin/PleaseStartLoading');
        this.$store.dispatch("admin/authLogout", this.id).then((response) => {
          this.$router.push({ name: "admin.login" });
          store.commit('admin/PleaseStopLoading');
        }).catch((error) => {
        })
      },

    },


    computed:{
      ...mapState({
      }),

      // manageService: (state) => (service) => {
      //   return store.getters['admin/canManageService'](service);
      // },
    },

  }

</script>

<style>

  .center-logo{
      width: 125px;
      height: 40px;
      display: block;
      margin-left: auto;
      margin-right: auto;
  }

  @media (max-width: 991px){
    .off-canvas-sidebar nav .navbar-collapse:before, .sidebar:before {
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      position: absolute;
      background-color: #fafafa;
      display: block;
      content: "";
      z-index: 1;
    }
  }

  .myColor{
    color:red !important;
  }

</style>
