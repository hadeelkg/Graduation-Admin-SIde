<template>
  <div class="row row-custom">
      <!-- <div class="col-md-8">
        <div class="card text-right">
            <div class="card-header">
                تفاصيل المقال
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
                            <td>اسم العميل</td><td>:</td>
                            <td>{{Comment.name}}</td>
                        </tr>
                        <tr>
                            <td>الصورة</td><td>:</td>
                            <img v-for="(img, index) in Comment.media" :key="index" :src="img.url" class="comment_img" @click="showImage(index)"/>
                        </tr>
                        <tr>
                            <td>الايميل</td><td>:</td>
                            <td>{{(Comment.email)}}</td>
                        </tr>
                        <tr>
                            <td>محتوى التعليق</td><td>:</td>
                            <td>{{Comment.comment}}</td>
                        </tr>
                        <tr>
                            <td>الحالة</td><td>:</td>
                            <td>{{(Comment.is_approved)?'مقبول':'مرفوض'}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
      </div> -->
    </div>
</template>

<script>
    // import {mapState} from 'vuex';
    // import store from '../../../store/index';
    // export default {
    //     data(){
    //         return{
    //             selectedImage: null,
    //             showModal: false,
    //         }
    //     },

    //     computed:{
    //     ...mapState({
    //         Comment:state=>state.admin.Comments.comments.data,

    //         }),
    //     },

    //     created(){
    //         let comment_uuid=this.$route.params.uuid;
    //         store.commit('admin/PleaseStartLoading');
    //         store.dispatch('admin/viewSpecificComment',comment_uuid).then((response) => {
    //             store.commit('admin/PleaseStopLoading');
    //         });
    //     },

    //     methods:{
    //         showImage(index) {
    //             this.selectedImage = this.Comment.media[index];
    //             this.showModal = true;
    //             // console.log(this.selectedImage.url);
    //         },
    //         closeModal() {
    //             this.showModal = false;
    //             this.selectedImage = null;
    //         }
    //     }
    // }
</script>
<style scoped>
    .row-custom{
        justify-content: center;
    }
    .card .card-header {
        background: #37517e;
        color: white;
    }
    .comment_img{
    width: 80px;
    height: 80px;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin: 8px;
    border: 1px solid #ddd;
    cursor: pointer;
  }

  .comment_img:hover{
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
