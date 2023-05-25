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
                        <div id="forgot_alert"></div>
                        <form action="#" method="post" id="forgot_password_form">
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
                                <div>Back to <a href="{{ route('login') }}" class="text-decoration-none">Login page</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function (){
            $("#forgot_password_form").submit(function (e){
                e.preventDefault();
                $('#forgot_password_btn').val('Loading...');
                $.ajax({
                    url: '{{ route('auth.forgot-password') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response){
                        // console.log(response);
                        if(response.status == 400){
                            showError('email', response.messages.email)
                            $('#forgot_password_btn').val('Reset Password');
                        }else if(response.status == 200){
                            $("#forgot_alert").html(showMessage('success', response.message));
                            $('#forgot_password_btn').val('Reset Password');
                            removeValidationClasses("#forgot_password_form");
                            $("#forgot_password_form")[0].reset();
                        }else {
                            $("#forgot_alert").html(showMessage('warning', response.message));
                            $('#forgot_password_btn').val('Reset Password');
                            removeValidationClasses("#forgot_password_form");
                        }
                    }
                })
            });
        });
    </script>
@endsection
