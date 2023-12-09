<template>
    <div class="row row-custom">
      <div class="col-md-10">
          <div class="card text-right">
              <div class="card-header">
                  تفاصيل المنتج
              </div>
              <div v-if="showModal" class="myModal" @click.self=" closeModal">
                <div class="modal-content">
                    <span class="close" @click="closeModal">&times;</span>
                    <img :src="selectedImage.url" alt="Preview" class="modal-image">
                </div>
              </div>

              <div class="card-body">
                  <div class="row">
                      <table class="table">
                          <tr>
                            <td>صورة</td><td>:</td>
                            <td><img :src="'http://127.0.0.1:8000/storage/'+Product.image_path" width="80"/></td>
                          </tr>
                          <tr>
                            <td>الاسم</td><td>:</td>
                            <td>{{Product.name}}</td>
                          </tr>
                          <tr>
                            <td>نبذة عن المنتج</td><td>:</td>
                            <td>{{Product.description}}</td>
                          </tr>
                          <tr>
                            <td>سعر المنتج</td><td>:</td>
                            <td>{{Product.price}} دينار</td>
                          </tr>
                          <tr>
                            <td>الكمية المتوفرة</td><td>:</td>
                            <td>{{Product.quantity}} قطعة</td>
                          </tr>
                          <tr v-if="Product.category && Product.category.name">
                            <td>الفئة</td><td>:</td>
                            <td>{{Product.category.name}}</td>
                          </tr>
                          <tr v-if="Product.brand && Product.brand.name">
                            <td>العلامة التجارية</td><td>:</td>
                            <td>{{Product.brand.name}}</td>
                          </tr>
                          <tr>
                            <td>الجنس المُستهدف</td><td>:</td>
                            <td v-if="Product.target_sex='male'">ذكر</td>
                            <td v-else>انثى</td>
                          </tr>
                          <tr>
                            <td>تاريخ الادخال</td><td>:</td>
                            <td>{{Product.created_at}}</td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
</template>
<script>
  import {mapState} from 'vuex';
  import store from '../../../store/index';

  export default {
    data(){
      return{
        id:'',
        selectedImage: null,
        showModal: false,
      }
    },

    computed:{
      ...mapState({
        Product:state=>state.admin.Products.products.data,
      }),
    },

    created(){
      let product_id=this.$route.params.id;
      store.commit('admin/PleaseStartLoading');
      store.dispatch('admin/fetchProduct',product_id).then((response) => {
        store.commit('admin/PleaseStopLoading')
      });
    },

    methods:{
      showImage(index) {
        this.selectedImage = this.Pharmacist.image_path[index];
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
        this.selectedImage = null;
      }
    }
  }
</script>

<style scoped>
  .row-custom{
      justify-content: center;
  }

  .card .card-header {
      background: #37517e;
      color: white;
  }
  .project_img{
    width: 80px;
    height: 80px;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin: 8px;
    border: 1px solid #ddd;
    cursor: pointer;
  }

  .project_img:hover{
    transform: scale(1.2);
    transition: all .2s ease-in-out;
  }

  .myModal {
      display: block;
      position: fixed;
      z-index: 100000000000;
      padding-top: 50px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
      margin: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 50%;
      max-width: 800px;
      height: 80%;
    }

    .modal-image {
      width: 400px;
      height: 400px;
      object-fit: contain;
    }

    .close {
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 35px;
      font-weight: bold;
      color: #37517e;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: #8f1a41;
      text-decoration: none;
      cursor: pointer;
    }
</style>
