<template>
    <div v-if="showModal" class="myModal" @click.self=" closeModal">
        <div class="modal-content">
            <span class="close" @click="closeModal">&times;</span>
            <img :src="selectedImage" alt="Preview" class="modal-image">
        </div>
    </div>
</template>

<script>
export default {
    props:{
        selectedImage:{
            type:String,
            default:null
        },
        showModal:{
            type:Boolean,
            default:false
        }

    },

    methods:{

    }
}
</script>

<style lang="scss" scoped> 
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