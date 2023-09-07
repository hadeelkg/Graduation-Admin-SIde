<template>
    <div class="container-fluid">
        <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
        <div class="row row-custom">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                      <h4 class="card-title">{{(IsNew)? 'اضافة فئة': 'تعديل بيانات فئة'  }}</h4>
                      <p class="card-category">{{ (IsNew)? 'اضافة فئة جديدة للنظام' : 'التعديل على بيانات فئة في النظام' }}</p>
                    </div>

                    <div class="card-body">
                      <div class="row mb-3">
                          <Input :MyValue="form.name" id="name" title="اسم الفئة" @myInput="HandleInput('name',$event)" Mykey="title" :errors='errors' class_bs="col-md-12"/>
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
                Category:state=>state.admin.Categories.categories.data,
                errors:state=>state.admin.Categories.category.errors,
            }),

            IsNew(){
                return this.form.id == '';
            },
        },

        created(){
            this.cleanErrors();
            this.form.id = this.$route.params.id!== undefined?this.$route.params.id:'';
            if(this.form.id){
                let category_id = this.form.id;
                store.commit('admin/PleaseStartLoading');
                store.dispatch('admin/fetchCategory',category_id).then((response) => {
                  store.commit('admin/PleaseStopLoading');
                    this.form.id = this.Category.id;
                    this.form.name = this.Category.name;
                });
            }
        },

        methods:{

            ...mapMutations({
                cleanErrors: "admin/cleanCategoriesErrors"
            }),

            HandleInput(key,value){
                this.form[key]=value;
            },

            onSubmit(){
                store.dispatch('admin/NewCategory',this.form).then((response) => {
                    this.cleanErrors();
                    this.Alert.message='تمّت اضافة فئة جديدة بنجاح';
                    this.$refs.MySuccessAlert.showModel();
                }).catch((error) => {
                });
            },
            
            onUpdate(){
                store.dispatch('admin/updateCategory',this.form).then((response) => {
                    this.cleanErrors();
                    this.Alert.message='تمّ تعديل الفئة بنجاح';
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