@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('title-1', 'Dashboard Admin')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.dashboard') }}
@endsection


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="form-group  px-3 py-3" style="width: 30%;">
                <label for="filter_bulan" class="mb-2 "><strong>Filter Data</strong></label>
                <select name="filter_bulan" id="filter_bulan" class="form-control form-control-md">
                    <option value="0" disabled selected>-- Bulan --</option>
                    <option value="2024-01">Januari - {{now()->format('Y')}}</option>
                    <option value="2024-02">Februari - {{now()->format('Y')}}</option>
                    <option value="2024-03">Maret - {{now()->format('Y')}}</option>
                    <option value="2024-04">April - {{now()->format('Y')}}</option>
                    <option value="2024-05">Mei - {{now()->format('Y')}}</option>
                    <option value="2024-06">Juni - {{now()->format('Y')}}</option>
                    <option value="2024-07">Juli - {{now()->format('Y')}}</option>
                    <option value="2024-08">Agustus - {{now()->format('Y')}}</option>
                    <option value="2024-09">September - {{now()->format('Y')}}</option>
                    <option value="2024-10">Oktober - {{now()->format('Y')}}</option>
                    <option value="2024-11">November - {{now()->format('Y')}}</option>
                    <option value="2024-12">Desember - {{now()->format('Y')}}</option>
                </select>
            </div>
            <div class="filter">

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6><i class="bi bi-graph-up"></i> Export Data</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                    <li><a class="dropdown-item" href="#">Bulan Sebelumnya</a></li>
                    <li><a class="dropdown-item" href="#">Tahun Ini</a></li>

                </ul> -->
            </div>
            <div class="card-body">
                <h5 class="card-title">Grafik Responden 30 Hari</h5>

                <!-- Line Chart -->
                <div id="reportsChart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var data = @json($resultOrder);
                        console.log(data)
                        var datePerFiveDays = @json($datesPerFiveMonths);
                        var options = {
                            series: [{
                                name: 'Transaksi Masuk',
                                data: data
                            }],
                            chart: {
                                height: 350,
                                type: 'area',
                                toolbar: {
                                    show: false
                                },
                            },
                            markers: {
                                size: 4
                            },
                            colors: ['#9FE6B8', '#ff771d'],
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100]
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            xaxis: {
                                type: 'date',
                                categories: datePerFiveDays,
                            },
                            yaxis: {
                                labels: {
                                    formatter: function(value) {
                                        return value; // Format the decimal places as needed
                                    }
                                }
                            },
                            tooltip: {
                                x: {
                                    format: 'dd/MM/yy'
                                },
                            }
                        };
                        var chart = new ApexCharts(document.querySelector("#reportsChart"), options);

                        $('#filter_bulan').on('change', function() {
                            var selectedMonth = $(this).val();

                            renderChart(selectedMonth);
                        });

                        function renderChart(month) {
                            $.ajax({
                                type: 'GET',
                                url: '{{route("admin.dashboard.data")}}', // Replace with your Laravel route to fetch data for the selected month
                                data: {
                                    month: month
                                },
                                success: function(data) {
                                    // Process the data and update the chart
                                    updateChart(data);
                                },
                                error: function() {
                                    alert('Failed to fetch data.');
                                }
                            });
                        }

                        chart.render();

                        function updateChart(data) {
                            // Format the x-axis data to a valid datetime format (e.g., ISO 8601)
                            chart.updateOptions({
                                xaxis: {
                                    type: 'date',
                                    categories: data.datesPerFiveMonths
                                }
                            });
                            chart.updateSeries([{
                                data: data.resultOrder
                            }, ]);


                        }
                    });
                </script>
                <!-- End Line Chart -->

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