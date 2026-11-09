@extends('templates.index')

@section('content')
<div class="container" style="margin-top:40px; margin-bottom:40px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>My Profile</h3>
        </div>

        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h4>Account Information</h4>

            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <hr>

            <h4>Personal Information</h4>

            <p><strong>Age:</strong> {{ $user->profile?->umur ?? '-' }}</p>
            <p><strong>Bio:</strong> {{ $user->profile?->bio ?? '-' }}</p>
            <p><strong>Address:</strong> {{ $user->profile?->alamat ?? '-' }}</p>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
