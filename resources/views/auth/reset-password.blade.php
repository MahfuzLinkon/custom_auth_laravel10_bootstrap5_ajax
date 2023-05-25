@extends('auth.layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header py-2">
                        <h3 class="fw-bold text-secondary text-center">Reset Password</h3>
                    </div>
                    <div class="card-body p-5">
                        <div id="change_pass_alert"></div>
                        <form action="" method="post" id="reset_password_form">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="user_token" value="{{ $token }}">
                                <input type="email" name="email" id="email" readonly class="form-control rounded-0" placeholder="E-Mail" value="{{ $email }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="new_password" id="new_password" class="form-control rounded-0" placeholder="New Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="c_new_password" id="c_new_password" class="form-control rounded-0" placeholder="Confirm New Password">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Update Password" id="reset_password_btn" class="btn btn-dark rounded-0 grid" placeholder="Password">
                                <div class="invalid-feedback"></div>
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
            $("#reset_password_form").submit(function (e){
               e.preventDefault();
               $("#reset_password_btn").val('Loading...')
               $.ajax({
                   url: '{{ route('update.password') }}',
                   method: 'post',
                   data: $(this).serialize(),
                   dataType: 'json',
                   success: function (response){
                       // console.log(response)
                       if(response.status == 400){
                           showError('new_password', response.messages.new_password);
                           showError('c_new_password', response.messages.c_new_password);
                           $("#reset_password_btn").val('Update password');
                       }else if (response.status == 200){
                           $("#change_pass_alert").html(showMessage('success', response.message));
                           $("#reset_password_btn").val('Update password');
                           $("#reset_password_form")[0].reset();
                       }else{
                           removeValidationClasses("#reset_password_form");
                           $("#change_pass_alert").html(showMessage('warning', response.message));
                           $("#reset_password_btn").val('Update password');

                       }
                   }
               })
            });
        })
    </script>
@endsection
