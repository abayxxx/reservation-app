@extends('layouts.admin')
@section('title', 'User Setting')
@section('title-1', 'Ubah Password')
@section('title-2', 'Ubah Password')
@section('link')
{{ route('change-password') }}
@endsection


@section('content')
<div class="card">
    <!--  -->
    <div class="card-body p-3">
        <div class="row">
            <div class="col-xl-12">
                <div class="" id="">
                    <!-- Change Password Form -->
                    <form id="form-password">
                        @csrf
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="text" id="username" class="form-control" value="{{$user->username}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" class="form-control" id="newPassword">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukkan Kembali Password Baru</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-password btn-info text-white">Change Password</button>
                        </div>
                    </form><!-- End Change Password Form -->

                </div>
            </div>
        </div>

    </div>

</div>
@endsection

{{-- addons css --}}
@push('css')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
</link>
@endpush


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<script>
    //
    $(document).ready(function() {

        //Delete data function
        $('.btn-password').click(function(e) {
            e.preventDefault()
            console.log('oke');
            let data = {
                username: $('#username').val(),
                currentPassword: $('#currentPassword').val(),
                newPassword: $('#newPassword').val(),
                renewPassword: $('#renewPassword').val()
            }
            $.ajax({
                method: "POST",
                url: "{{route('change-password.store')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    username: $('#username').val(),
                    currentPassword: $('#currentPassword').val(),
                    newPassword: $('#newPassword').val(),
                    renewPassword: $('#renewPassword').val()
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
                            text: 'Password updated successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }, 500);
                },
                error: function(errors) {
                    console.log(errors)
                    Swal.fire('Error!', errors.responseJSON.message ?? errors.responseJSON.error, 'error');
                    Swal.hideLoading();
                }
            });
        });
    })
</script>
@endpush