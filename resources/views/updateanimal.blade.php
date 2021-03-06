@extends('layouts.app')

@section('content')

<div class="container">
    @if (isset($responseAnimals['msg']))
    <div class="alert alert-info">
        <?= $responseAnimals['msg'] ?>
    </div>
</div>
@endif
<div class="row justify-content-center">
    <div class="col">
        <div class="card">
            <div class="card-header">{{ __('Update Animal') }}</div>
            <div class="table-responsive">
                @if(isset($responseAnimals)&& $responseAnimals['code']===200)
                <table class="table table-striped ">
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
                            <th scope="col">Picture</th>
                            <th scope="col">Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($responseAnimals['animals'] as $animal)
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
                            <td>{{$animal->picture}}</td>
                            <td>{{$animal->id_owner}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $responseAnimals['animals']->links() }}
                </div>
                @else
                <div class="d-flex justify-content-center text-danger">
                    No data to show
                </div>
                @endif
            </div>

        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ url('animal/update') }}">
                @csrf
                <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">Id</label>
                            <div class="col-md-6">
                                <input id="id" type="number" class="form-control" name="id" required autofocus>
                            </div>
                        </div>
                <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_owner" class="col-md-4 col-form-label text-md-right">Owner id</label>
                            <div class="col-md-6">
                                <input id="id_owner" type="number" class="form-control" name="id_owner" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type">
                                    <option value="1">Dog</option>
                                    <option value="2">Cat</option>
                                    <option value="3">Other</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">Sex</label>
                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" name="age" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">Prefered photo</label>
                            <div class="col-md-6">
                                <input id="picture" type="file" class="form-control" name="picture" required  autofocus>
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