@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="content">
                        @guest

                        @else
                        <div class="links">
                            <a href="{{ url('/user/create') }}">Create user</a>
                            <a href="{{ url('/user/update') }}">Update user</a>

                        </div>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection