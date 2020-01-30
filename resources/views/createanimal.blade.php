@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Animal</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/animal/create') }}">
                        @csrf
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
                            <label for="id_type" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select id="id_type" class="form-control" name="id_type">
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
                            <label for="prefered_photo" class="col-md-4 col-form-label text-md-right">Prefered photo</label>
                            <div class="col-md-6">
                                <input id="prefered_photo" type="file" class="form-control" name="prefered_photo" required  autofocus>
                            </div>
                        </div>
                        
                        




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Animal
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
                    <h3>Animal created</h3>
                    <div class="card" style="width: 18rem; margin: 1rem;">

                        <h5 class="card-header">Id: <?= $response['animal']->id ?></h5>
                        <div class="card-body">
                            <h6 class="card-title">Name: <?= $response['animal']->name ?></h6>
                            <p class="card-text">Age: <?= $response['animal']->age ?></p>

                        </div>
                    </div>
                    @else
                    <h4><?= $response['error_msg'][0] ?></h4>
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