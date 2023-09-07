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
                  <td>اسم العميل</td><td>:</td>
                  <td>{{Order.client.name}}</td>       
              </tr>
              <tr>
                  <td>رقم هاتف العميل</td><td>:</td>
                  <td>{{Order.client.phone}}</td>       
              </tr>
              <tr>
                  <td>اجمالي السعر</td><td>:</td>
                  <td>{{Order.total_price}}</td>       
              </tr>
              <tr>
                  <td>الحالة</td><td>:</td>
                  <td v-if="Order.status=='pendingOrder'">انتظار</td> 
                  <td v-else-if="Order.status=='done'">تم التوصيل</td> 
                  <td v-else-if="Order.status=='canceled'">ملغية</td>  
                  <td v-else></td>    
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
    computed:{
      ...mapState({
        Order:state=>state.admin.Orders.orders.data,
        }),
    },

    created(){
      let order_id = this.$route.params.id!== undefined?this.$route.params.id:'';
      if(order_id){
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchOrder',order_id).then((response) => {
          store.commit('admin/PleaseStopLoading');
        });
      }
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

