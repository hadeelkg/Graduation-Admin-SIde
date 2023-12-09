<template>
  <div class="row row-custom">
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
    <div class="col-md-8">
      <div class="card text-right">
        <div class="card-header">
            تفاصيل الطلبية
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <div class="card">
                        <tr style="display:flex;flex-direction:row;">
                            <td>حالة الطلب</td><td>:</td>
                            <td style="display:flex;flex-direction:row;">
                                <!-- <TextSelect title="الحالة" id="status" :Items=Status @Select="HandleInput('status',$event)" :MyValue="form.status" Mykey="status" class_bs="col-md-12"/> -->
                                <div class="col-md-12" style="max-width:85%">
                                    <div class="form__group field">
                                        <select v-model="form.status"  class="form-control select2" name="الحالة" id="status" style="width: 100%;">
                                            <option value="" selected>حالة الطلبية</option>
                                            <option value="pendingOrder">انتظار</option>
                                            <option value="done">تم التوصيل</option>
                                            <option value="canceled">ملغية</option>
                                        </select>
                                    </div>
                                </div>
                                <button style="padding:8px 12px;" @click="onUpdate()" type="button" class="btn btn-success">حفظ</button>
                            </td>
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
                                <td v-if="Order.client && Order.client.name">{{Order.client.name}}</td>
                            </tr>
                            <tr>
                                <td>رقم هاتف العميل</td><td>:</td>
                                <td v-if="Order.client && Order.client.phone">{{Order.client.phone}}</td>
                            </tr>
                            <tr v-if="Order.client && Order.client.id">
                                <td>تفاصيل أخرى</td><td>:</td>
                                <router-link :to="{name:'admin.dashboard.client.details',params:{id:Order.client.id}}" type="button" class="btn my_btn btn-sm">
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
  import TextSelect from '../../../components/Form/TextSelect'
  import SuccessAlert from '../../../components/SuccessAlert'
  export default {
    data(){
        return{
            Status:[
                {name: 'ملغية', id:'canceled'},
                {name: 'تم التوصيل', id:'done'},
                {name: 'انتظار', id:'pendingOrder'}
            ],

            form:{
                order_id:'',
                status:'',
                client_id:''
            },

            Alert:{
                title:'معلومات',
                message:'',
            },
        }
    },
    computed:{
      ...mapState({
        Order:state=>state.admin.Orders.orders.data,
        }),
    },

    components:{
        TextSelect,
        SuccessAlert
    },

    created(){
      let order_id = this.$route.params.id!== undefined?this.$route.params.id:'';
      if(order_id){
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchOrder',order_id).then((response) => {
            this.form.order_id = this.Order.id;
            this.form.status = this.Order.status;
            this.form.client_id = this.Order.client.id;
          store.commit('admin/PleaseStopLoading');
        });
      }
    },

    methods:{
        HandleInput(key,value){
            this.form[key]=value;
        },

        onUpdate(){
            let formData=new FormData();
                for (let key in this.form) {
                formData.append(key, this.form[key]);
            }
            formData.append('_method', 'PATCH');
            store.dispatch('admin/updateOrder',formData).then((response) => {
                this.Alert.message='تمّ تعديل حالة الطلبية بنجاح';
                this.$refs.MySuccessAlert.showModel();
            }).catch((error) => {

            });
        }
    }
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

  .form__group {
    position: relative;
    /* padding: 15px 0 0; */
    /* margin-top: 10px; */
    text-align: start;
  }
  .form__field {
    width: 100%;
    border: 0;
    border-bottom: 1px solid #D2D2D2;
    outline: 0;
    font-size: .875rem;
    color:  #A9AFBB;
    padding: 7px 0;
    background: transparent;
    transition: border-color 0.2s;
    /* &::placeholder {
      color: transparent;
    } */
    &:placeholder-shown ~ .form__label {
      font-size: .875rem;
      cursor: text;
      top: 20px;
    }
  }

  /* .form__field:focus {
    ~ .form__label {
      position: absolute;
      top: 0;
      display: block;
      transition: 0.2s;
      font-size: 1rem;
      color: #37517e;
      font-weight:700;
    }
    padding-bottom: 6px;
    font-weight: 700;
    border-width: 2px;
    border-image: linear-gradient(to right, #37517e,#37517e);
    border-image-slice: 1;
  } */
/*
  .form__field{
    &:required,&:invalid { box-shadow:none; }
  } */
  select{
    appearance: auto;
  }
  .top_pos{
    padding: 0 !important;
    margin-top: 0 !important;
  }

</style>

