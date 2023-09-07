<template>
    <div :class="class_bs" >
    <div class="form__group field">
        <label :class="{'invalid-border':errors[Mykey]}">
        <input :class="{'invalid-radio':errors[Mykey]}" type="radio" :id="id" :name="name"
        @change="SelectedGender($event)" :Mykey="Mykey" :MyValue="MyValue" :value="value" :checked="value == MyValue"/>
      </label>
      <label for=id class="form__label">{{MyTitle}}</label>
    </div>
  </div>
</template>

<script>
  export default {
    props:{

      MyValue:{
        type:String,
        default:'',
      },
      value:{
        type:String,
        default:'',
      },
      Mykey:{
        type:String,
        default:'',
      },
      name:{
        type:String,
        default:'',
      },
      class_bs:{
        type:String,
        default:'col-md-6',
      }, 
      title:{
        type:String,
        default:'',
      },
      MyTitle:{
        type:String,
        default:'',
      },
      id:{
        type:String,
        default:''
      },
      errors:{
        type:[Object, String],
        default:[],
      },
      top_pos:{
        type:Boolean,
        default:false,
      }
    },

    methods:{
      SelectedGender($event) 
      {
        this.$emit('changeInput', $event.target.id);
      }  
    }
  }
</script>
  
<style scoped lang="scss">
 
  .invalid-border{
      outline: none !important;
      border: 1px solid #e91e1e !important;
      border-radius: 50% !important;
      line-height: 0px !important;
  }

  $primary: #37517e;
  $secondary: #37517e;
  $black: #251c1c;
  $gray: #d2d2d2;
  $gray-dark: #495057;
  .form__group {
    position: relative;
    padding: 4px 0 0;
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
    transition: 0.2s;
    font-size: .875rem;
    color: $gray-dark;
  }
</style>
 
