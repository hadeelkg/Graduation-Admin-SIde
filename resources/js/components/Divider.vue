<template>
    <div class="h-divider">
        <div class="shadow"></div>
        <div class="text"><i>{{title}}</i></div>
    </div>
</template>

<script>
  export default {
    props:{
        title:{
          type:String,
          default:''
        }
    }
  }
</script>

<style>

  .h-divider {
    margin: auto;
    margin-top: 45px;
    width: 80%;
    position: relative;
    margin-bottom: 18px !important;
  }
  .h-divider .shadow {
    overflow: hidden;
    height: 20px;
  }
  .h-divider .shadow:after {
    content: '';
    display: block;
    margin: -25px auto 0;
    width: 100%;
    height: 25px;
    border-radius: 125px/12px;
    box-shadow: 0 0 8px black;
  }
  .h-divider .text {
    width: 131px;
    height: 60px;
    padding: 10px;
    position: absolute;
    bottom: 100%;
    margin-bottom: -33px;
    left: 50%;
    margin-left: -60px;
    border-radius: 100%;
    box-shadow: 0 2px 4px #999;
    background: white;
  }
  .h-divider .text i {
    position: absolute;
    top: 4px;
    bottom: 4px;
    left: 4px;
    right: 4px;
    border-radius: 100%;
    border: 1px dashed #aaa;
    text-align: center;
    line-height: 50px;
    font-style: normal;
    color: #999;
  }
</style>