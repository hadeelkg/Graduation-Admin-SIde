<template>
  <div class="container-fluid">
    <ConfirmAlert ref="MyConfirmAlert" :title="Alert.title" :message="Alert.message" @Sure="YesIamSure($event)" :sureResult="sureResult" />
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" />

    <div class="col-lg-12">
        <div class="row">
            <TextSelect title="بحث بالعلامة التجارية" :Items=BrandsList id="brand" @Select="HandleInput('brand',$event)" Mykey="brand" class_bs="col-md-3 col-sm-6" :MyValue="filter.brand"/>
            <TextSelect title="بحث بالفئة" :Items=Categories id="category" @Select="HandleInput('category',$event)" Mykey="category" class_bs="col-md-2 col-sm-6" :MyValue="filter.category"/>
            <TextSelect title="الجنس المُستهدف" id="target_sex" :Items=Gender @Select="HandleInput('target_sex',$event)" Mykey="target_sex" class_bs="col-md-3 col-sm-6" :MyValue="filter.target_sex"/>
            <div class="col-md-1 col-sm-1" style="margin-top: 25px;">
                <button @click="onSearch()" type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <router-link :to="{name: 'admin.dashboard.product.create'}" class="btn btn-primary btn-md add_btn" >
                اضافة منتج
                </router-link>
            </div>
        </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary" style="text-align: center;">
          <h4 class="card-title">قائمة المنتجات</h4>
          <p class="card-category">المنتجات الموجودة في النظام</p>
        </div>

        <ImageViewer v-if="selectedImage" :selectedImage="selectedImage" :showModal="showModal" @click="closeModal"/>

        <div class="card-body" style="text-align:center;">
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                  <th>#</th>
                  <th>صورة</th>
                  <th>الاسم</th>
                  <th>السعر</th>
                  <th>الكمية</th>
                  <th>إجراءات</th>
              </thead>
              <tbody>
                <tr v-for="(item, index) in Products.data" :key="index">
                  <td>{{index+1}}</td>
                  <td><img :src="'http://127.0.0.1:8000/storage/'+item.image_path" width="80"/></td>
                  <td>{{item.name}}</td>
                  <td>{{item.price}}</td>
                  <td>{{item.quantity}}</td>
                  <td class="text-primary">
                    <!-- <router-link :to="{name:'admin.dashboard.product.details', params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                        <i class="material-icons edit_icon">open_folder</i>
                    </router-link> -->
                    <router-link :to="{name:'admin.dashboard.product.details', params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                        <i class="material-icons details_icon">folder_open</i>
                    </router-link>
                    <router-link :to="{name:'admin.dashboard.product.edit', params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                        <i class="material-icons edit_icon">edit</i>
                    </router-link>
                    <button @click="deleteItem(item.id)" type="button" class="btn my_btn btn-sm">
                          <i class="material-icons delete_icon">delete</i>
                    </button>
                  </td>
                </tr>
                <tr v-if="!Products.data.length" centre>
                  <td colspan="9">
                      لاتوجد بيانات لعرضها
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {mapState,mapMutations} from 'vuex';
  import store from '../../../store/index';
  import ConfirmAlert from '../../../components/ConfirmAlert'
  import SuccessAlert from '../../../components/SuccessAlert'
  import ImageViewer from '../../../components/imageViewer.vue'
  import TextSelect from '../../../components/Form/TextSelect'

  export default {
    data(){
      return{
        Alert:{
          title:'معلومات',
          message:'',
        },

        filter:{
           category:'',
           brand:'',
           target_sex:'',
        },

        Gender:[
            {id:'male', name:'ذكر'},
            {id:'female', name:'انثى'},
            {id:'both', name:'كلاهما'}
        ],

        sureResult:true,
        product_id:'',

        selectedImage:null,
        showModal:false
      }
    },

    computed:{
      ...mapState({
        Products:state=>state.admin.Products.products,
        Categories:state=>state.admin.Categories.categories.data,
        BrandsList:state=>state.admin.Brands.brands.data,
        }),
    },

    components:{
      ConfirmAlert,
      SuccessAlert,
      ImageViewer,
      TextSelect,
    },

    created(){
      store.commit('admin/PleaseStartLoading');
      store.dispatch('admin/fetchCategories');
      store.dispatch('admin/fetchBrands');
      store.dispatch('admin/fetchProducts').then((response) => {
        store.commit('admin/PleaseStopLoading');
      })
    },

    methods:{

        HandleInput(key,value){
            this.filter[key]=value;
        },

        onSearch(){
            store.commit('admin/PleaseStartLoading');
            store.dispatch('admin/fetchProducts',this.filter).then(()=>{
                store.commit('admin/PleaseStopLoading');
            }).catch((error)=>{
            });
        },

      deleteItem(product_id){
        this.product_id = product_id;
        this.Alert.message='هل تريد حذف هذا المنتج؟';
        this.$refs.MyConfirmAlert.showModel();
      },

      YesIamSure(value){
        if(value && this.sureResult){
          this.sureResult=false;
          this.onDelete();
        }
      },

      CancelAlert(){
      this.sureResult=false;
      },

      onDelete(){
        this.$refs.MyConfirmAlert.hideModel();
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/deleteProduct',this.product_id).then((response) => {
          store.dispatch('admin/fetchProducts').then((response) => {
            store.commit('admin/PleaseStopLoading');
            this.sureResult=true;
              this.Alert.message='تم حذف المنتج بنجاح';
              this.$refs.MySuccessAlert.showModel();
          }).catch((error) => {

          });
        }).catch((error) => {
            this.Alert.message='لا يمكن حذف هذا المنتج!';
            this.$refs.MyConfirmAlert.showModel();
            store.commit('admin/PleaseStopLoading');
        });
      },

      showImage(img) {
          this.selectedImage = img.url;
          this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
        this.selectedImage = null;
      }

    },
  }
</script>

<style>
 .table_img{
    width: 100px;
    height: 100px;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.2), 0 0px 4px 0 rgba(0, 0, 0, 0.19);
    margin: 8px;
    border: 1px solid #ddd;
    cursor: pointer;
  }

  .table_img:hover{
    transform: scale(1.1);
    transition: all .2s ease-in-out;
  }
  .add_btn{
      background: linear-gradient(60deg, #343a40, #37517e);
    }
    .my_btn{
      box-shadow: 6px 8px 5px #dcd5d9;
      background: linear-gradient(white, white) padding-box,
                linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
      border-radius: 50em;
      border: 2px solid transparent;
      margin:3px;
    }
    .my_btn:hover{
      box-shadow: 0 2px 2px 0 #37517e, 0 3px 1px -2px #37517e, 0 1px 5px 0 rgb(170 71 186 / 12%);
      background: linear-gradient(white, white) padding-box,
                linear-gradient(to right,  #ffe3ed, #e9e3e7) border-box;
    }
    .details_icon{
    color: #37517e;
    }
    .edit_icon{
    color: #39ae00c7;
    }
    .delete_icon{
      color: #ff1e1ec7;
    }
</style>
