@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between aline-items-center">
                        <h3 class="text-secondary fw-bold">User Profile</h3>
                        <a href="{{ route('auth.profile-edit') }}" class="btn btn-primary rounded-0">Edit Profile</a>
                    </div>
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-4 px-5 text-center" style="border-right: 1px solid #a0aec0;">
                                <img src="{{ $userInfo->image == null ? asset('assets/backend/images/profile.jpg') : asset($userInfo->image) }}" id="image_preview" class="ing-fluid rounded-circle img-thumbnail" width="200" alt="">
                            </div>
                            <div class="col-lg-8 px-5">
                                <div class="my-2">
                                    <label for="" class="fw-bold form-label">Name</label>
                                    <p>{{ $userInfo->name }}</p>
                                </div>
                                <div class="my-2">
                                    <label for="" class="fw-bold form-label">Email</label>
                                    <p>{{ $userInfo->email }}</p>
                                </div>
                                <div class="my-2">
                                    <div class="row">
                                        <div class="col-lg">
                                            <label for="" class="fw-bold form-label">Gender</label>
                                            <p>{{ $userInfo->gender }}</p>
                                        </div>
                                        <div class="col-lg">
                                            <label for="" class="fw-bold form-label">Date of birth</label>
                                            <p>{{ $userInfo->dob }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <label for="" class="fw-bold form-label">Phone</label>
                                    <p>{{ $userInfo->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
