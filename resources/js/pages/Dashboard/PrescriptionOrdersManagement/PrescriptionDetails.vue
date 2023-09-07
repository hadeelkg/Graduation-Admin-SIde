<template>
    <div class="row row-custom">
      <div class="col-md-8">
          <div class="card text-right">
              <div class="card-header">
                  تفاصيل الطلبية
              </div>
              <div class="card-body">
                  <div class="row">
                      <table class="table">
                          <tr>
                              <td>صورة الوصفة الطبية</td><td>:</td>
                              <!-- <td><img src="../../../assets/img/tfyhui.png" width="80"/></td> -->
                          </tr>
                        <tr>
                            <td>اسم الزبون</td><td>:</td>
                            <td>{{PreOrder.client.name}}</td>
                        </tr>
                        <tr>
                            <td>رقم الهاتف</td><td>:</td>
                            <td>{{PreOrder.client.phone}}</td>
                        </tr>
                        <tr>
                            <td>البريد الالكتروني</td><td>:</td>
                            <td>{{PreOrder.client.email}}</td>
                        </tr>
                        <tr>
                            <td>العنوان</td><td>:</td>
                            <td>{{PreOrder.client.address}}</td>
                        </tr>
                        <tr>
                            <td>تاريخ ارسال الطلبية</td><td>:</td>
                            <td>{{PreOrder.created_at}}</td>
                        </tr>
                      </table>
                  </div>
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
            id:''
        }
    },

    computed:{
        ...mapState({
        PreOrder:state=>state.admin.PrescriptionOrders.prescriptionOrders.data,
        }),
    },

    created(){
        let item_id=this.$route.params.id;
        store.dispatch('admin/fetchPreOrder',item_id);
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
</style>
