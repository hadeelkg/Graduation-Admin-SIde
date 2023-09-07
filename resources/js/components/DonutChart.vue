<template>
    <div>
      <canvas id="chart1"></canvas>
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
      const chrt1 = document.getElementById('chart1');
      const chart = new Chart(chrt1, {
        type: this.type,
        data: this.data
      });
      chart;
    }
  }
</script>

<style>

</style>