<template>
  <footer class="footer">
    <div class="container-fluid">
      <div class="copyright float-center" style="color:#999;">
        جميع الحقوق محفوظة
          &copy; 
        {{getCurrentYear}}
      </div>
    </div>
  </footer>
</template>

<script>
  export default {
    computed:{
      getCurrentYear(){
        var currentYear= new Date().getFullYear(); 
        return currentYear;
      }
    }
  }
</script>

<style>

</style>