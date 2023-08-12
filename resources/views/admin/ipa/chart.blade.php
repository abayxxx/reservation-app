@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('title-1', 'Dashboard Admin')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.dashboard') }}
@endsection


@section('content')

<div class="row">
    <div class="card glass-card ">
        <div class=" col-xl-12 mb-0 p-0">
            <div class="card-body">
                <div class="card-block mt-3">
                    <!-- <i class="bi bi-info-circle text-white"></i>
                        <span class="text-white">Keterangan :</span>
                        <br> -->
                    <div class="form-group mb-1 " style="width: 20%;">
                        <label for="filter_bulan" class="mb-2 "><strong>Filter Data</strong></label>
                        <select name="filter_bulan" id="filter_bulan" class="form-control form-control-md">
                            <option value="0" disabled selected>-- Bulan --</option>
                            <option value="01">Januari - {{now()->format('Y')}}</option>
                            <option value="02">Februari - {{now()->format('Y')}}</option>
                            <option value="03">Maret - {{now()->format('Y')}}</option>
                            <option value="04">April - {{now()->format('Y')}}</option>
                            <option value="05">Mei - {{now()->format('Y')}}</option>
                            <option value="06">Juni - {{now()->format('Y')}}</option>
                            <option value="07">Juli - {{now()->format('Y')}}</option>
                            <option value="08">Agustus - {{now()->format('Y')}}</option>
                            <option value="09">September - {{now()->format('Y')}}</option>
                            <option value="10">Oktober - {{now()->format('Y')}}</option>
                            <option value="11">November - {{now()->format('Y')}}</option>
                            <option value="12">Desember - {{now()->format('Y')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kuadran I</h5>

                <!-- Bubble Chart -->
                <div id="bubbleChart1"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var series = @json($kuadranI) ?? []


                        var options = {
                            series: [{
                                name: 'Kuadran I',
                                data: series
                            }],
                            colors: ['#FF0000'],
                            chart: {
                                height: 333,
                                type: 'bubble',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: false,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                        svg: {
                                            filename: undefined,
                                        },
                                        png: {
                                            filename: undefined,
                                        }
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                opacity: 0.8
                            },
                            xaxis: {
                                type: 'numeric',
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                min: 0,
                                max: 5,
                                // range: [0, 5],

                            },
                            yaxis: {
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                max: 5,
                                labels: {
                                    formatter: function(value) {
                                        return value.toFixed(1); // Format the decimal places as needed
                                    }
                                }
                            }
                        }
                        var chart = new ApexCharts(document.querySelector("#bubbleChart1"), options);


                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.ipa.chart.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    console.log(data);
                                    chart.updateSeries([{
                                        name: 'Kuadran I',
                                        data: data.kuadranI.length > 0 ? data.kuadranI : [
                                            [0, 0, 0]
                                        ]
                                    }]);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();

                    });
                </script>
                <!-- End Bubble Chart -->

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kuadran II</h5>

                <!-- Bubble Chart -->
                <div id="bubbleChart2"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var series = @json($kuadranII) ?? []

                        var options = {
                            series: [{
                                name: 'Kuadran II',
                                data: series,
                            }],
                            colors: ['#008000'],
                            chart: {
                                height: 333,
                                type: 'bubble',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: false,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                        svg: {
                                            filename: undefined,
                                        },
                                        png: {
                                            filename: undefined,
                                        }
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                opacity: 0.8
                            },
                            xaxis: {
                                type: 'numeric',
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                min: 0,
                                max: 5,
                                // range: [0, 5],

                            },
                            yaxis: {
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                max: 5,
                                labels: {
                                    formatter: function(value) {
                                        return value.toFixed(1); // Format the decimal places as needed
                                    }
                                }
                            }
                        }

                        var chart = new ApexCharts(document.querySelector("#bubbleChart2"), options);

                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.ipa.chart.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    console.log(data);
                                    chart.updateSeries([{
                                        name: 'Kuadran II',
                                        data: data.kuadranII.length > 0 ? data.kuadranII : [
                                            [0, 0, 0]
                                        ]
                                    }]);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();
                    });
                </script>
                <!-- End Bubble Chart -->

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kuadran III</h5>

                <!-- Bubble Chart -->
                <div id="bubbleChart3"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var series = @json($kuadranIII) ?? []

                        var options = {
                            series: [{
                                name: 'Kuadran III',
                                data: series,
                            }],
                            colors: ['#FFFF00'],
                            chart: {
                                height: 333,
                                type: 'bubble',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: false,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                        svg: {
                                            filename: undefined,
                                        },
                                        png: {
                                            filename: undefined,
                                        }
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                opacity: 0.8
                            },
                            xaxis: {
                                type: 'numeric',
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                min: 0,
                                max: 5,
                                // range: [0, 5],

                            },
                            yaxis: {
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                max: 5,
                                labels: {
                                    formatter: function(value) {
                                        return value.toFixed(1); // Format the decimal places as needed
                                    }
                                }
                            }
                        }
                        var chart = new ApexCharts(document.querySelector("#bubbleChart3"), options);

                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.ipa.chart.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    console.log(data);
                                    chart.updateSeries([{
                                        name: 'Kuadran III',
                                        data: data.kuadranIII.length > 0 ? data.kuadranIII : [
                                            [0, 0, 0]
                                        ]
                                    }]);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();

                    });
                </script>
                <!-- End Bubble Chart -->

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kuadaran IV</h5>

                <!-- Bubble Chart -->
                <div id="bubbleChart4"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var series = @json($kuadranIV) ?? []

                        var options = {
                            series: [{
                                name: 'Kuadran IV',
                                data: series
                            }],
                            colors: ['#800080'],
                            chart: {
                                height: 333,
                                type: 'bubble',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: false,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                        svg: {
                                            filename: undefined,
                                        },
                                        png: {
                                            filename: undefined,
                                        }
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                opacity: 0.8
                            },
                            xaxis: {
                                type: 'numeric',
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                min: 0,
                                max: 5,
                                // range: [0, 5],

                            },
                            yaxis: {
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                max: 5,
                                labels: {
                                    formatter: function(value) {
                                        return value.toFixed(1); // Format the decimal places as needed
                                    }
                                }
                            }
                        }

                        var chart = new ApexCharts(document.querySelector("#bubbleChart4"), options);


                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.ipa.chart.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    chart.updateSeries([{
                                        name: 'Kuadran IV',
                                        data: data.kuadranIV.length > 0 ? data.kuadranIV : [
                                            [0, 0, 0]
                                        ]
                                    }]);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();
                    });
                </script>
                <!-- End Bubble Chart -->

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kuadran III</h5>

                <!-- Bubble Chart -->
                <div id="bubbleChart5"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var series1 = @json($kuadranI) ?? []
                        var series2 = @json($kuadranII) ?? []
                        var series3 = @json($kuadranIII) ?? []
                        var series4 = @json($kuadranIV) ?? []

                        var options = {
                            series: [{
                                    name: 'Kuadran I',
                                    data: series1,
                                },
                                {
                                    name: 'Kuadran II',
                                    data: series2,
                                },
                                {
                                    name: 'Kuadran III',
                                    data: series3,
                                },
                                {
                                    name: 'Kuadran IV',
                                    data: series4,
                                }
                            ],
                            colors: ['#FF0000', '#008000', '#FFFF00', '#800080'],
                            chart: {
                                height: 333,
                                type: 'bubble',
                                toolbar: {
                                    show: true,
                                    offsetX: 0,
                                    offsetY: 0,
                                    tools: {
                                        download: true,
                                        selection: false,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false | '<img src="/static/icons/reset.png" width="20">',
                                        customIcons: []
                                    },
                                    export: {
                                        csv: {
                                            filename: undefined,
                                            columnDelimiter: ',',
                                            headerCategory: 'category',
                                            headerValue: 'value',
                                            dateFormatter(timestamp) {
                                                return new Date(timestamp).toDateString()
                                            }
                                        },
                                        svg: {
                                            filename: undefined,
                                        },
                                        png: {
                                            filename: undefined,
                                        }
                                    },
                                    autoSelected: 'zoom'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                opacity: 0.8
                            },
                            xaxis: {
                                type: 'numeric',
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                min: 0,
                                max: 5,
                                // range: [0, 5],

                            },
                            yaxis: {
                                decimalsInFloat: 1,
                                tickAmount: 10,
                                max: 5,
                                labels: {
                                    formatter: function(value) {
                                        return value.toFixed(1); // Format the decimal places as needed
                                    }
                                }
                            }
                        }
                        var chart = new ApexCharts(document.querySelector("#bubbleChart5"), options);

                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.ipa.chart.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    chart.updateSeries([{
                                        name: 'Kuadran I',
                                        data: data.kuadranI.length > 0 ? data.kuadranI : [
                                            [0, 0, 0]
                                        ]
                                    }, {
                                        name: 'Kuadran II',
                                        data: data.kuadranII.length > 0 ? data.kuadranII : [
                                            [0, 0, 0]
                                        ]
                                    }, {
                                        name: 'Kuadran III',
                                        data: data.kuadranIII.length > 0 ? data.kuadranIII : [
                                            [0, 0, 0]
                                        ]
                                    }, {
                                        name: 'Kuadran IV',
                                        data: data.kuadranIV.length > 0 ? data.kuadranIV : [
                                            [0, 0, 0]
                                        ]
                                    }]);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();

                    });
                </script>
                <!-- End Bubble Chart -->

            </div>
        </div>
    </div>
</div>

@endsection

{{-- addons css --}}
@push('css')

<style>
    .dashboard .info-card h6 {
        font-size: 18px !important;
    }
</style>

@endpush