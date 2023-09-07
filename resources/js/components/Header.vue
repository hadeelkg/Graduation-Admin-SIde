<template>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <a class="navbar-brand back" @click="back()">
          <i class="material-icons">arrow_forward</i>
        </a>
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li style="font-size: 13px !important; cursor: pointer; display: flex; padding: 10px;" @click="logout()">
                <i class="material-icons" style="color: red; font-size: 20px; margin-left: 5px;">logout</i>
                <p>
                  تسجيل الخروج
                </p>
            </li>
          </ul>
        </div>
    </div>
  </nav>
  <!-- End Navbar -->
</template>

<script>
  import { mapState} from 'vuex';
  import store from '../store/index.js';
  export default {

    computed:{
      ...mapState({
        }),
    },

    methods:{

      logout(){
        store.commit('admin/PleaseStartLoading');
        this.$store.dispatch("admin/authLogout").then(() => {
          this.$router.push({ name: "admin.login" });
          store.commit('admin/PleaseStopLoading');
        });
      },

      back(){
        this.$router.go(-1);
      },
      
    }
  }

</script>

<style>
  .back{
    cursor: pointer;
    width: 50px;
    height: 50px;
    background-color: #37517e;
    border-radius: 50%;
    text-align: center;
    color: #fff !important;
  }
  .navbar-expand-lg .navbar-nav .dropdown-menu-right {
    right: auto;
    left: 0;
  }
  .dropdown-menu{
    max-height: 400px;
    overflow-y: auto;
  }
  .not-seen{
    background: #c62254;
    color: white !important;
  }
</style>
