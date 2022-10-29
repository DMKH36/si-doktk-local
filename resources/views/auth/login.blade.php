@extends('frontend.layouts.app')
@section('title', 'Login')
@section('content')
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-bold">Login</h2>
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li>Login</li>
                    </ol>
                </div>
            </div>
        </section><!-- Breadcrumbs Section -->
        <!-- ======= Login Section ======= -->
        <section id="login">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col text-center">
                        <img src="{{ asset('frontend/img/logo.png') }}" alt="">
                    </div>
                </div>
                <div class="col text-center mt-5">
                    <h2 style="color: #0c2e8a">Silahkan Login</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 text-center">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('statusError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('statusError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Login form-->
                        <div class="form-login">
                            <form action="{{ route('login.action') }}" method="post">
                                @csrf
                                <!-- Form Group (email address)-->
                                <div class="form-floating">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" type="email" placeholder="name@example.com" autofocus required
                                        value="{{ old('email') }}">
                                    <label for="email">Email address</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (password)-->
                                <div class="form-floating mt-3">
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <!-- Form Group (login box)-->
                                <button type="submit" class="mt-4 col-lg-12">Login</button>
                            </form>
                            <small class="d-block mt-3">Belum terdaftar?
                                <a style="color: #0c2e8a" href="/register">Daftar Sekarang!</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('script')
    <script src="{{ asset('frontend/js/show-hide-password-floating.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();
        });
    </script>
@endsection
