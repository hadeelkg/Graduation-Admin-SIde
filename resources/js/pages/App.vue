<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';

  export default {
    name:'App',
    data() {
      return {
        fullPage: true
      }
    },
   
  }
</script>

