<template>
    <div :class="class_bs">
      <div class="form__group field" :class="{'top_pos':top_pos}">
          <select :class="{'invalid-border':errors[Mykey]}" class="form-control select2" style="width: 100%;" @change="MyPrettySelect($event)">
              <option v-if="title!='false'" value="">{{title}}</option>
              <option v-for="(item,index) in Items" :key="index" :value="item.id" :selected="item.id == MyValue">{{item.name}}</option>
          </select>
          <span class="invalid-feedback" v-if="errors[Mykey]">{{errors[Mykey][0]}}</span>
      </div>
    </div>
</template>
<script>
  export default {
    props:{
        class_bs:{
          type:String,
          default:'col-md-6'
        },
        invalid_class: {
          border:'red',
        },
        title:{
          type:String,
          default:'',
        },
        id:{
          type:String,
          default:'',
        },
        Items:{
          type:Array,
          default:[],
        },
        errors:{
          type:Object,
          default:[],
        },
        Mykey:{
          type:String,
          default:'',
        },
        DaynamicKey:{
          type:String,
          default:'',
        },
        MyValue:{
          type:String,
          default:'',
        },
        top_pos:{
          type:Boolean,
          default:false,
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

  .invalid-feedback{
      color:#e91e1e;
      display:block;
  }
  .invalid-border-daynamic{
    background-image: none !important;
    border-bottom: 1px solid #E91E1E !important;
  }
  .invalid-border{
      background-image: none !important;
      border-bottom: 1px solid #E91E1E !important;
  }
  $primary: #37517e;
  $secondary: #37517e;
  $black: #A9AFBB;
  $gray: #D2D2D2;
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
  select{
    appearance: auto;
  }
  .top_pos{
    padding: 0 !important;
    margin-top: 0 !important;
  }
</style>







