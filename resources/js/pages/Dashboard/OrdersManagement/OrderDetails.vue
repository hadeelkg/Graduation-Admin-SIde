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
                            <div class="card">
                                <tr>
                                    <td>حالة الطلب</td><td>:</td>
                                    <!-- <td>{{Order.status}}</td> -->
                                    <td v-if="Order.status=='pendingOrder'">انتظار</td>
                                    <td v-else-if="Order.status=='done'">تم التوصيل</td>
                                    <td v-else-if="Order.status=='canceled'">ملغية</td>
                                    <td v-else>غير معروفة</td>
                                </tr>
                                <tr>
                                    <td>اجمالي الفاتورة</td><td>:</td>
                                    <td>{{Order.total_price}}</td>
                                </tr>
                            </div>
                            <div v-for="(orderProduct, index) in Order.order_product" :key="index">
                                <tr>
                                    <td>صورة المنتج</td><td>:</td>
                                    <td><img :src="'http://127.0.0.1:8000/storage/'+orderProduct.product.image_path" width="80"/></td>
                                </tr>
                                <tr>
                                    <td>اسم المنتج</td><td>:</td>
                                    <td>{{orderProduct.product.name}}</td>
                                </tr>
                                <tr>
                                    <td>سعر المنتج</td><td>:</td>
                                    <td>{{orderProduct.product_price}}</td>
                                </tr>
                                <tr>
                                    <td>الكمية</td><td>:</td>
                                    <td>{{orderProduct.quantity}}</td>
                                </tr>
                                <tr>
                                    <td>الاجمالي</td><td>:</td>
                                    <td>{{orderProduct.subtotal_price}}</td>
                                </tr><br>
                            </div>
                        </table>
                    </div>

            <div class="card">
                <div class="card-header">
                    العميل
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
                                <td>تفاصيل أخرى</td><td>:</td>
                                <router-link :to="{name:'admin.dashboard.client.details',params:{id:Order.client.id}}" type="button" class="btn my_btn btn-sm">
                                    تفاصيل العميل
                                    <i class="material-icons details_icon">folder_open</i>
                                </router-link>
                            </tr>
                        </table>
                    </div>
                </div>
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

  .my_btn{
    box-shadow: 6px 8px 5px #dcd5d9;
    background: linear-gradient(white, white) padding-box,
              linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
    border: 2px solid transparent;
    margin:3px;
    color: black;
  }
  .my_btn:hover{
    box-shadow: 0 2px 2px 0 #37517e, 0 3px 1px -2px #37517e, 0 1px 5px 0 rgb(170 71 186 / 12%);
    background: linear-gradient(white, white) padding-box,
              linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
  }
  .details_icon{
    color: #37517e;
    }
</style>

