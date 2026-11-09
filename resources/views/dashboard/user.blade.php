@extends('templates.index')

@section('content')
<div class="container" style="margin-top:40px; margin-bottom:40px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>User Dashboard</h3>
        </div>
        <div class="panel-body">
            <p>Welcome to ONE MOVIES.</p>
            <a href="{{ route('movies') }}" class="btn btn-warning">
                Browse Movies
            </a>
        </div>
    </div>
</div>
@endsection
