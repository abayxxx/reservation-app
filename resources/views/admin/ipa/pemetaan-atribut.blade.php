@extends('layouts.admin')

@section('title', 'Tingkat Kesesuaian')
@section('title-1', 'Tingkat Kesesuaian')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.ipa.tingkat-kesesuaian') }}
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card bg-warning" style=" width:20%; margin-bottom: 10px">
            <div id="keterangan" class="card-block p-2 ">
                <i class="bi bi-info-circle text-white"></i>
                <span class="text-white">Keterangan Kuadaran</span>
                <br>
            </div>
        </div>
        <div class="card glass-card " style="background-color: #5bc0de;">
            <div class=" col-xl-12 mb-0 p-0">
                <div class="card-body">
                    <div class="card-block mt-3">
                        <!-- <i class="bi bi-info-circle text-white"></i>
                        <span class="text-white">Keterangan :</span>
                        <br> -->
                        <span class="text-white">Pada hasil pengukuran yang diperoleh dari metode IPA digunakan hanya untuk mengetahui atribut yang harus diperbaiki atau dikurangi, berdasarkan pemetaan kuadran yang didapatkannya supaya menjadi perhatian atau peringatan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card p-2">
            <div class=" col-xl-12 mb-0 p-0">
                <div class="card-body">
                    <div class="card-block p-2 mt-3">
                        <div class="form-group mb-5 " style="width: 20%;">
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
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table  nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Pertanyaan</th>
                                        <th>Pemetaan Atribut</th>
                                        <th>Keterangan</th>
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
@include('admin.ipa.modal._modal')

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

        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('admin.ipa.pemetaan-atribut') }}",
                data: function(d) {
                    d.filter_bulan = $('#filter_bulan').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kode_atribut',
                    name: 'kode_atribut'
                },
                {
                    data: 'pertanyaan',
                    name: 'pertanyaan'
                },
                {
                    data: 'pemetaan_atribut',
                    name: 'pemetaan_atribut'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
            ]
        });


        $('#filter_bulan').on('change', function() {

            $('#order-table').DataTable().ajax.reload();
        });

        $('#keterangan').on('click', function() {
            $('#modal-feature').modal('show');
        })
    });
</script>
@endpush