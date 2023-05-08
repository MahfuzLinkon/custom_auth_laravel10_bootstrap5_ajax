@extends('auth.layouts.app')
@section('title', 'Register')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header py-2">
                        <h3 class="fw-bold text-secondary text-center">Register</h3>
                    </div>
                    <div class="card-body p-5">
                        <form action="" method="post" id="register_form">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="c_password" id="c_password" class="form-control rounded-0" placeholder="Confirm Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Register" id="register_btn" class="btn btn-dark rounded-0 grid" placeholder="Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="text-center text-secondary">
                                <div>Already have an account? <a href="{{ route('auth.login') }}" class="text-decoration-none">Login Here</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
