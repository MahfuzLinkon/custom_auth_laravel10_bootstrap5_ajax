@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between aline-items-center">
                        <h3 class="text-secondary fw-bold">Edit Profile</h3>
                        <a href="{{ route('auth.profile') }}" class="btn btn-primary rounded-0">Profile</a>
                    </div>
                    <div class="card-body p-5">
                        <div class="row">
                            <div id="profile_alert"></div>
                            <div class="col-lg-4 px-5 text-center" style="border-right: 1px solid #a0aec0;">
                                <img src="{{ $userInfo->image == null ? asset('assets/backend/images/profile.jpg') : asset($userInfo->image) }}" id="image_preview" class="ing-fluid rounded-circle img-thumbnail" width="200" alt="">
                                <div class="mt-3">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $userInfo->id }}">
                                    <label for="image" class="form-label">Change Profile Picture</label>
                                    <input type="file" name="image" id="image" class="form-control rounded-pill">
                                </div>
                            </div>

                            <div class="col-lg-8 px-5">
                                <form action="#" id="profile_update_form" method="post">
                                    @csrf

                                    <div class="my-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $userInfo->name }}" class="form-control rounded-0">
                                    </div>
                                    <div class="my-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" value="{{ $userInfo->email }}" class="form-control rounded-0">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-control rounded-0">
                                                <option selected disabled>-Select One-</option>
                                                <option value="Male" {{ $userInfo->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $userInfo->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-lg">
                                            <label for="gender" class="form-label">Date of birth</label>
                                            <input type="date" name="dob" value="{{ $userInfo->dob }}" id="dob" class="form-control rounded-0">
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ $userInfo->phone }}" class="form-control rounded-0">
                                    </div>

                                    <div class="my-3">
                                        <input type="submit" id="profile_update_btn" value="Update" class="btn btn-success float-end rounded-0">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function (){
            // Profile image update
            $("#image").change(function (e){
                const file =  e.target.files[0];
                let url = window.URL.createObjectURL(file);
                $("#image_preview").attr('src', url);
                let fd = new FormData();
                fd.append('image', file);
                fd.append('user_id', $("#user_id").val());
                fd.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '{{ route('update-profile.image') }}',
                    method: 'post',
                    data: fd,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (response){
                        if(response.status == 200){
                            $("#profile_alert").html(showMessage('success', response.message));
                            $("#profile_alert").show();
                            $("#image").val('');
                            setTimeout(function (){
                                if(("#profile_alert").length>0){
                                    $("#profile_alert").fadeOut();
                                }
                            },1000);
                        }
                    }
                })
            })
            // Profile update
            $("#profile_update_form").submit(function (e){
                e.preventDefault();
                let user_id = $('#user_id').val();
                $("#profile_update_btn").val('Loading...')
                $.ajax({
                    url: '{{ route('profile.update') }}',
                    method: 'post',
                    data: $(this).serialize() + `&id=${user_id}`,
                    // dataType: 'json',
                    success: function(response){
                        if(response.status == 200){
                            $("#profile_update_btn").val('Update')
                            $("#profile_alert").html(showMessage('success', response.message))
                            $("#profile_alert").show();
                            setTimeout(function (){
                                if(("#profile_alert").length>0){
                                    $("#profile_alert").fadeOut();
                                }
                            },1000);
                        }
                    }
                })
            })
        });
    </script>
@endsection
