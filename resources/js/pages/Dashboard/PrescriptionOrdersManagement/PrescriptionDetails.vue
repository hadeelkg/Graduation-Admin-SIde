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
                            </div>
                            <tr>
                                <td>صورة الوصفة الطبية</td><td>:</td>
                                <td><img :src="'http://127.0.0.1:8000/storage/'+PreOrder.image_path" width="80"/></td>
                            </tr>
                            <tr v-if="PreOrder.client && PreOrder.client.name">
                                <td>اسم الزبون</td><td>:</td>
                                <td>{{PreOrder.client.name}}</td>
                            </tr>
                            <tr  v-if="PreOrder.client && PreOrder.client.phone">
                                <td>رقم الهاتف</td><td>:</td>
                                <td>{{PreOrder.client.phone}}</td>
                            </tr>
                            <tr  v-if="PreOrder.client && PreOrder.client.email">
                                <td>البريد الالكتروني</td><td>:</td>
                                <td>{{PreOrder.client.email}}</td>
                            </tr>
                            <tr  v-if="PreOrder.client && PreOrder.client.address">
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

        components:{
            TextSelect,
            SuccessAlert
        },

        computed:{
            ...mapState({
            PreOrder:state=>state.admin.PrescriptionOrders.prescriptionOrders.data,
            }),
        },

        created(){
            let order_id = this.$route.params.id!== undefined?this.$route.params.id:'';
            if(order_id){
                store.commit('admin/PleaseStartLoading');
                store.dispatch('admin/fetchPreOrder',order_id).then((response) => {
                    this.form.order_id = this.PreOrder.id;
                    this.form.status = this.PreOrder.status;
                    this.form.client_id = this.PreOrder.client.id;
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
                store.dispatch('admin/updatePreOrder',formData).then((response) => {
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
