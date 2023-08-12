@extends('layouts.guest')
@section('title', 'Forgot Password')
@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="logo d-flex align-items-center w-auto">
                        <img src="{{ asset('images/' . $setting->website_logo_small ?? 'assets/img/logo.png') }}" alt="">
                        <span class="d-none d-lg-block">{{ $setting->website_name ?? 'Laravel' }}</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                            <p class="text-center small">Enter your email to reset password</p>
                        </div>

                        <form class="row g-3 needs-validation" method="POST" action="{{ route('forgot-password.store') }}">
                            @csrf
                            @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                <strong>Whoops!</strong> {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div>{!! htmlFormSnippet() !!}</div>
                            <div class="col-12">
                                <button class="btn btn-default w-100" type="submit">Send Email</button>
                            </div>
                            <div class="col-12">
                                <p class="small mb-0">Remember Password? <a href="{{ route('login') }}">Login</a></p>
                            </div>
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

{{-- addons js --}}
@push('js')
<script>
    $(document).ready(function() {

        $('.btn-default').click(function() {
            $(this).addClass('btn-default-click');
        })

    })
</script>

@endpush