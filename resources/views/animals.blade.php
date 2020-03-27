@extends('layouts.app')

@section('content')

<div class="row justify-content-center" style="width:95%;">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4>
                    <strong>
                        Animals View
                    </strong>
                </h4>
            </div>

            <div class="table-responsive">
                @if(isset($response) && $response['code']===200)
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
                            <th scope="col">Main photo</th>
                            <th scope="col">Pictures</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Adopter</th>
                            <th scope="col">Available</th>
                            <th scope="col" style="text-align:center">Reason Unavailable</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response['animals'] as $animal)
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
                            <td>{{$animal->id_adopter}}</td>
                            <td>{{$animal->available}}</td>
                            <td>{{$animal->reason_unavailable}}</td>
                            <!-- TODO CHECK VALUES PASSED-->
                            <td style="display:flex; align-items:center; justify-content:center; flex-direction:row">
                                <a class="btn btn-primary" href="{{ '/animal/' . $animal->id . '/update' }}">
                                    Update Animal
                                </a>
                                <a class="btn btn-danger ml-1" href="{{ '/animal/' . $animal->id . '/delete' }}">
                                    Delete Animal
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $response['animals']->links() }}
                </div>
                @else
                <div class="d-flex justify-content-center text-danger">
                    No data to show
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection