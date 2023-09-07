<template>
  <div class="container-fluid">
    <Statistics/>
  </div>
</template>

<script>
  import { mapState} from 'vuex';
  import store from '../../store/index';
  import Statistics from '../../components/Statistics.vue';
  export default {
    data(){
      return {
        DashBoardToggle:true,
      }
    },

    computed:{
      ...mapState({
        // user: state => state.admin.users.AuthUser,  
      }),
      
      // isAdmin(){
      //   return this.user.roles[0].name == 'Admin';
      // }
    },

    components:{
      Statistics,
    },

    // beforeRouteEnter(to, from, next) {
    //   store.commit('admin/PleaseStartLoading');
      
    //   store.dispatch('admin/fetchAuthUser').then((response) => {
    //     store.commit('admin/PleaseStopLoading');
    //     next(true);
    //   }).catch((error) => {
    //     next(false);
    //   });
    // },      
  } 
</script>

<style scoped>
  .img-icon-custom{
    width:56px;
    height: 56px;
  }
  .libyana{ 
    background: linear-gradient(60deg,#37517e,#eacfe5)  !important;
  }

  .almadar{
    background: linear-gradient(60deg,#03a94f,#c9ecda) !important;
  }
  .card-header{
    text-align: right;
  }
</style>