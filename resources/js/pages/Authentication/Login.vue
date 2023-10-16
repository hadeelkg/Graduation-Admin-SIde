<template>
  <div class=" custom-login">
     <div class="center">
       <div class="card">
         <div class="card-header card-header-primary" style="text-align: right !important;">
           <h4 class="card-title">تسجيل الدخول</h4>
           <p class="card-category">يرجى تعبئة بيانات الدخول</p>
         </div>
         <div class="card-body">
            <div v-if="warningMessage" class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>تنبيه!</strong> {{ warningMessage }}
              <i class="material-icons">error</i>
            </div>
            <form  autocomplete='off'>
              <div class="row">
                <Input class_bs="col-md-12" id="email" title="البريد الإلكتروني" @myInput="HandleInput('email',$event)" Mykey="email" :MyValue="form.email" :errors= 'errors'/>
                <Input class_bs="col-md-12" id="password" title="كلمة المرور" @myInput="HandleInput('password',$event)" Mykey="password" :MyValue="form.password" MyType="password" :errors= 'errors'/>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-primary" @click="login()" style="padding: 15px 38px !important; font-size:.80rem;">دخول</button>
              </div>
            </form>
         </div>
       </div>
     </div>
   </div>
</template>

<script>
  import Input from '../../components/Form/TextInput'
  import {mapState} from 'vuex'

 export default {
   data(){
     return{
         form:{
           email:'',
           password:'',
         },
         remember:false,
         warningMessage:'',
     }
   },

   components:{
     Input
   },

   computed:{
     ...mapState({
       errors:state=>state.admin.Authentication.errors,
     })
   },

   methods:{
     HandleInput(key,value){
       this.form[key]=value;
     },

    async login(){
       await this.$store.dispatch('admin/authRequest', {
         email: this.form.email,
         password: this.form.password,
       }).then((response) => {
        this.warningMessage = "";
           this.$router.push({name: 'admin.dashboard.home'});
         }).catch((error) => {
          this.warningMessage = error.response.data.message;
             console.log(error.response.data.message);
           });
       },
   },
 }
</script>

<style scoped lang="scss">
 .custom-login {
     justify-content: center;
     align-items: center;
     height: 90vh;
 }
 .center{
     position: fixed;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
 }
 .form__label{
   display: contents !important;
 }
 .card{
   width: 480px;
 }
 @media screen and (max-width: 550px){
 .card{
   width: 310px;
   }
 }
</style>

