<template>
  <div class="col-md-6 custom-pos">
    <span class="color-picker">
      <label for="colorPicker">
        <input type="color" :value="color" id="colorPicker">
      </label>
    </span>  
  </div>
</template>

<script>
  export default {
    props:['color'],

    mounted(){
      let that=this;
      document.querySelectorAll('input[type=color]').forEach(function(picker) {
        var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
        codeArea = document.createElement('span');
        codeArea.innerHTML = picker.value;
        targetLabel.appendChild(codeArea);
        
        picker.addEventListener('change', function() {
          codeArea.innerHTML = picker.value;
          that.$emit('input_value',picker.value)
          targetLabel.appendChild(codeArea);
        });
      });
    }
  }
</script>

<style>
 
  code {
    padding: 5px 8px;
    border-radius: 10px;
    background-color: #f8f9f9;
    color: #CC0066;
  }

  [type='color'] {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    padding: 0;
    width: 15px;
    height: 15px;
    border: none;
  }

  [type='color']::-webkit-color-swatch-wrapper {
    padding: 0;
  }

  [type='color']::-webkit-color-swatch {
    border: none;
  }

  .color-picker {
    padding: 10px 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    background-color: #f8f9f9;
  }
  .custom-pos{
      text-align: right;
      margin-top: 35px;
  }
</style>