<template>
  <div class="container-fluid">
    <!-- <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
    <div class="row row-custom">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
              <h4 class="card-title">{{(IsNew)?'اضافة طلبية جديدة':'تعديل بيانات الطلبية'}}</h4>
              <p class="card-category">{{(IsNew)?'سيتم اضافة طلبية جديدة للنظام ':'سيتم التعديل على بيانات طلبية في النظام'}}</p>
          </div>
          <div class="card-body">
            <div class="row mb-3">
                <InputFile title="الصورة" id="media" :MyValue="form.media" @myInput="HandleInput('media',$event)" Mykey="media" class_bs="col-md-12" :errors= 'errors'/>
                <Input :MyValue="form.name_ar" id="name_ar" title="اسم الشريك بالعربي" @myInput="HandleInput('name_ar',$event)" Mykey="name.ar" :errors= 'errors'/>
                <Input title="نبذة عن الشريك بالعربي" id="description_ar" :MyValue="form.description_ar" @myInput="HandleInput('description_ar',$event)" Mykey="description.ar" :errors= 'errors'/>
                <Input title="اسم الشريك بالانجليزية" id="name_en" :MyValue="form.name_en" @myInput="HandleInput('name_en',$event)" Mykey="name.en" :errors= 'errors'/>
                <Input title="نبذة عن الشريك بالانجليزية" id="description_en" :MyValue="form.description_en" @myInput="HandleInput('description_en',$event)" Mykey="description.en" :errors= 'errors'/>
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
  // import {mapState,mapMutations} from 'vuex';
  // import store from '../../../store/index'; 
  // import Input from '../../../components/Form/TextInput'
  // import SuccessAlert from '../../../components/SuccessAlert'
  // import InputFile from '../../../components/Form/InputFile'

  // export default {
  //   data(){
  //       return{
  //         form:{
  //             uuid:'',
  //             media:'',
  //             name_ar:'',
  //             name_en:'',
  //             description_ar:'',
  //             description_en:'',
  //         },
  //         Alert:{
  //           title:'معلومات',
  //           message:'',
  //         },
  //         goBack:true,
  //       }
  //   },

  //   components:{
  //     SuccessAlert,
  //     Input,
  //     InputFile,
  //   }, 

  //   computed:{
  //     ...mapState({
  //         Partner:state=>state.admin.Partners.partners.data,
  //         errors:state=>state.admin.Partners.partner.errors,
  //     }),
      
  //     IsNew(){
  //       return this.form.uuid == '';  
  //     },
  //   },

  //   created(){
  //     this.cleanErrors();
  //     this.form.uuid = this.$route.params.uuid!== undefined?this.$route.params.uuid:'';
  //     if(this.form.uuid){
  //       let partner_uuid = this.form.uuid;
  //       store.commit('admin/PleaseStartLoading');
  //       store.dispatch('admin/fetchSpecificPartner', partner_uuid).then((response) => {
  //         store.commit('admin/PleaseStopLoading');
  //         this.form.uuid = this.Partner.uuid;
  //         this.form.name_en = this.Partner.name_en;
  //         this.form.name_ar = this.Partner.name_ar;
  //         this.form.description_en = this.Partner.description_en;
  //         this.form.description_ar = this.Partner.description_ar;
  //       }).catch((error) => {

  //       });
  //     }
  //   },

  //   methods:{
  //     ...mapMutations({
  //       cleanErrors: "admin/cleanPartnersErrors"
  //     }),
      
  //     HandleInput(key,value){
  //         this.form[key]=value;
  //     },

  //     onSubmit(){
  //       let formData=new FormData(); 

  //       formData.append("media", this.form.media);
  //       formData.append("name[ar]", this.form.name_ar);
  //       formData.append("name[en]", this.form.name_en);
  //       formData.append("description[ar]", this.form.description_ar);
  //       formData.append("description[en]", this.form.description_en);

  //       store.dispatch('admin/addNewPartner', formData).then((response) => {
  //         this.cleanErrors();
  //         this.Alert.message='تمّت اضافة شريك جديد بنجاح';
  //         this.$refs.MySuccessAlert.showModel();
  //       }).catch((error) => {

  //       });
  //     },

  //     onUpdate(){
  //       let formData=new FormData(); 
  //       formData.append("uuid", this.form.uuid);
  //       formData.append("media", this.form.media);
  //       formData.append("name[ar]", this.form.name_ar);
  //       formData.append("name[en]", this.form.name_en);
  //       formData.append("description[ar]", this.form.description_ar);
  //       formData.append("description[en]", this.form.description_en);
  //       formData.append('_method', 'patch');
  //       store.dispatch('admin/updatePartner',formData).then((response) => {
  //         this.cleanErrors();
  //         this.Alert.message='تمّ تعديل معلومات الشريك بنجاح';
  //         this.$refs.MySuccessAlert.showModel();
  //       }).catch((error) => {

  //       });
  //     }

  //   },
  // }
</script>

<style lang="scss" scoped>

  .invalid-feedback{
      color:#e91e1e;
      display:block;
  }

  .invalid-border{
    background-image: none !important;
    border-bottom: 1px solid #E91E1E !important;
  }
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

    select{
      appearance: auto;
    }

  $primary: #37517e;
  $secondary: #37517e;
  $black: #A9AFBB;
  $gray: #D2D2D2;
  $gray-dark: #495057;
  .form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 10px;
    text-align: start;
  }
  .form__field {
    width: 100%;
    border: 0;
    border-bottom: 1px solid $gray;
    outline: 0;
    font-size: .875rem;
    color: $black;
    padding: 7px 0;
    background: transparent;
    transition: border-color 0.2s;
    &::placeholder {
      color: transparent;
    }
    &:placeholder-shown ~ .form__label {
      font-size: .875rem;
      cursor: text;
      top: 20px;
    }
  }

  .form__field:focus {
    ~ .form__label {
      position: absolute;
      top: 0;
      display: block;
      transition: 0.2s;
      font-size: 1rem;
      color: $primary;
      font-weight:700;
    }
    padding-bottom: 6px;
    font-weight: 700;
    border-width: 2px;
    border-image: linear-gradient(to right, $primary,$secondary);
    border-image-slice: 1;
  }
  /* reset input */
  .form__field{
    &:required,&:invalid { box-shadow:none; }
  }
</style>
