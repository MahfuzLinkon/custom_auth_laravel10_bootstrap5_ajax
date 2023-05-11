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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
