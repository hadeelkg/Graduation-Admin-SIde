<template>
    <div class="container-fluid">
         <!-- <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
         <div class="row row-custom">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-header card-header-primary">
                         <h4 class="card-title">{{(IsNew)?'اضافة تعليق جديد':'تعديل تعليق'}}</h4>
                         <p class="card-category">{{(IsNew)?'سيتم اضافة تعليق جديد للنظام ':'سيتم التعديل على بيانات تعليق في النظام'}}</p>
                     </div>
                     <div class="card-body">
                         <div class="row mb-3">
                            <Input :MyValue="form.name" id="name" title="الاسم" @myInput="HandleInput('name',$event)" Mykey="name" :errors= 'errors'/>
                            <Input title="البريد الالكتروني" id="email" :MyValue="form.email" @myInput="HandleInput('email',$event)" Mykey="email" :errors= 'errors'/>
                            <Input title="محتوى التعليق" id="comment" :MyValue="form.comment" @myInput="HandleInput('comment',$event)" Mykey="comment" :errors= 'errors'/>
                         </div>
                         <button type="button" class="btn btn-primary pull-right" v-if="IsNew" @click="onSubmit()">اضافة</button>
                         <button type="button" class="btn btn-primary pull-right" v-if="!IsNew" @click="onUpdate()">تعديل</button>
                     </div> 
                 </div>
             </div>
         </div> -->
     </div>
 </template>
 
 <script>
    //  import {mapMutations, mapState} from 'vuex'
    //  import store from '../../../store/index'
    //  import Input from '../../../components/Form/TextInput'
    //  import SuccessAlert from '../../../components/SuccessAlert'
    //  import InputFile from '../../../components/Form/InputFile'
 
    //  export default {
    //      data(){
    //          return{
 
    //              form:{
    //                  uuid:'',
    //                  media:'',
    //                  name:'',
    //                  comment:'',
    //                  email:'',
    //              },
 
    //              Alert:{
    //                  title:'معلومات',
    //                  message:'',
    //              },
    //              goBack:true,
    //          }
    //      },
 
    //      components:{
    //          SuccessAlert,
    //          Input,
    //          InputFile,
    //      },
 
    //      computed:{
    //          ...mapState({
    //              Comment:state=>state.admin.Comments.comments.data,
    //              errors:state=>state.admin.Comments.comment.errors,
    //          }), 
 
    //          IsNew(){
    //              return this.form.uuid == '';
    //          },
    //      },
 
    //      created(){
    //          this.cleanErrors();
    //          this.form.uuid = this.$route.params.uuid !== undefined?this.$route.params.uuid:'';
    //          if(this.form.uuid){
    //              let comment_uuid = this.form.uuid;
    //              store.commit('admin/PleaseStartLoading');
    //              store.dispatch('admin/viewSpecificComment', comment_uuid).then((response) => {
    //                  store.commit('admin/PleaseStopLoading');
    //                  this.form.uuid = this.Comment.uuid;
    //                  this.form.comment = this.Comment.comment;
    //                  this.form.name = this.Comment.name;
    //                  this.form.email = this.Comment.email;
    //              });
    //          }
    //      },
       
    //      methods:{
  
    //          ...mapMutations({
    //              cleanErrors:"admin/cleanCommentsErrors"
    //          }),
 
    //          HandleInput(key,value){
    //              this.form[key]=value;
    //          },
 
    //          onSubmit(){
    //              let formData=new FormData(); 
    //              for (let key in this.form) {
    //                 formData.append(key, this.form[key]);
    //             }
    //              store.dispatch('admin/addNewComment',formData).then((response) => {
    //                  this.cleanErrors();
    //                  this.Alert.message='تمّت اضافة تعليق جديد بنجاح';
    //                  this.$refs.MySuccessAlert.showModel();
    //              }).catch((error) => {
    //                  console.log(error);
    //              });
    //          },
 
    //          onUpdate(){
    //             let formData=new FormData(); 
    //              for (let key in this.form) {
    //                 formData.append(key, this.form[key]);
    //             }
    //              formData.append('_method', 'PATCH');
    //              store.dispatch('admin/updateComment',formData).then((response) => {
    //                  this.cleanErrors();
    //                  this.Alert.message='تمّ تعديل التعليق بنجاح';
    //                  this.$refs.MySuccessAlert.showModel();
    //              }).catch((error) => {
 
    //              });
    //          }
    //      },
    //  }
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