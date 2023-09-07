<template>
   <div :class="class_bs">
    <div class="form__group field">
        <input style="text-align:right;" :value="MyValue" :class="{'invalid-border':errors[Mykey]}" :type="MyType" class="form__field" :placeholder="title"  :id='id' required @input="MyPrettyInput($event)" />
        <label :for="id" class="form__label">{{title}}</label>
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
        title:{
            type:String,
            default:'',
        },
        id:{
            type:String,
            default:'',
        },
        errors:{
            type:Object,
            default:[],
        },
        Mykey:{
            type:String,
            default:'',
        },
        MyValue:{
          type:String,
            default:'',
        },
        MyType:{
          type:String,
          default:'datetime-local',
        },
    },

    methods:{
        MyPrettyInput(value){
          this.$emit('Input',value.target.value);
        }
    }
  }
</script>

<style lang="scss" scoped>
  .invalid-feedback{
      color:#e91e1e;
      display:block;
  }
  .invalid-border{
      border-bottom: 1px solid #e91e1e !important;
  }
  $primary: #37517e;
  $secondary: #37517e;
  $black: #251c1c;
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