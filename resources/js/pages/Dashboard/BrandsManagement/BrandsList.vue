<template>
  <div class="container-fluid">
    <ConfirmAlert ref="MyConfirmAlert" :title="Alert.title" :message="Alert.message" @Sure="YesIamSure($event)" :sureResult="sureResult" />
    <SuccessAlert ref="MySuccessAlert" :title="Alert.title" :message="Alert.message" />
    <div class="col-md-12">
        <div class="col-lg-12 col-md-12 ">
          <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <router-link :to="{name: 'admin.dashboard.brand.create'}" class="btn btn-primary btn-md add_btn" >
                  اضافة علامة تجارية
                </router-link>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary" style="text-align: center;">
          <h4 class="card-title">قائمة العلامات التجارية للمنتجات</h4>
          <p class="card-category">العلامات التجارية للمنتجات الموجودة في النظام</p>
        </div>

        <div class="card-body" style="text-align:center;">
          <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>#</th>
                    <th>الاسم</th>
                    <th>اجراءات</th>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in BrandsList.data" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{item.name}}</td>
                    <td class="text-primary">
                      <router-link :to="{name:'admin.dashboard.brand.edit',  params:{id:item.id}}" type="button" class="btn my_btn btn-sm">
                        <i class="material-icons edit_icon">edit</i>
                      </router-link>
                      <button @click="deleteItem(item.id)" type="button" class="btn my_btn btn-sm">
                        <i class="material-icons delete_icon">delete</i>                      
                      </button>
                    </td>
                  </tr>
                  <tr v-if="!BrandsList.data.length" centre>
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
  export default {
      data(){
        return{
          Alert:{
            title:'معلومات',
            message:'',
            },

          brand_id:'',
          sureResult:true,
        }
      },

      components:{
        ConfirmAlert,
        SuccessAlert,
      },

      computed:{
        ...mapState({
          BrandsList:state=>state.admin.Brands.brands,
          }),
      },

      created(){
        store.commit('admin/PleaseStartLoading');
        store.dispatch('admin/fetchBrands').then(()=>{
          store.commit('admin/PleaseStopLoading');
          }).catch((error)=>{

          });      
      },

      methods:{

          deleteItem(brand_id){
            this.brand_id = brand_id;
            this.Alert.message='هل تريد حذف هذه العلامة التجارية؟';
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
            store.dispatch('admin/deleteBrand', this.brand_id).then((response) => {
              store.dispatch('admin/fetchBrands');
              store.commit('admin/PleaseStopLoading');
              this.sureResult=true;
              this.Alert.message='تم حذف العلامة التجارية بنجاح';
              this.$refs.MySuccessAlert.showModel();
            })
            .catch((error) => {
              this.Alert.message='لا يمكن حذف هذه العلامة التجارية  !';
              this.$refs.MyConfirmAlert.showModel();
            })
          }, 
      },
  }
</script>

<style>
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
  .edit_icon{
    color: #39ae00c7;
  }
  .delete_icon{
    color: #ff1e1ec7;
  }
</style>
