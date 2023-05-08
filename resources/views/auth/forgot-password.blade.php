@extends('auth.layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header py-2">
                        <h3 class="fw-bold text-secondary text-center">Forgot Password</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action="" method="post" id="forgot_password_form">
                            @csrf
                            <div class="mb-3 text-secondary">
                                Enter your e-mail address, and we will send you password reset link.
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3 d-grid">
                                <input type="submit" value="Reset Password" id="forgot_password_btn" class="btn btn-dark rounded-0 grid" placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="text-center text-secondary">
                                <div>Back to <a href="{{ route('auth.login') }}" class="text-decoration-none">Login page</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
