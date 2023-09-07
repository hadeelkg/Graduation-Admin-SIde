<template>
  <div class="container-fluid">
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
    <div class="row row-custom">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{(!IsNew)?'اضافة مسؤول جديد':'تعديل المسؤول'}}</h4>
            <p class="card-category">{{(!IsNew)?'سيتم اضافة مسؤول جديد للنظام ':'سيتم التعديل على مسؤول في النظام'}}</p>
          </div>
          <div class="card-body">
              <div class="row mb-3">
                  <!-- <Input id="name" title="الاسم" @myInput="HandleInput('name',$event)" Mykey="name" :MyValue="form.name"/> -->
                  <Input id="email" title="البريد الالكتروني" MyType="email" @myInput="HandleInput('email',$event)" Mykey="email" :MyValue="form.email" :errors= 'errors'/>
                  <Input id="password" title="كلمة المرور" @myInput="HandleInput('password',$event)" Mykey="password" :MyValue="form.password" MyType="password" :errors= 'errors'/>
                  <!-- <Input id="password_confirmation" title="تأكيد كلمة المرور" @myInput="HandleInput('password_confirmation',$event)" Mykey="password_confirmation" :MyValue="form.password_confirmation" MyType="password" :errors= 'errors'/> -->
              </div>
              <button type="button" class="btn btn-primary pull-right" v-if="IsNew" @click="onSubmit()">اضافة</button>
              <button type="button" class="btn btn-primary pull-right" v-if="!IsNew" @click="onUpdate()">تعديل</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapState,mapMutations} from 'vuex';
  import store from '../../../store/index';
  import Input from '../../../components/Form/TextInput'
  import SuccessAlert from '../../../components/SuccessAlert'
  export default {
    data(){
      return{
        form:{
          id:'',
          // name:'',
          email:'',
          password:'',
          // password_confirmation:'',
        },
        Alert:{
            title:'معلومات',
            message:'',
        },
        goBack:true,
        // selectedModels:[],
      }
    },

    components:{
      Input,
      SuccessAlert,
    },

    computed:{
      ...mapState({
          Admin:state=>state.admin.Admins.adminsList.data,
          errors:state=>state.admin.Admins.admin.errors,
      }),


      IsNew(){
        return this.form.id == '';
      },
    },

    created(){
      this.cleanErrors();
      let admin_id = this.$route.params.id!== undefined?this.$route.params.id:'';
      if(admin_id){
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchAdmin',admin_id).then((response) => {
          store.commit('admin/PleaseStopLoading');
          this.form.id = this.Admin.id;
          this.form.email = this.Admin.email;
          this.form.password = this.Admin.password;
        });
      }
    },

    methods:{
      ...mapMutations({
          cleanErrors: "admin/cleanAdminErrors"
        }),

        HandleInput(key,value){
          this.form[key]=value;
        },

        onSubmit(){
          store.commit('admin/PleaseStartLoading');
          store.dispatch('admin/addNewAdmin', this.form).then((response) => {
            store.commit('admin/PleaseStopLoading');
            this.cleanErrors();
            this.Alert.message='تمّت اضافة مسؤول جديد بنجاح';
            this.$refs.MySuccessAlert.showModel();
          }).catch((error)=>{
            });
        },

        onUpdate(){
          store.commit('admin/PleaseStartLoading');
          store.dispatch('admin/updateAdmin', this.form).then((response) => {
            store.commit('admin/PleaseStopLoading');
            this.cleanErrors();
            this.Alert.message='تمّ تعديل بيانات المسؤول بنجاح';
            this.$refs.MySuccessAlert.showModel();
          }).catch((error)=>{
            });
        }

    },

  }
</script>

<style lang="scss" scoped>
  .row-custom{
    justify-content: center;
  }
  .card .card-header {
    background: #37517e;
    color: white;
  }
  .card-header{
    text-align: right;
  }
</style>
