<nav class="navbar navbar-expand bg-light ">
    <div class="container">
        <a href="" class="navbar-brand fw-bold">ScOrpiOn</a>
        <ul class="navbar-nav">
            <li><a href="{{ url('/dashboard') }}" class="nav-link">Home</a></li>
            <li class="dropdown">
                <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset($userInfo->image == null ? asset('assets/backend/images/profile.jpg') : asset($userInfo->image)) }}" width="30" height="30" class="rounded-circle" alt="">
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('auth.profile') }}" class="dropdown-item">Profile</a></li>
                    <li><a href="" class="dropdown-item">Change Password</a></li>
                    <li><a href="{{ route('auth.logout') }}" class="dropdown-item">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
