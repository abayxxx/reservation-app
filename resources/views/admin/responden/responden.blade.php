@extends('layouts.admin')

@section('title', 'Data Responden')
@section('title-1', 'Data Responden')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.pertanyaan') }}
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card p-2">
            <div class=" col-xl-12 mb-0 p-0">
                <div class="card-body">
                    <div class="card-block p-2 mt-3">
                        <div class="col-12 mb-3">
                            <div class="form-group mb-5" style="width: 20%;">
                                <label for="filter_bulan" class="mb-2 "><strong>Filter Data</strong></label>
                                <select name="filter_bulan" id="filter_bulan" class="form-control form-control-md">
                                    <option value="0" disabled selected>-- Bulan --</option>
                                    <option value="1">Januari - {{now()->format('Y')}}</option>
                                    <option value="2">Februari - {{now()->format('Y')}}</option>
                                    <option value="3">Maret - {{now()->format('Y')}}</option>
                                    <option value="4">April - {{now()->format('Y')}}</option>
                                    <option value="5">Mei - {{now()->format('Y')}}</option>
                                    <option value="6">Juni - {{now()->format('Y')}}</option>
                                    <option value="7">Juli - {{now()->format('Y')}}</option>
                                    <option value="8">Agustus - {{now()->format('Y')}}</option>
                                    <option value="9">September - {{now()->format('Y')}}</option>
                                    <option value="10">Oktober - {{now()->format('Y')}}</option>
                                    <option value="11">November - {{now()->format('Y')}}</option>
                                    <option value="12">Desember - {{now()->format('Y')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table  nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jawaban</th>
                                        <th>Action</th>
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

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <h5 align="center" id="confirm">Apakah anda yakin ingin menghapus data ini?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-sm btn-outline-danger">Hapus</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
@include('admin.responden.modal._modal')
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
            responsive: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('admin.responden') }}",
                data: function(d) {
                    d.filter_bulan = $('#filter_bulan').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'jawaban',
                    name: 'jawaban'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ]
        });

        $('#filter_bulan').on('change', function() {
            $('#order-table').DataTable().ajax.reload();
        });

        $(document).on('click', '.jawaban', function() {
            var orderedList = $("#list-jawaban");
            orderedList.empty();
            $.ajax({
                url: '/admin/responden/jawaban', // Replace with your route
                method: 'GET',
                data: {
                    responden_id: $(this).attr('id')
                },
                success: function(response) {
                    console.log(response);
                    // Update the content of the result element
                    response.data.forEach(element => {
                        orderedList.append(`<div class="mb-2">
                        <li>${element.pertanyaan.pertanyaan}</li>
                        <span style="display: block;">Jawaban Tingkat Kinerja : <span style="color: green; font-weight: 700">${getStringMP(element.jawaban_pertama)}</span>
                        </span>
                        <span>Jawaban Tingkat Harapan/Kepentingan : <span style="color: red; font-weight: 700">${getStringMI(element.jawaban_kedua)}</span>
                        </span>
                    </div>`);
                    });
                }
            });

            $('#modal-feature').modal('show');

        });

        function getStringMP(jawaban) {
            switch (jawaban) {
                case "5":
                    return "Sangat Puas";
                    break;
                case "4":
                    return "Puas";
                    break;
                case "3":
                    return "Cukup Puas";
                    break;
                case "2":
                    return "Kurang Puas";
                    break;
                case "1":
                    return "Tidak Puas";
                    break;
                default:
                    break;
            }
        }

        function getStringMI(jawaban) {
            switch (jawaban) {
                case "5":
                    return "Sangat Penting";
                    break;
                case "4":
                    return "Penting";
                    break;
                case "3":
                    return "Cukup Penting";
                    break;
                case "2":
                    return "Kurang Penting";
                    break;
                case "1":
                    return "Tidak Penting";
                    break;
                default:
                    break;
            }
        }



        //HANDLE DELETE DATA
        $(document).on('click', '.delete', function() {
            let pertanyaan_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: "DELETE",
                        url: '/admin/responden/' + pertanyaan_id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                icon: 'info',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            setTimeout(function() {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Responden  deleted successfully',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#order-table').DataTable().ajax.reload();
                            }, 500);
                        },
                        error: function(errors) {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                            Swal.hideLoading();
                        }
                    });
                }
            })
        });

    });
</script>
@endpush