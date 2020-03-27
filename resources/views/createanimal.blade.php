@extends('layouts.app')

@section('content')
<div class="container" style="width:90%">
    <div class="card" style="background-color: var(--primary);border: 0;">
    @if(isset($response) && $response['code'] == 200)
        @php
            $animal = $response['animal'];
        @endphp

        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4>
                    <strong>
                        New animal was successfully created
                    </strong>
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" style="margin:0;">
                    <thead>
                        <tr>
                            <th scope="col">Id </th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Breed</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Age</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prefered Photo</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <td>{{$animal->id}}</td>
                            <td>{{$animal->name}}</td>
                            <td>{{$animal->type}}</td>
                            <td>{{$animal->breed}}</td>
                            <td>{{$animal->sex}}</td>
                            <td>{{$animal->age}}</td>
                            <td>{{$animal->latitude}}</td>
                            <td>{{$animal->longitude}}</td>
                            <td>{{$animal->description}}</td>
                            <td>{{$animal->prefered_photo}}</td>
                            <td>{{$animal->picture}}</td>
                            <td>{{$animal->id_owner}}</td>
                            <td style="display:flex; align-items:center; justify-content:center; flex-direction:row">
                                <a class="btn btn-primary" href="{{ '/animal/' . $animal->id . '/update' }}">
                                    Update Animal
                                </a>
                                <a class="btn btn-danger ml-1" href="{{ '/animal/' . $animal->id . '/delete' }}">
                                    Delete Animal
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
                                Create Animal
                            </strong>
                        </h4>
                    </div>

                    <form method="POST" class="d-flex justifycontent-center flex-column" enctype="multipart/form-data" action="{{ url('/animal/create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                Name <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_owner" class="col-md-4 col-form-label text-md-right">
                                Owner ID <span class="text-danger font-weight-bold">*</span> 
                            </label>

                            <div class="col-md-6">
                                <input id="id_owner" type="number" class="form-control" name="id_owner" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">
                                Type <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type" required>
                                    <option value="1">Dog</option>
                                    <option value="2">Cat</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="breed" class="col-md-4 col-form-label text-md-right">
                                Breed
                            </label>

                            <div class="col-md-6">
                                <input id="breed" type="text" class="form-control" name="description"  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">
                                Sex <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex" required>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">
                                Age <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="age" type="number" min="1" class="form-control" name="age" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">
                                Latitude <span class="text-danger font-weight-bold">*</span>
                            </label>
                            
                            <div class="col-md-6">
                                <input id="latitude" type="number" class="form-control" name="latitude" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">
                                Longitude <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="longitude" type="number" class="form-control" name="longitude" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">
                                Description <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prefered_photo" class="col-md-4 col-form-label text-md-right">
                                Main Picture <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6" >
                                <div class="card" style="width:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
                                    <div class="card-header" style="width:100%;"> 
                                        Set a main picture
                                    </div>
                                    <img id="imagePreview" src="/images/Logo_01.png" alt="Preview of the new image" style="height:10rem; width=100%;"/>
                                    <input type="file" onChange="readURL(this)" class="form-control" name="prefered_photo" required  autofocus value="Animal doesn't have a picture" style="border:0;display:flex;align-items:center;width: 90%;margin: 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">
                                Pictures
                            </label>

                            <div class="col-md-6">
                                <input id="picture" type="file" multiple="multiple" class="form-control" name="picture[]"  autofocus>
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
                                Create Animal
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