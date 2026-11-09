@extends('templates.index')

@section('content')
<div class="container" style="margin-top:40px; margin-bottom:40px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Edit My Profile</h3>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input
                        type="number"
                        name="umur"
                        class="form-control"
                        value="{{ old('umur', $user->profile?->umur) }}"
                        min="1"
                        max="120"
                    >
                </div>

                <div class="form-group">
                    <label>Bio</label>
                    <textarea
                        name="bio"
                        class="form-control"
                        rows="4"
                    >{{ old('bio', $user->profile?->bio) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3"
                    >{{ old('alamat', $user->profile?->alamat) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>

                <a href="{{ route('profile') }}" class="btn btn-default">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</div>
@endsection
