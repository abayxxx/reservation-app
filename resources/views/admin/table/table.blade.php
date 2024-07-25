@extends('layouts.admin')

@section('title', 'Data Meja')
@section('title-1', 'Data Meja')
@section('title-2', 'Dashboard')
@section('link')
{{ route('admin.table') }}
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card glass-card p-2">
            <div class=" col-xl-12 mb-0 p-0">
                <div class="card-body">
                    <div class="card-block p-2 mt-3">
                        <button id="add" class="btn btn-outline-primary shadow-sm my-3"><i class="bi bi-plus"></i> Tambah Meja</button>
                        <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table  nowrap shadow-sm">
                                <thead class="text-left">
                                    <tr>
                                        <th>No</th>
                                        <th>No Meja</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
@include('admin.table.modal._modal')
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
                url: "{{ route('admin.table') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $('#add').on('click', function() {
            $('.modal-title').html('Tambah Meja');
            $('#action').val('add');
            $('#description').removeClass('is-invalid');
            $('#number').removeClass('is-invalid');
            $('#status').val('');
            $('#btn')
                .val('Simpan');
            $('#modal-feature').modal('show');
        });


        //Form Submit add/update
        $('#form-feature').on('submit', function(event) {
            event.preventDefault();
            let url = '';
            let id = $('#hidden_id').val()
            if ($('#action').val() == 'add') {
                url = "{{ route('admin.table.store') }}";
            }
            if ($('#action').val() == 'edit') {
                url = "/admin/table/update/" + id;
            }
            let formData = new FormData($('#form-feature')[0]);

            var selectedValue = $('input[name="status"]:checked').val();
            console.log(selectedValue);

            //Append content from quil editor

            //disabled button
            $('#btn').prop('disabled', true);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
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
                    if (data.success) {
                        if ($('#action').val() == 'add') {
                            Swal.fire('Sukses!', 'Data berhasi ditambahkan!', 'success');
                        }
                        if ($('#action').val() == 'edit') {
                            Swal.fire('Sukses!', 'Data berhasi diupdate!', 'success');
                        }

                        $('#modal-feature').modal('hide');
                        $('#description').removeClass('is-invalid');
                        $('#number').removeClass('is-invalid');
                        $('#status').removeClass('is-invalid');
                        $('#form-feature')[0].reset();
                        $('#action').val('add');
                        $('#btn').prop('disabled', false);
                        $('#btn')
                            .val('Simpan');
                        $('#order-table').DataTable().ajax.reload();
                    }
                },
                error: function(errors) {
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                    Swal.hideLoading();
                    $('#btn').prop('disabled', false);
                }
            });
        });


        //HANDLE MODAL EDIT
        $(document).on('click', '.edit', function() {
            let mejaid = $(this).attr('id');
            $.ajax({
                url: '/admin/table/' + mejaid,
                dataType: 'JSON',
                success: function(data) {
                    $('#modal-title').html('Edit Meja')
                    $('#action').val('edit');
                    $('#description').val(data.description);
                    $('#number').val(data.number);
                    // $('#status').val(data.status);
                    $('#status_' + data.status).prop("checked", true);
                    $('#hidden_id').val(data.id);
                    $('#btn')
                        .removeClass('btn-success')
                        .addClass('btn-info')
                        .val('Update');
                    $('#modal-feature').modal('show');
                },
                error: function(errors) {
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                    $('#modal-feature').modal('hide');
                }
            });
        });


        //HANDLE DELETE DATA
        $(document).on('click', '.delete', function() {
            let meja_id = $(this).attr('id');
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
                        url: '/admin/table/' + meja_id,
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
                                    text: 'Meja  Berhasil Dihapus',
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