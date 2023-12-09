<template>
    <div class="container-fluid">
        <div class="row" style="margin-top:80px">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-stats box">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <span class="material-icons">
                                apartment
                            </span>
                        </div>
                        <h3 class="card-title num" :data-val="Statistics.city_count"
                        name="cities_count">{{ Statistics.city_count }}</h3>
                        <p class="card-category">عدد المدن</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-stats box">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <span class="material-icons">
                                group_add
                            </span>
                        </div>
                        <h3 class="card-title num" :data-val="Statistics.client_count"
                        name="client_count">{{ Statistics.client_count }}</h3>
                        <p class="card-category">عدد العملاء</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-stats box">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <span class="material-icons">
                                article
                            </span>
                        </div>
                        <h3 class="card-title num" :data-val="Statistics.order_count"
                        name="orders_count">{{Statistics.order_count}}</h3>
                        <p class="card-category">عدد الطلبيات</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-stats box">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <span class="material-icons">
                                medical_services
                            </span>
                        </div>
                        <h3 class="card-title num"  :data-val="Statistics.product_count"
                        name="products_count">{{ Statistics.product_count }}</h3>
                        <p class="card-category">عدد المنتجات</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <BarChart v-if="load" :type="bar" :data="barData"/>
                    <h4 style="color:#999;">وظائف أعضاء الفريق</h4>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <line-chart v-if="load" :type="line" :data="lineData" />
                    <h4 style="color:#999;">عدد المشاريع المسجلة كل عام</h4>
                </div>
            </div> -->
            <DonutChart :chartData="chartData" :options="chartOptions" />

        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import store from '../store/index';
    import BarChart from '../components/BarChart.vue';
    import LineChart from '../components/LineChart.vue';

    // import { defineComponent } from "vue";
    import DonutChart from "../components/DonutChart.vue";
    export default {
        data(){
            return{
                load:false,
                // barName: 'Bar Chart',
                // bar: 'bar',
                // barData: {
                //     labels: [],
                //     datasets: [{
                //     label: 'وظائف أعضاء الفريق',
                //     data: [],
                //     backgroundColor: [
                //         '#41b8e7',
                //         '#042033',
                //         '#803349',
                //     ],
                //     borderWidth: 2
                //     }]
                // },

                // lineName: 'Line Chart',
                // line: 'line',
                // lineData: {
                //     labels: [],
                //     datasets: [{
                //         label: 'عدد مشاريع كل عام',
                //         data: [],
                //         borderWidth: 1,
                //         hoverOffset: 8
                //     }]
                // },

                chartData: {
                    labels: ["Label 1", "Label 2", "Label 3"],
                    datasets: [
                    {
                        data: [10, 20, 30],
                        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
                    },
                    ],
                },
                chartOptions: {
                    // Add any additional chart options here
                },
            };
        },

        components:{
            BarChart,
            LineChart,
            DonutChart,
        },

        computed:{
        ...mapState({
            Statistics:state=>state.admin.Statistics.statistics.data,
            }),
        },

        async created(){
            store.commit('admin/PleaseStartLoading');
            store.dispatch('admin/fetchStatistics').then((response) =>{
                store.commit('admin/PleaseStopLoading');

                // fill charts with data from backend
                // this.Statistics.position_members.forEach(element => {
                //     this.barData.labels.push(element.position);
                //     });
                // this.Statistics.position_members.forEach(element => {
                //     this.barData.datasets[0].data.push(element.members_count);
                //     });

                // this.Statistics.projects_by_year.forEach(element => {
                //         this.lineData.labels.push(element.year);
                //     });
                // this.Statistics.projects_by_year.forEach(element => {
                //     this.lineData.datasets[0].data.push(element.count);
                //     });


                // animated counter
                let valueDisplays = document.querySelectorAll(".num");
                let interval = 1000;
                valueDisplays.forEach((valueDisplay) => {
                    let startValue = 0;
                    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
                    if(endValue != 0){
                        let duration = Math.floor(interval / endValue);
                        let counter = setInterval(function () {
                            startValue += 1;
                            valueDisplay.textContent = startValue;
                            if (startValue == endValue) {
                                clearInterval(counter);
                            }
                        }, duration);
                    }
                });
                // end animated counter
                this.load=true;
            });
        },
    }
</script>

<style lang="scss" scoped>
    .box{
        height:120px;
    }

    p{
        font-size:21px !important;
        margin: 15px 0 0 0 !important;
    }

    h3{
        font-size:30px;
    }

</style>
