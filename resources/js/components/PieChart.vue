<template>
    <div>
      <canvas id="chart3"></canvas>
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
      const chrt3 = document.getElementById('chart3');
      const chart = new Chart(chrt3, {
        type: this.type,
        data: this.data
      });
      chart;
    }
  }
</script>

<style>

</style>