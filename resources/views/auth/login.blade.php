@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4" style="background-image:url('/../landing_page/images/image.png')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="logo d-flex align-items-center w-auto">
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Administrator</h5>
                            <p class="text-center small">Enter your username & password to login</p>
                        </div>
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form class="row g-3 needs-validation" method="POST" action="{{ route('login.store') }}">
                            @csrf
                            @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                <strong>Whoops!</strong> {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="username" class="form-control" id="username" required>
                                    <div class="invalid-feedback">Please enter your username.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>

                            <div class="col-12 h-10">
                                <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                            <!-- <div class="col-12">
                                <p class="small mb-0 text-center"><a href="{{ route('register') }}" style="color: #1a1e21;">Create an
                                        account</a> | <a href="{{ route('forgot-password') }}" style="color: #1a1e21;">Forgot Password</a></p>
                            </div> -->
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

{{-- addons css --}}
@push('css')
<style>
    .btn-default-click {
        /* color: #fd4900 !important; */
        background-color: #fd4900 !important;
        color: white !important;
    }
</style>

@endpush

@push('js')
<script>
    $(document).ready(function() {

        //clear local storage
        localStorage.clear();

        $('.btn-default').click(function() {
            $(this).addClass('btn-default-click');
        })

    })
</script>

@endpush