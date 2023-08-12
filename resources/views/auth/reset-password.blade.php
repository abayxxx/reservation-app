@extends('layouts.guest')
@section('title', 'Reset Password')
@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="#" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('images/' . $setting->website_logo_small ?? 'assets/img/logo.png') }}"
                                alt="">
                            <span class="d-none d-lg-block">{{ $setting->website_name ?? 'Laravel' }}</span>
                        </a>
                    </div><!-- End Logo -->
                </div>
                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Reset Your Password</h5>
                        </div>

                        <form class="row g-3 needs-validation" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <strong>Whoops!</strong> {{ $error }}
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <input type="hidden" name="token" value="{{ request()->route('token') }}">

                            <div class="col-12">
                                <label for="yourEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="yourEmail" required>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" id="yourPassword"
                                    required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
