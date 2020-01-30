@extends('layouts.app')

@section('content')

<div class="container">
    @if (isset($responseAnimals['msg']))
    <div class="alert alert-info">
        <?= $responseUsers['msg'] ?>
    </div>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-md-12">
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
                            <th scope="col">Location</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prefered_photo</th>
                            <th scope="col">Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($responseAnimals['animals'] as $animal)
                        <tr scope="row">
                            <td>{{$animal->id}}</td>
                            <td>{{$animal->name}}</td>
                            <td>{{$animal->id_type}}</td>
                            <td>{{$animal->breed}}</td>
                            <td>{{$animal->sex}}</td>
                            <td>{{$animal->age}}</td>
                            <td>{{$animal->location}}</td>
                            <td>{{$animal->description}}</td>
                            <td>{{$animal->prefered_photo}}</td>
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
                    Fallo en la conexión
                </div>
                @endif
            </div>

        </div>
        <div class="card-body">
            <!-- <form method="POST" action="{{ url('animal/update') }}">
                @csrf
                <div class="form-group row">
                    <label for="id" class="col-md-4 col-form-label text-md-right">Animal ID</label>
                    <div class="col-md-6">
                        <input id="id" type="number" class="form-control" name="id" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Animal Name') }}</label>
                    <div class="col-md-6">
                        <input id="user_name" type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Owner ID') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control " name="owner_id">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Animal Age') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control " name="age">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                    <div class="col-md-6">
                        <input id="location" type="text" class="form-control" name="location">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="picture" class="col-md-4 col-form-label text-md-right">Sex</label>
                    <div class="col-md-6">
                        <input id="picture" type="text" class="form-control" name="sex">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="picture" class="col-md-4 col-form-label text-md-right">Picture</label>
                    <div class="col-md-6">
                        <input id="picture" type="text" class="form-control" name="picture">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form> -->
        </div>

    </div>

</div>
</div>
</div>
</div>
@endsection