<template>
    <div class="row row-custom">
      <div class="col-md-10">
          <div class="card text-right">
              <div class="card-header">
                  تفاصيل الصيدلاني
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
                              <!-- <img v-for="(img, index) in Project.media" :key="index" :src="img.url" class="project_img" @click="showImage(index)"/> -->
                              <td><img :src="'http://127.0.0.1:8000/storage/'+Pharmacist.image_path" width="80"/></td>
                          </tr>
                          <tr>
                              <td>الاسم</td><td>:</td>
                              <td>{{Pharmacist.name}}</td>       
                          </tr>
                          <tr>
                            <td>نبذة عن الصيدلاني</td><td>:</td>
                            <td>{{Pharmacist.bio}}</td>       
                          </tr>
                          <tr>
                            <td>رقم الهاتف</td><td>:</td>
                            <td>{{Pharmacist.phone}}</td>       
                          </tr>
                          <tr>
                            <td>الوظيفة</td><td>:</td>
                            <td>{{Pharmacist.role}}</td>       
                          </tr>
                          <tr>
                            <td>رابط حساب الفيسبوك</td><td>:</td>
                            <td>{{Pharmacist.facebook_link}}</td>       
                          </tr>
                          <tr>
                            <td>تاريخ الادخال</td><td>:</td>
                            <td>{{Pharmacist.created_at}}</td>       
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
        Pharmacist:state=>state.admin.Pharmacists.pharmacists.data,
      }),
    },
  
    created(){
      let item_id=this.$route.params.id; 
      store.commit('admin/PleaseStartLoading');
      store.dispatch('admin/fetchPharmacist',item_id).then((response) => {
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
