<template>
  <div class="container-fluid">
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
    <div class="row row-custom">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{(IsNew)? 'اضافة علامة تجارية': 'تعديل بيانات علامة تجارية'  }}</h4>
            <p class="card-category">{{ (IsNew)? 'اضافة علامة تجارية جديدة للنظام' : 'التعديل على بيانات علامة تجارية في النظام' }}</p>
          </div>
          <div class="card-body">
            <div class="row mb-3">
                <Input :MyValue="form.name" id="name" title="اسم العلامة التجارية" @myInput="HandleInput('name',$event)" Mykey="name" class_bs="col-md-12" :errors='errors'/>
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
          Brand:state=>state.admin.Brands.brands.data,
          errors:state=>state.admin.Brands.brand.errors,
      }),
      
      IsNew(){
        return this.form.id == '';  
      },
    },

    created(){
      this.cleanErrors();
      this.form.id = this.$route.params.id!== undefined?this.$route.params.id:'';
      if(this.form.id){
        let brand_id = this.form.id;
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchBrand', brand_id).then((response) => {
          store.commit('admin/PleaseStopLoading');
          this.form.id = this.Brand.id;
          this.form.name = this.Brand.name;
        }).catch((error) => {

        });
      }
    },

    methods:{
      ...mapMutations({
        cleanErrors: "admin/cleanBrandErrors"
      }),
      
      HandleInput(key,value){
          this.form[key]=value;
      },

      onSubmit(){
        store.dispatch('admin/NewBrand', this.form).then((response) => {
          this.cleanErrors();
          this.Alert.message='تمّت اضافة علامة تجارية جديدة بنجاح';
          this.$refs.MySuccessAlert.showModel();
        }).catch((error) => {

        });
      },

      onUpdate(){
        store.dispatch('admin/updateBrand',this.form).then((response) => {
          this.cleanErrors();
          this.Alert.message='تمّ تعديل معلومات العلامة التجارية بنجاح';
          this.$refs.MySuccessAlert.showModel();
        }).catch((error) => {

        });
      }

    },
  }
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

  $primary: #37517e;
  $secondary: #37517e;
  $black: #A9AFBB;
  $gray: #D2D2D2;
  $gray-dark: #495057;

</style>
