<template>
    <div>
      <canvas id="chart"></canvas>
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
      const chrt = document.getElementById('chart');
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