<template>
  <div :class="class_bs" class="col-md-6 text-right mt-3">
    <div  class="form__group field row">
      <div class="col-md-6">
        {{title}}
      </div>
      <div class="col-md-6">
        <span class="toggle-wrapper" @click="toggle()" role="checkbox" :aria-checked="value.toString()" tabindex="0" @keydown.space.prevent="toggle()"
          :id="id">
          <span class="toggle-background" :style="backgroundStyles"></span>
          <span class="toggle-indicator" :style="indicatorStyles"></span>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:{

      value:{
        type:Boolean,
        default:false,
      },
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
        default:''
      }
    },

    computed: {
      backgroundStyles() {
        return {
          backgroundColor: this.value ? '#3490dc' : '#dae1e7'
        }
      },
      indicatorStyles() {
        return { transform: this.value ? 'translateX(2rem)' : 'translateX(0)' }
      }
    },

    methods:{
      toggle() {
        this.$emit('Input', !this.value);
        let result={
          'id':this.id,
          'status':'',
          'val':false,
        };
        result['status']=((!this.value)?'push':'pull' );
        result['val']=!this.value;
        this.$emit('GiveMeIfo',result);
      }
    }
  }
</script>

<style scoped lang="scss">
* { box-sizing: border-box }

  #app {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #fff;
    padding: 2rem;
  }

  .toggle-wrapper {
    display: inline-block;
    position: relative;
    cursor: pointer;
    height: 2rem;
    width: 4rem;
    border-radius: 9999px;
  }
  .toggle-wrapper:focus {
    outline: 0;
    box-shadow: 0 0 0 4px rgba(52,144,220,.5);
  }

  .toggle-background {
    display: inline-block;
    border-radius: 9999px;
    height: 100%;
    width: 100%;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    transition: background-color .2s ease;
  }

  .toggle-indicator {
    position: absolute;
    top: .25rem;
    left: .25rem;
    height: 1.5rem;
    width: 1.5rem;
    background-color: #fff;
    border-radius: 9999px;
    box-shadow:  0 2px 4px rgba(0,0,0,0.1);
    transition: transform .2s ease;
  }
</style>
