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
                        <p id="sumX" style="font-weight: 700;">Keseluruhan Rata Rata X : {{$sumX}}</p>
                        <span id="sumY" style="font-weight: 700;">Keseluruhan Rata Rata Y : {{$sumY}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script>
    $(document).ready(function() {

        $('#filter_bulan').on('change', function() {
            $.ajax({
                url: '/admin/ipa/keseluruhan-rata-rata', // Replace with your route
                method: 'GET',
                data: {
                    filter_bulan: $('#filter_bulan').val()
                },
                success: function(response) {
                    // Update the content of the result element
                    $('#sumX').text(`Keseluruhan Rata Rata X : ${response.sumX}`);
                    $('#sumY').text(`Keseluruhan Rata Rata Y : ${response.sumY}`);
                }
            });
        });

    });
</script>
@endpush