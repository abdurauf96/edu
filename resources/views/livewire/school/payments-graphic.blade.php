<div class="card">
    <div class="card-header">
        <h4>{{ $year }}-yil bo'yicha to'lovlar grafigi</h4>
        <div class="card-header-action">
            <div class="dropdown">
                <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">{{ $year }}</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item has-icon" wire:click="$emit('changeYear', 2021)">2021</a>
                    <a href="#" class="dropdown-item has-icon" wire:click="$emit('changeYear', 2022)">2022</a>
                    <a href="#" class="dropdown-item has-icon" wire:click="$emit('changeYear', 2023)">2023</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-inline text-center">
            <li class="list-inline-item p-r-30">
                <h5 class="m-b-0">{{ number_format($selectedYearAmount, 0, '.', ',')  }} so'm</h5>
                <p class="text-muted font-14 m-b-0">{{ $year }}-yilda jami</p>
            </li>
        </ul>
        <div class="recent-report__chart">
            <div id="chart2"></div>
        </div>
    </div>
</div>
@push('js')
    <!-- JS Libraies -->
    <script src="/admin/assets/bundles/apexcharts/apexcharts.min.js"></script>
    <script>
        let months=@js($months);
        let amounts=@js($amounts);
        window.addEventListener('changeYear', event => {
            chart2(event.detail.months,event.detail.amounts);
        })
        chart2(months,amounts);
        function chart2(months,amounts) {
            document.querySelector("#chart2").innerHTML = ''
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toLocaleString() + " so'm";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '14px',
                        colors: ["#9aa0ac"]
                    }
                },
                series: [{
                    name: 'Ushbu oydagi to\'lov',
                    data: amounts
                }],
                xaxis: {
                    categories: months,
                    position: 'top',
                    labels: {
                        offsetY: -18,
                        style: {
                            colors: '#9aa0ac',
                            fontSize: '14px'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#1340DE',
                                colorTo: '#1340DE',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        offsetY: -35,

                    }
                },
                fill: {
                    gradient: {
                        shade: 'light',
                        type: "horizontal",
                        shadeIntensity: 0.25,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [50, 0, 100, 100]
                    },
                    colors: ['#1e27d9']
                },
                yaxis: {
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: true,
                    },
                    labels: {
                        show: true,
                        formatter: function (val) {
                            return val.toLocaleString() + " so'm";
                        }
                    }
                },
                // title: {
                //     text: 'Joriy yil to\'lovlar grafigi',
                //     floating: true,
                //     offsetY: 320,
                //     align: 'center',
                //     style: {
                //         color: '#9aa0ac',
                //         fontSize:'22px',
                //     }
                // },
            }
            var chart = new ApexCharts(
                document.querySelector("#chart2"),
                options
            );
            chart.render();
        }
    </script>
@endpush
