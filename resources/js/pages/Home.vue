<template>
  <div>
    <Loader :startLoading="Loading"/>
    <div class="wrapper ">
      <SideBar/>
      <div class="main-panel">

        <!-- Navbar -->
        <Header/>
        <!-- End Navbar -->
        <div class="content" style="margin-top:40px !important">
          <router-view/>
          <!-- <CustomModal  ref="MyNotificationModal" id="notification_modal" :title="AlertTitle" :message="AlertMessage" @DoAction="changeNotificationStatus()" button_title='اطلعت' >
            <template v-slot:content>
              <div class="col-md-12 text-center">
                <img src="/img/info.png" class="img-style"/>
              </div>
              <div class="col-md-12 text-center">
                <h4>{{SelectedNotification.title}}</h4>
              </div>
              <div class="col-md-12 text-center">
                <p>{{SelectedNotification.content}}</p>
              </div>
            </template>
          </CustomModal> -->
        </div>
        <!-- Footer -->
        <Footer/>
      </div>
    </div>
  </div>
</template>

<script>
  import SideBar from '../components/SideBar';
  import Footer from '../components/Footer';
  import Header from '../components/Header';
  import { mapState} from 'vuex';
  import store from '../store/index';
  import Loader from '../components/loader.vue';
  import CustomModal from '../components/CustomModal'
  export default {
    name:'Main',
    data() {
      return {
        fullPage: true,
        interval:null,
        AlertTitle:'',
        AlertMessage:'',
        SelectedNotification:'',
      }
    },
    created(){
        // this.$permissions=this.permissions
    },
    computed:{
    ...mapState({
    //     user: state => state.admin.users.AuthUser,
        Loading:state=>state.admin.Authentication.Loading,
        PositionsList:state=>state.admin.Positions.positions,


    //     permissions:state => state.admin.auth.loggedUserPermissions,

      }),
    },

    components:{
      Footer,
      SideBar,
      Header,
      SideBar,
      Loader,
      CustomModal,
    },

    // beforeRouteEnter(to, from, next) {
    //   store.commit('admin/PleaseStopLoading');
       
    //     store.dispatch('admin/fetchPositions')
    //       .then((response) => {
            
    //           next(true);
    //       })
    //   .catch((error) => {
    //     next(false);
    //   });
    // },

    beforeDestroy() {
      clearInterval(this.interval);
    }
  }
</script>

<style >
  .main-panel>.content {
    margin-top: 70px;
    padding: 30px 0px;
    min-height: calc(100vh - 123px);
  }
  .img-style{
    width: 70px;
    margin-bottom: 20px;
  }
</style>



