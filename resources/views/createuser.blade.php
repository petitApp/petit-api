@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/user') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                @if (isset($response))
                <div class="card-header">{{ __('Response') }}</div>

                <div class="card-body">
                    @if ( $response['code'] === 200)
                    <h3>User created</h3>
                    <div class="card" style="width: 18rem; margin: 1rem;">

                        <h5 class="card-header">Id: <?= $response['user']->id ?></h5>
                        <div class="card-body">
                            <h6 class="card-title">Email: <?= $response['user']->email ?></h6>
                            <p class="card-text">User name: <?= $response['user']->user_name ?></p>

                        </div>
                    </div>
                    @else
                    <h4><?= $response['error_msg'] ?></h4>
                    @endif
                    <a href="{{ url('/') }}" class="btn btn-primary stretched-link">Go back</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection