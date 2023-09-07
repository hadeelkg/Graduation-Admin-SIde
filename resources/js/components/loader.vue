<template>
  <div v-if="startLoading">
    <div class="spin">
      <div class="ring">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        <!-- <div id="loading"></div> -->
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:{
      startLoading:{
        type:Boolean,
        default:false,
      },
    }
  }
</script>

<style>

  @import url(https://fonts.googleapis.com/css?family=Roboto:100);
  body { 
      color: #ffffff; 
      text-align:center; 
    }

  .spin {
      z-index: 999999;
      width: 100%;
      height: 100%;
      position: fixed;
      text-align: center;
      background-color: rgb(140, 140, 167);
      opacity: 0.6;
      display: flex;
      justify-content: center;
      align-items: center;
    }

  .lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #ffffff;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}

</style>