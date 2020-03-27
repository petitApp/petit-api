@extends('layouts.app')

@section('content')
<div class="container" style="width:90%">
    <div class="card" style="background-color: var(--primary);border: 0;">
    @if(isset($response) && $response['code']===200)
        @php
            $user = $response['user'];
        @endphp

        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4>
                    <strong>
                        New user was successfully created
                    </strong>
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" style="margin:0;">
                    <thead>
                        <tr>
                            <th scope="col">Email </th>
                            <th scope="col">Password</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Active User</th>
                            <th scope="col">Admin User</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>{{$user->email}}</td>
                            <td>{{$user->password}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->latitude}}</td>
                            <td>{{$user->longitude}}</td>
                            <td>{{$user->picture}}</td>
                            <td>{{$user->active}}</td>
                            <td>{{$user->admin_user}}</td>
                            <td style="display:flex; align-items:center; justify-content:center; flex-direction:row">
                                <a class="btn btn-primary" href="{{ '/user/' . $user->id . '/update' }}">
                                    Update user
                                </a>
                                <a class="btn btn-danger ml-1" href="{{ '/user/' . $user->id . '/delete' }}">
                                    Delete user
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
    @endif
            </div>

        <div class="card">
            <div class="row justify-content-center">
                <div class="card-body" style="padding-top:0">
                    <div class="card-header d-flex justify-content-center" style="margin-bottom: 1rem;">
                        <h4>
                            <strong>
                                Create user
                            </strong>
                        </h4>
                    </div>

                    <form method="POST" class="d-flex justifycontent-center flex-column" enctype="multipart/form-data" action="{{ url('/user/create') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Email <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Password <span class="text-danger font-weight-bold">*</span> 
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                User Name
                            </label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">
                                Latitude
                            </label>
                            
                            <div class="col-md-6">
                                <input id="latitude" type="number" class="form-control" name="latitude" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">
                                Longitude
                            </label>

                            <div class="col-md-6">
                                <input id="longitude" type="number" class="form-control" name="longitude"  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Picture
                            </label>

                            <div class="col-md-6" >
                                <div class="card" style="width:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
                                    <div class="card-header" style="width:100%;"> 
                                        Set a picture
                                    </div>
                                    <img id="imagePreview" src="/images/Logo_01.png" alt="Preview of the new image" style="display:none; height:10rem;"/>
                                    <input type="file" onChange="readURL(this)" class="form-control" name="picture" autofocus value="User doesn't have a picture" style="border:0;display:flex;align-items:center;width: 90%;margin: 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">
                                Active User <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="active" class="form-control" name="active">
                                    <option value="0">Non-Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin_user" class="col-md-4 col-form-label text-md-right">
                                Admin User <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="admin_user" class="form-control" name="admin_user">
                                    <option value="0">Standard User</option>
                                    <option value="1">Admin User</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row display-flex align-items-center justify-content-center" style="text-align: center;">
                            <div class="col-md-6 w-100">
                                <h3 class="text-danger font-weight-bold text-align-center">
                                    All fields marked with * are required
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex"  style="display: flex; align-items: center; justify-content: center; height: 3rem; width: 100%;">
                            <button type="submit" class="btn btn-primary" style="width: 12rem;">
                                Create User
                            </button>
                        </div>

                        <!-- JavaScript code that shows a preview of the selected image -->
                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $('#imagePreview')
                                            .attr('src', e.target.result)
                                            .attr('style', 'display:flex; height:10rem;')
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection