<template>
  <select  class="form-control select2" style="width: 100%;" @change="MyPrettySelect($event)">
    <option value="">{{title}}</option>
    <option  v-for="(item,index) in MyItems" :key="index" :value="item.id" :selected="item.id == MyValue">{{item.name}}</option>
  </select>
</template>

<script>
  export default {
    name:'PerPage',   
    props:{
      title:{
        type:String,
        default:'',
      },
      id:{
        type:String,
        default:'',
      },
      Mykey:{
        type:String,
        default:'',
      },
      MyValue:{
        type:String,
          default:'',
      }
    },

    computed:{
      MyItems(){
        return [
          {id:5,name:'5'},{id:10,name:'10'},{id:20,name:'20'},{id:50,name:'50'},{id:100,name:'100'},{id:500,name:'500'}
        ];    
      }   
    },

    methods:{
        MyPrettySelect(value){
          this.$emit('Select',value.target.value);
        }
    }
  }
</script>

<style lang="scss" scoped>

  $primary: #37517e;
  $secondary: #37517e;
  $black: #a9afbb;
  $gray: #d2d2d2;
  $gray-dark: #495057;
  .form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 10px;
    text-align: start;
  }
  .form__field {
    width: 100%;
    border: 0;
    border-bottom: 1px solid $gray;
    outline: 0;
    font-size: .875rem;
    color: $black;
    padding: 7px 0;
    background: transparent;
    transition: border-color 0.2s;

    &::placeholder {
      color: transparent;
    }
    &:placeholder-shown ~ .form__label {
      font-size: .875rem;
      cursor: text;
      top: 20px;
    }
  }
  .form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size: .875rem;
    color: $gray-dark;
  }
  .form__field:focus {
    ~ .form__label {
      position: absolute;
      top: 0;
      display: block;
      transition: 0.2s;
      font-size: 1rem;
      color: $primary;
      font-weight:700;    
    }
    padding-bottom: 6px;  
    font-weight: 700;
    border-width: 2px;
    border-image: linear-gradient(to right, $primary,$secondary);
    border-image-slice: 1;
  }
  /* reset input */
  .form__field{
    &:required,&:invalid { box-shadow:none; }
  }
</style>