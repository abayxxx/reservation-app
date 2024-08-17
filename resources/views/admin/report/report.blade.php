@extends('layouts.admin')

@section('title', 'Data Transaksi')
@section('title-1', 'Data Transaksi')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.report') }}
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card p-2">
            <div class=" col-xl-12 mb-0 p-0">
                <div class="card-body">
                    <div class="form-group d-flex" style="width: 100%;">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" required class="form-control form-control-sm">
                        </div>
                        <div class="form-group px-5">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" required class="form-control form-control-sm">
                        </div>
                        <button id="filter" class="btn btn-primary shadow-sm my-3"><i class="bi"></i> Lihat</button>
                    </div>
                </div>
                <div class="card-block">
                    <div class="text-center">
                        <button id="pdf" class="btn btn-outline-success shadow-sm my-3"><i class="bi bi-file"></i> PDF</button>
                        <button id="excel" class="btn btn-outline-primary shadow-sm my-3"><i class="bi bi-file"></i> Excel</button>
                        <button id="csv" class="btn btn-outline-warning shadow-sm my-3"><i class="bi bi-file"></i> Csv</button>
                    </div>
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table  nowrap shadow-sm">
                            <thead class="text-left">
                                <tr>
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- Modal --}}
@endsection

{{-- addons css --}}
@push('css')

<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/Responsive-2.4.0/css/responsive.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/DataTables-1.13.1/css/dataTables.bootstrap4.min.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</link>

<style>
    .btn i {
        margin-right: 0px;
    }
</style>
@endpush

{{-- addons js --}}
@push('js')
<script type="text/javascript" src="{{ asset('bower_components/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/DataTables-1.13.1/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/Responsive-2.4.0/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/Responsive-2.4.0/js/responsive.bootstrap4.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('admin.report') }}",
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'total',
                    name: 'total'
                },
            ]
        });


        //hanlde print
        $(document).on('click', '.print', function() {
            let order_id = $(this).attr('id');
            window.open('/admin/order/print/' + order_id, '_blank');
        });


        function formatRupiah(number) {
            // Convert number to string and add thousands separator
            var numberString = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Add Rp and ,00
            return 'Rp ' + numberString;
        }

        //hanlde filter date
        $('#filter').click(function() {
            table.draw();
        });

        //hanlde print
        $(document).on('click', '#pdf', function() {
            let order_id = $(this).attr('id');
            window.open('/admin/report/print/', '_blank');
        });

        //handle excel
        $(document).on('click', '#excel', function() {
            let order_id = $(this).attr('id');
            window.open('/admin/report/excel/', '_blank');
        });

        //handle csv
        $(document).on('click', '#csv', function() {
            let order_id = $(this).attr('id');
            window.open('/admin/report/csv/', '_blank');
        });

    });
</script>
@endpush