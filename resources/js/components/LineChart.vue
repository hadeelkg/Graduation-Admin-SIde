<template>
    <div>
      <canvas id="chart2"></canvas>
    </div>
</template>

<script>
  import Chart from 'chart.js';
  export default {
    name: 'ChartJs',
    props: {
      type: String,
      data: {}
    },
    
    mounted() {
      const chrt = document.getElementById('chart2');
      const chart = new Chart(chrt, {
        type: this.type,
        data: this.data
      });
      chart;
    }
  }
</script>

<style>

</style>