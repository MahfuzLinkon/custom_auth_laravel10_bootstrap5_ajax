@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
           <div class="col-md-4">
               <div class="card shadow">
                   <div class="card-header py-2">
                       <h3 class="fw-bold text-secondary text-center">Login</h3>
                   </div>
                   <div class="card-body p-5">
                       <div id="login_alert"></div>
                       <form action="" method="post" id="login_form">
                           @csrf
                           <div class="mb-3">
                               <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail">
                               <div class="invalid-feedback"></div>
                           </div>
                           <div class="mb-3">
                               <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password">
                               <div class="invalid-feedback"></div>
                           </div>
                           <div class="mb-3">
                               <a href="{{ route('forgot-password') }}" class="text-decoration-none">Forgot Password ?</a>
                               <div class="invalid-feedback"></div>
                           </div>
                           <div class="mb-3 d-grid">
                               <input type="submit" value="Login" id="login_btn" class="btn btn-dark rounded-0 grid" placeholder="Password">
                               <div class="invalid-feedback"></div>
                           </div>
                           <div class="text-center text-secondary">
                               <div>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register Here</a></div>
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
            $(document).on('submit', '#login_form', function (e){
                e.preventDefault();
                $('#login_btn').val('Loading...');
                // $('#login_btn').prop('disabled', true);
                $.ajax({
                    url: "{{ route('auth.login') }}",
                    method: 'post',
                    data: $(this).serialize(),
                    // dataType: 'json',
                    success: function (response){
                        console.log(response);
                        if(response.status == 400){
                            showError('email', response.messages.email);
                            showError('password', response.messages.password);
                            $('#login_alert').html('');
                            $('#login_btn').val('Login');
                        } else if(response.status == 401){
                            $('#login_alert').html(showMessage('warning',response.message));
                            removeValidationClasses('#login_form');
                            $('#login_btn').val('Login');
                        } else if (response.status == 200){
                            window.location = '{{ route('auth.dashboard') }}'
                        }
                    } // End success
                }); // End Ajax
            })
        });
    </script>
@endsection
