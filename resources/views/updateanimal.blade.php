@extends('layouts.app')

@section('content')

<div class="container">
    @if(isset($response) && $response['code']===200)
        @php
            $animal = $response['animal'];
        @endphp

        <div class="card w-100">
            <div class="card-header d-flex justify-content-center align-items-center" style="flex-direction: column;">
                <h4>
                    <strong>
                        Update Animal
                    </strong>
                </h4>
                <p class="card" style="width:3rem; height:2rem; display:flex; align-items:center; justify-content:center; background-color:var(--primary); color:white;">
                    <strong>
                        ID {{$animal->id}} 
                    </strong>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="card-body">
                    <form method="POST" class="d-flex justifycontent-center flex-column" enctype="multipart/form-data" action="{{ url('/animal/'. $animal->id .'/update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                Name <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{$animal->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_owner" class="col-md-4 col-form-label text-md-right">
                                Owner ID
                            </label>

                            <div class="col-md-6">
                                <input id="id_owner" type="number" class="form-control" name="id_owner" min="1" autofocus value="{{$animal->id_owner}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">
                                Type <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type" value="{{$animal->type}}">
                                    @if ($animal->type == 1)
                                    <option value="1" selected>Dog</option>
                                    <option value="2">Cat</option>
                                    <option value="3">Other</option>
                                    @elseif ($animal->type == 2)
                                    <option value="1">Dog</option>
                                    <option value="2" selected>Cat</option>
                                    <option value="3">Other</option>
                                    @else 
                                    <option value="1">Dog</option>
                                    <option value="2">Cat</option>
                                    <option value="3" selected>Other</option>
                                    @endif
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
                                <select id="sex" class="form-control" name="sex" value="{{$animal->sex}}">
                                    @if ($animal->sex == 1)
                                    <option value="1" selected>Male</option>
                                    <option value="2">Female</option>
                                    @else 
                                    <option value="1">Male</option>
                                    <option value="2" selected>Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">
                                Age <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="age" type="number" min="0" class="form-control" name="age" min="0" required  autofocus value="{{$animal->age}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">
                                Latitude <span class="text-danger font-weight-bold">*</span>
                            </label>
                            
                            <div class="col-md-6">
                                <input id="latitude" type="number" min="1" class="form-control" name="latitude" required  autofocus value="{{$animal->latitude}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">
                                Longitude <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="longitude" type="number" min="1" class="form-control" name="longitude" required  autofocus value="{{$animal->longitude}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">
                                Description <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required  autofocus value="{{$animal->description}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Main Picture <span class="text-danger font-weight-bold">*</span>
                            </label>

                            <div class="col-md-6">
                                <div class="card" style="width:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
                                @if (!isset($animal->prefered_photo))
                                    <img id="imagePreview" src="/images/Logo_01.png" alt="Preview of the new image" style="display:none; height:10rem; width=100%;"/>
                                    <input type="file" class="form-control" onChange="readURL(this)" name="prefered_photo" required autofocus value="Animal doesn't have a picture" style="border:0;display:flex;align-items:center;width: 90%;margin: 1rem 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white;">
                                @else
                                    <div class="card-header" style="width:100%;"> 
                                        Current main picture
                                    </div>
                                    <img style="height:10rem; width=100%;" src="/storage/{{$animal->prefered_photo}}" alt="Animal profile image" />
                                    <div class="card-header" style="width:100%;"> 
                                        Set a new main picture
                                    </div>
                                    <img id="imagePreview" src="/images/Logo_01.png" alt="Preview of the new image" style="display:none; height:10rem; width=100%;"/>
                                    <input id="prefered_photo" name="prefered_photo" onChange="readURL(this)" style="border:0;display:flex;align-items:center;width: 90%;margin: 1rem 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white;" type="file" class="form-control" autofocus>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Pictures
                            </label>
                            <div class="col-md-6">
                                <div class="card" style="width:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; overflow:hidden;">
                                    @if (isset($animal->picture))
                                        $count = count($animal->picture);
                                        @php
                                            die($animal->picture[1]);
                                        @endphp
                                        @for($i=1;$i<=$count;$i++) {
                                            <div class="card-header" style="width:100%;">
                                                Animal image number {{$i + 1}}  
                                            </div>
                                            <img style="height:10rem;width:100%;" src="/storage/{{$animal->picture[$i]}}" alt="image number {{$i}}"/>
                                        };
                                        @endfor        
                                    @else 
                                        <div class="card-header" style="width:100%;">
                                            Set more pictures  
                                        </div>
                                        <input name="images[]" type="file" multiple="multiple" onChange="readMultipleURL(this)" style="border:0;display:flex;align-items:center;width: 90%;margin: 1rem 0;padding: 0;flex-direction: row;height: auto;justify-content: center; background-color:var(--primary); color: white" class="form-control" autofocus>       
                                        <div id="upload_container" style="width:100%;height:auto;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Adopter ID
                            </label>

                            <div class="col-md-6">
                                <input id="id_adopter" type="number" min="1" class="form-control" name="id_adopter" autofocus value="{{$animal->id_adopter}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                Reason of unavailability
                            </label>

                            <div class="col-md-6">
                                <input id="reason_unavivale" type="text" class="form-control" name="reason_unavivale" autofocus value="{{$animal->reason_unavivale}}">
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
                                <button class="btn btn-danger" style="width: 12rem;" href="{{ url('animal/' . $animal->id. '/delete')}}">
                                    Delete Animal
                                </button>
                            </div>
                        </div>

                        <!-- Front JavaScript methods-->
                        <script type="text/javascript">
                            //JavaScript code that shows a preview of the selected main picture
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

                            //JavaScript code that shows a preview of the selected images of the multiple image input
                            function readMultipleURL(input) {
                                const totalImages = input.files.length;
                                
                                if (totalImages > 0) {
                                    var reader = new FileReader();
                                    console.log(input.files);
                                    reader.onload = function (e) {
                                        for (let i = 0; i < totalImages; i++) {
                                            const element = input.files[i];
                                            console.log('pito');
                                            console.log(element);
                                            console.log(e.target.result);
                                            $('#upload_container').innerHTML += "<img id='#image_upload' + i + 1/>";
                                            $('#image_upload' + i + 1)
                                                .attr('src', e.target.result[i]);                                     
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    };

                                } 


                                    // onChange(e) {
                                    //     let reader = new FileReader();
                                    //     reader.onload = function(e) {
                                    //         this.setState({file: reader.result})
                                    //     }
                                    //     reader.readAsDataURL(e.target.files[0]);
                                    // }
                                
                                
                                    // let image_upload = new FormData();
                                    // let TotalImages = $('#image-upload')[0].files.length;  //Total Images
                                    // let images = $('#image-upload')[0];  
                                    // for (let i = 0; i < TotalImages; i++) {
                                    //     image_upload.append('images' + i, images.files[i]);
                                    // }
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