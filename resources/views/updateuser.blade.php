@extends('layouts.app')

@section('content')

<div class="container">
    @if (isset($responseUsers['msg']))
    <div class="alert alert-info">
        <?= $responseUsers['msg'] ?>
    </div>
</div>
@endif
<div class="row justify-content-center">
    <div class="col">
        <div class="card">
            <div class="card-header">{{ __('Update User') }}</div>
            <div class="table-responsive">
                @if(isset($responseUsers)&& $responseUsers['code']===200)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">Id </th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Active</th>
                            <th scope="col">Admin user</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($responseUsers['users'] as $user)
                        <tr scope="row">
                            <td>{{$user->id}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->picture}}</td>
                            <td>{{$user->active}}</td>
                            <td>{{$user->admin_user}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
                @endif
            </div>

        </div>

        
        <div class="d-flex justify-content-center">
                    {{ $responseUsers['users']->links()}}
                </div>
                

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ url('user/update') }}">
                @csrf
                <div class="form-group row">
                    <label for="id" class="col-md-4 col-form-label text-md-right">User Id</label>
                    <div class="col-md-6">
                        <input id="id" type="number" class="form-control" name="id" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                    <div class="col-md-6">
                        <input id="user_name" type="text" class="form-control" name="user_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control " name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control " name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="active" class="col-md-4 col-form-label text-md-right">Active</label>
                    <div class="col-md-6">
                        <select id="active" class="form-control" name="active">
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="admin_user" class="col-md-4 col-form-label text-md-right">Admin user</label>
                    <div class="col-md-6">
                        <select id="admin_user" class="form-control" name="admin_user">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="picture" class="col-md-4 col-form-label text-md-right">Picture</label>
                    <div class="col-md-6">
                        <input id="picture" type="file" class="form-control" name="picture">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
</div>
</div>
</div>
@endsection