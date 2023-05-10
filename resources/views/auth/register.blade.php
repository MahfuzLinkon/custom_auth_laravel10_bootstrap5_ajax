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
                        <div id="show_success_alert"></div>
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
                            </div>
                            <div class="text-center text-secondary">
                                <div>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login Here</a></div>
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
            $(document).on('submit', '#register_form', function (e){
                e.preventDefault();
                // alert('Hi');
                $('#register_btn').val('Loading...');
                // console.log(data);
                $.ajax({
                    data: $(this).serialize(),
                    // dataType: "JSON",
                    method: "post",
                    url: "{{ route('register') }}",
                    success: function (response){
                        console.log(response);
                        if (response.status == 400){
                            showError('name', response.messages.name);
                            showError('email', response.messages.email);
                            showError('password', response.messages.password);
                            showError('c_password', response.messages.c_password);
                            $('#register_btn').val('Register');
                        }else if (response.status == 200){
                            $('#show_success_alert').html(showMessage('success', response.message));
                            $('#register_form')[0].reset();
                            removeValidationClasses('#register_form');
                            $('#register_btn').val('Register');
                        }
                    }
                })

            });
        });
    </script>
@endsection


