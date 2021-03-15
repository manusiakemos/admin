<template>
    <div class="d-flex justify-content-center align-content-center align-items-center small">
        <bar-chart
            class="bar-chart m-5"
            v-if="loaded"
            :chart-data="datacollection"
            :options="options"/>
        <bar-chart
            class="bar-chart m-5"
            v-if="loaded"
            :chart-data="datacollection"
            :options="options"/>
    </div>
</template>

<script>
    import BarChart from './BarChart.js'

    export default {
        components: {
            BarChart
        },
        data() {
            return {
                datacollection: null,
                options: {
                    /*plugins: {
                        datalabels: {
                            color: 'black',
                            labels: {
                                title: {
                                    font: {
                                        weight: 'bold'
                                    }
                                },
                                value: {
                                    color: 'green'
                                }
                            },
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = ((value / sum) * 100).toFixed(2) + "%";
                                return `${percentage} (${value})`;
                            },
                        }
                    },*/
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    maintainAspectRatio: true
                },
                loaded: true,
            }
        },
        created() {
            this.fillData()
        },
        methods: {
            fillData() {
                this.datacollection = {
                    labels: [this.getRandomInt(), this.getRandomInt()],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#96a4ff',
                            data: [this.getRandomInt(), this.getRandomInt()]
                        }, {
                            label: 'Data Two',
                            backgroundColor: '#3685ff',
                            data: [this.getRandomInt(), this.getRandomInt()]
                        }
                    ]
                }
            },
            getRandomInt() {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        }
    }
</script>

<style>
    .small{
        height:600px;
        width:100%;
    }
</style>
