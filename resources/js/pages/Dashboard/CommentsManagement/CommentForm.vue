<template>
    <div class="container-fluid">
        <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
        <div class="row row-custom">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{(IsNew)?'اضافة تعليق جديد':'تعديل تعليق'}}</h4>
                        <p class="card-category">{{(IsNew)?'سيتم اضافة تعليق جديد للنظام ':'سيتم التعديل على بيانات تعليق في النظام'}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                        <Input :MyValue="form.client_name" id="client_name" title="اسم العميل" @myInput="HandleInput('client_name',$event)" Mykey="client_name" :errors= 'errors'/>
                        <Input title="عنوان التعليق" id="title" :MyValue="form.title" @myInput="HandleInput('title',$event)" Mykey="title" :errors= 'errors'/>
                        <Input title="محتوى التعليق" id="content" :MyValue="form.content" @myInput="HandleInput('content',$event)" Mykey="content" :errors= 'errors' class_bs="col-md-12"/>
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
//  import InputFile from '../../../components/Form/InputFile'

    export default {
        data(){
        return{

            form:{
                id:'',
                client_name:'',
                title:'',
                content:'',
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
            // InputFile,
        },

        computed:{
            ...mapState({
                Comment:state=>state.admin.CommentsAndRates.comments.data,
                errors:state=>state.admin.CommentsAndRates.comment.errors,
            }),

            IsNew(){
                return this.form.id == '';
            },
        },

         created(){
             this.cleanErrors();
             this.form.id = this.$route.params.id !== undefined?this.$route.params.id:'';
             if(this.form.id){
                 let comment_id = this.form.id;
                 store.commit('admin/PleaseStartLoading');
                 store.dispatch('admin/fetchComment', comment_id).then((response) => {
                     store.commit('admin/PleaseStopLoading');
                     this.form.id = this.Comment.id;
                     this.form.client_name = this.Comment.client_name;
                     this.form.title = this.Comment.title;
                     this.form.content = this.Comment.content;
                 });
             }
         },

         methods:{

             ...mapMutations({
                 cleanErrors:"admin/cleanCommentErrors"
             }),

             HandleInput(key,value){
                 this.form[key]=value;
             },

             onSubmit(){
                 let formData=new FormData();
                 for (let key in this.form) {
                    formData.append(key, this.form[key]);
                }
                 store.dispatch('admin/NewComment',formData).then((response) => {
                     this.cleanErrors();
                     this.Alert.message='تمّت اضافة تعليق جديد بنجاح';
                     this.$refs.MySuccessAlert.showModel();
                 }).catch((error) => {
                     console.log(error);
                 });
             },

             onUpdate(){
                let formData=new FormData();
                 for (let key in this.form) {
                    formData.append(key, this.form[key]);
                }
                 formData.append('_method', 'PATCH');
                 store.dispatch('admin/updateComment',formData).then((response) => {
                     this.cleanErrors();
                     this.Alert.message='تمّ تعديل التعليق بنجاح';
                     this.$refs.MySuccessAlert.showModel();
                 }).catch((error) => {

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
