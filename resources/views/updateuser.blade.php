@extends('layouts.app')

@section('content')

<div class="container">
    @if(isset($response) && $response['code']===200)
        @php
            $user = $response['user'];
        @endphp

        <div class="card w-100">
            <div class="card-header d-flex justify-content-center align-items-center" style="flex-direction: column;">
                <h4>
                    <strong>
                        Update User
                    </strong>
                </h4>
                <p class="card" style="width:3rem; height:2rem; display:flex; align-items:center; justify-content:center; background-color:var(--primary); color:white;">
                    <strong>
                        ID {{$user->id}} 
                    </strong>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="card-body">
                    <form method="POST" class="d-flex justifycontent-center flex-column" enctype="multipart/form-data" action="{{ url('/user/'. $user->id .'/update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                Email <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" required autofocus value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Password <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" required autofocus value="{{$user->password}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">
                                User Name
                            </label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" required autofocus value="{{$user->user_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">
                                Latitude
                            </label>
                            
                            <div class="col-md-6">
                                <input id="latitude" type="number" class="form-control" name="latitude" required  autofocus value="{{$user->latitude}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">
                                Longitude
                            </label>

                            <div class="col-md-6">
                                <input id="longitude" type="number" class="form-control" name="longitude" required  autofocus value="{{$user->longitude}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Picture
                            </label>

                            <div class="col-md-6" >
                                <div class="card" style="width:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
                                    @if (!isset($user->picture))
                                        <div class="card-header" style="width:100%;"> 
                                            Set a picture
                                        </div>
                                        <img id="imagePreview" src="/images/Logo_01.png" alt="Preview of the new image" style="display:none; height:10rem; width=100%;"/>
                                        <input type="file" class="form-control" name="picture" autofocus value="User doesn't have a picture" style="border:0;display:flex;align-items:center;width: 90%;margin: 1rem 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white">
                                    @else
                                        <div class="card-header" style="width:100%;"> 
                                            Current picture
                                        </div>
                                        <img style="height:10rem;" src="/storage/{{$user->picture}}" alt="User profile image" />
                                        <div class="card-header" style="width:100%;"> 
                                            Set a new picture
                                        </div>
                                        <img id="imagePreview" src="" style="display:none; height:10rem; width=100%;"/>
                                        <input id="picture" name="picture" onChange="readURL(this)" style="border:0;display:flex;align-items:center;width: 90%;margin: 1rem 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white" type="file" class="form-control" autofocus>                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">
                                Active User <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="active" class="form-control" name="active">
                                <!-- Set the value of the select tag with the current user value of the active field -->
                                @if ($user->active == 1)
                                    <option value="0">Non-Active</option>
                                    <option value="1" selected>Active</option>
                                @else
                                    <option value="0" selected>Non-Active</option>
                                    <option value="1">Active</option>
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin_user" class="col-md-4 col-form-label text-md-right">
                                Admin User <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="admin_user" class="form-control" name="admin_user">
                                <!-- Set the value of the select tag with the current user value of the admin_user field -->
                                @if ($user->admin_user == 1)
                                    <option value="0">Standard User</option>
                                    <option value="1" selected>Admin User</option>
                                @else
                                    <option value="0" selected>Standard User</option>
                                    <option value="1">Admin User</option>
                                @endif    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row display-flex align-items-center justify-content-center" style="text-align: center; margin-bottom: 0;">
                            <div class="col-md-6 w-100">
                                <h3 class="text-danger font-weight-bold text-align-center">
                                    All fields marked with * are required
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex" style="display: flex; align-items: center; justify-content: space-around; flex-direction:column; height: 8rem; width: 100%;">
                            <div>
                                <button type="submit" class="btn btn-primary" style="width: 12rem;">
                                    Save changes
                                </button>
                            </div>

                            <div>
                                <button class="btn btn-danger" style="width: 12rem;" href="{{ url('user/' . $user->id . '/delete')}}">
                                    Delete User
                                </button>
                            </div>
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
    @else
        <div class="d-flex justify-content-center align-items-center flex-column" >
            <h3> 
                <strong>
                    {{$response['code']}} There was an error!
                    <br>
                    {{$response['error_msg']}}  
                </strong>
            </h3>
        </div>
    @endif
</div>
@endsection