<template>
    <div class="container-fluid">
         <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
         <div class="row row-custom">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-header card-header-primary">
                      <h4 class="card-title">{{(IsNew)? 'اضافة مدينة': 'تعديل بيانات مدينة'  }}</h4>
                    <p class="card-category">{{ (IsNew)? 'اضافة مدينة جديدة للنظام' : 'التعديل على بيانات مدينة في النظام' }}</p>
                     </div>
                     <div class="card-body">
                         <div class="row mb-3">
                             <Input :MyValue="form.name" id="name" title="اسم المدينة" @myInput="HandleInput('name',$event)" Mykey="name" :errors= 'errors' class_bs="col-md-12"/>
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
     import {mapMutations, mapState} from 'vuex'
     import store from '../../../store/index'
     import Input from '../../../components/Form/TextInput'
     import SuccessAlert from '../../../components/SuccessAlert'
  
     export default {
        data(){
            return{
              form:{
                id:'',
                name:'',
              },
              Alert:{
                  title:'معلومات',
                  message:'',
              },
              goBack:true,
            }
        },

      components:{
        SuccessAlert,
        Input,
      },

      computed:{
          ...mapState({
            City:state=>state.admin.Cities.cities.data,
            errors:state=>state.admin.Cities.city.errors,
          }), 

          IsNew(){
            return this.form.id == '';
          },
      },
 
      created(){
          this.cleanErrors();
          this.form.id = this.$route.params.id !== undefined?this.$route.params.id:'';
          if(this.form.id){
          store.commit('admin/PleaseStartLoading');
          store.dispatch('admin/fetchCity', this.form.id).then((response) => {
                store.commit('admin/PleaseStopLoading');
                  this.form.id = this.City.id;
                  this.form.name = this.City.name;
              });
          }
      },
       
      methods:{

          ...mapMutations({
              cleanErrors:"admin/cleanCitiesErrors"
          }),

          HandleInput(key,value){
              this.form[key]=value;
          },

          onSubmit(){
              store.dispatch('admin/NewCity',this.form).then((response) => {
                  this.cleanErrors();
                  this.Alert.message='تمّت اضافة مدينة جديدة بنجاح!';
                  this.$refs.MySuccessAlert.showModel();
              }).catch((error) => {

              });
          },

          onUpdate(){
              store.dispatch('admin/updateCity',this.form).then((response) => {
                  this.cleanErrors();
                  this.Alert.message='تمّ تعديل بيانات المدينة بنجاح';
                  this.$refs.MySuccessAlert.showModel();
              }).catch((error) => {

              });
          },
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