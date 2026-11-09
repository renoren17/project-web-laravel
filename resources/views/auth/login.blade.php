@extends('templates.index')

@section('content')
<div class="container" style="margin-top:50px; margin-bottom:50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Login to ONE MOVIES</h3>
                </div>

                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"
                                class="form-control"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            Login
                        </button>
                    </form>

                    <hr>
                    <p>Don't have an account?
                        <a href="{{ route('register') }}">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection