<template>
  <div class="row row-custom">
    <div class="col-md-10">
        <div class="card text-right">
            <div class="card-header">
              تفاصيل المستخدم 
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table">
                  <tr>
                    <td>الاسم</td><td>:</td>
                    <td>{{User.name}}</td>       
                  </tr>
                  <tr>
                    <td>البريد الالكتروني</td><td>:</td>
                    <td>{{User.email}}</td>       
                  </tr>
                  <tr>
                      <td>الصلاحيّات</td><td>:</td>
                      <td>
                        <li v-for="(permission,index) in Permissions.models" :key="index">
                          {{ permission }}
                        </li>
                      </td>       
                  </tr>
                  <tr>
                    <td>الاجراءات</td><td>:</td>
                    <td>
                      <li v-for="(procedure,index) in Permissions.permissions" :key="index">
                      {{procedure}}
                      </li>       
                    </td>
                  </tr>
                </table>
              </div>
              <br>
            </div>
        </div>
    </div>
  </div>
</template>
  
<script>
  import {mapState} from 'vuex';
  import store from '../../../store/index';
  export default {
    data(){
      return{
        UserPermissions:[]
      }
    },

    computed:{
      ...mapState({
        User:state=>state.admin.Users.users.data,
        Permissions:state=>state.admin.Users.Permissions.data,
      }),
    },

    async created(){
        let user_uuid=this.$route.params.uuid; 
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchSpecificUser',user_uuid).then((response) => {
          store.dispatch('admin/fetchPermissions',user_uuid).then((response) => {
            store.commit('admin/PleaseStopLoading');
          });
        });
          // this.User.permissions.forEach(element => {
          //   this.UserPermissions.push(element.name);
          // });  
      },
  }
</script>

<style scoped>
  .row-custom{
      justify-content: center;
  }

  .card .card-header {
      background: #37517e;
      color: white;
  }

  li{
    list-style-type: none;
  }
</style>