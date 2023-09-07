<template>
   <div class="container-fluid">
        <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" :back="this.goBack"/>
        <div class="row row-custom">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{(IsNew)?'اضافة منتج جديد':'تعديل منتج'}}</h4>
                        <p class="card-category">{{(IsNew)?'سيتم اضافة منتج للنظام ':'سيتم التعديل على منتج في النظام'}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <InputFile title="الصورة" id="media" :MyValue="form.media" @myInput="HandleInput('media',$event)" Mykey="media" class_bs="col-md-12" :errors='errors'/>
                            <Input :MyValue="form.name" id="name" title="اسم المنتج" @myInput="HandleInput('name',$event)" Mykey="name" :errors='errors'/>
                            <Input :MyValue="form.price" id="price" title="سعر المنتج" @myInput="HandleInput('price',$event)" Mykey="price" :errors= 'errors'/>
                            <Input :MyValue="form.description" id="description" title="الوصف" @myInput="HandleInput('description',$event)" Mykey="description" :errors='errors'/>
                            <Input :MyValue="form.quantity" id="quantity" title="الكمية" @myInput="HandleInput('quantity',$event)" Mykey="quantity" :errors='errors'/>
                            <TextSelect title="الفئة" id="category_id" :Items=Categories @Select="HandleInput('category_id',$event)" Mykey="category_id" :MyValue="form.category_id" :errors='errors'/>
                            <TextSelect title="العلامة التجارية" id="brand_id" :Items=Brands @Select="HandleInput('brand_id',$event)" Mykey="brand_id" :MyValue="form.brand_id" :errors='errors'/>
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
    import InputFile from '../../../components/Form/InputFile'
    import TextSelect from '../../../components/Form/TextSelect'

    export default {
        data(){
            return{
                form:{
                    id:'',
                    name:'',
                    price:'',
                    description:'',
                    quantity:'',
                    category_id:'',
                    brand_id:'',
                    productImages:'',
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
            InputFile,
            TextSelect,
        },

        computed:{
            ...mapState({
                Categories:state=>state.admin.Categories.categories.data,
                Brands:state=>state.admin.Brands.brands.data,
                Product:state=>state.admin.Products.products.data,
                errors:state=>state.admin.Products.product.errors,
            }), 

            IsNew(){
                return this.form.id == '';
            },
        },

        created(){
            this.cleanErrors();
            // store.commit('admin/PleaseStartLoading');
            store.dispatch('admin/fetchBrands');
            store.dispatch('admin/fetchCategories');
            // .then((response)=> {
            //     store.commit('admin/PleaseStopLoading');
            // });
            this.form.id = this.$route.params.id !== undefined?this.$route.params.id:'';
            if(this.form.id){
                let product_id = this.form.id;
                store.commit('admin/PleaseStartLoading');
                store.dispatch('admin/fetchProduct', product_id).then((response) => {
                    store.commit('admin/PleaseStopLoading');
                    this.form.id = this.Product.id;
                    this.form.name = this.Product.name;
                    this.form.price = this.Product.price;
                    this.form.description = this.Product.description;
                    this.form.quantity = this.Product.quantity;
                    this.form.category_id = this.Product.category.name;
                    this.form.brand_id = this.Product.brand.name;
                });
            }
        },
      
        methods:{
 
            ...mapMutations({
                cleanErrors:"admin/cleanProductErrors"
            }),

            HandleInput(key,value){
                this.form[key]=value;
            },

            onSubmit(){
                let formData=new FormData(); 
                for(let key in this.form){
                    formData.append(key, this.form[key]);
                }
                store.dispatch('admin/NewProduct',formData).then((response) => {
                    this.cleanErrors();
                    this.Alert.message='تمّت اضافة منتج جديد';
                    this.$refs.MySuccessAlert.showModel();
                }).catch((error) => {
                });
            },

            onUpdate(){
                let formData=new FormData(); 
                for(let key in this.form){
                    formData.append(key, this.form[key]);
                }
                store.dispatch('admin/updateProduct',formData).then((response) => {
                    this.cleanErrors();
                    this.Alert.message='تمّ تعديل المنتج بنجاح';
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