<template>
  <div class="container-fluid">
       <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
       <div class="row row-custom">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">{{(IsNew)? 'اضافة صيدلي': 'تعديل بيانات صيدلي'  }}</h4>
                    <p class="card-category">{{ (IsNew)? 'اضافة صيدلي جديد للنظام' : 'التعديل على بيانات صيدلي في النظام' }}</p>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <Input :MyValue="form.name" id="name" title="الاسم" @myInput="HandleInput('name',$event)" Mykey="name" :errors= 'errors'/>
                      <InputFile :MyValue="form.image_path" title="الصورة" id="image_path" Mykey="image_path" @Input="HandleInput('image_path',$event)" :errors= 'errors'/>
                      <Input :MyValue="form.role" id="role" title="الدور الوظيفي" @myInput="HandleInput('role',$event)" Mykey="role" :errors= 'errors'/>
                      <Input :MyValue="form.bio" id="bio" title="نبذة عن الصيدلي" @myInput="HandleInput('bio',$event)" Mykey="bio" :errors= 'errors'/>
                      <Input :MyValue="form.facebook_link" id="facebook_link" title="رابط حساب الفيسبوك" @myInput="HandleInput('facebook_link',$event)" Mykey="facebook_link" :errors= 'errors'/>
                      <Input :MyValue="form.phone" id="phone" title="رقم الهاتف" @myInput="HandleInput('phone',$event)" Mykey="phone" :errors= 'errors'/>
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
  import InputFile from '../../../components/Form/InputFile'
  import SuccessAlert from '../../../components/SuccessAlert'

  export default {
      data(){
        return{
          form:{
            id:'',
            image_path:'',
            name:'',
            role:'',
            bio:'',
            facebook_link:'',
            phone:'',
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
        InputFile,
        Input,
      },

      computed:{
      ...mapState({
          Pharmacist:state=>state.admin.Pharmacists.pharmacists.data,
          errors:state=>state.admin.Pharmacists.pharmacists.errors,
          }),

          IsNew(){
            return this.form.id == '';
          },
      },

      created(){
          this.cleanErrors();
          this.form.id = this.$route.params.id!== undefined?this.$route.params.id:'';
          if(this.form.id){
              let item_id = this.form.id;
              store.commit('admin/PleaseStartLoading');
              store.dispatch('admin/fetchPharmacist',item_id).then((response) => {
                store.commit('admin/PleaseStopLoading');
                  this.form.id=this.Pharmacist.id;
                  this.form.name=this.Pharmacist.name;
                  this.form.image_path=this.Pharmacist.image_path;
                  this.form.role=this.Pharmacist.role;
                  this.form.bio=this.Pharmacist.bio;
                  this.form.facebook_link=this.Pharmacist.facebook_link;
                  this.form.phone=this.Pharmacist.phone;
                  
              });
          }
      },

      methods:{
          ...mapMutations({
              cleanErrors: "admin/cleanPharmacistErrors"
          }),

          HandleInput(key,value){
              this.form[key]=value;
          },

          onSubmit(){
            let formData=new FormData();
            for(let key in this.form){
              formData.append(key, this.form[key]);
            }
            store.dispatch('admin/NewPharmacist',formData).then((response) => {
                this.cleanErrors();
                this.Alert.message='تمّت اضافة صيدلي جديد';
                this.$refs.MySuccessAlert.showModel();
            }).catch((error) => {
            });
          },

          onUpdate(){
              let formData=new FormData();
              for(let key in this.form){
                formData.append(key, this.form[key]);
              }
              store.dispatch('admin/updatePharmacist',formData).then((response) => {
                  this.cleanErrors();
                  this.Alert.message='تمّ تعديل بيانات الصيدلي بنجاح';
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
 .invalid-feedback{
  color:#e91e1e;
  display:block;
  }
  .invalid-border{
      border-bottom: 1px solid #e91e1e !important;
  }

</style>
