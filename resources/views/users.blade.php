@extends('layouts.app')

@section('content')

<div class="row justify-content-center" style="width:95%;">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4>
                    <strong>
                        Users View
                    </strong>
                </h4>
            </div>

            <div class="table-responsive">
                @if(isset($response) && $response['code']===200)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">Id </th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Active</th>
                            <th scope="col">Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response['users'] as $user)
                        <tr scope="row">
                            <td>{{$user->id}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->latitude}}</td>
                            <td>{{$user->longitude}}</td>
                            <td>{{$user->picture}}</td>
                            <td>{{$user->active}}</td>
                            <td>{{$user->admin_user}}</td>
                            <td style="display:flex; align-items:center; justify-content:center; flex-direction:row">
                                <a class="btn btn-primary" href="{{ '/user/' . $user->id . '/update' }}">
                                    Update User
                                </a>
                                <a class="btn btn-danger ml-1" href="{{ '/user/' . $user->id . '/delete' }}">
                                    Delete User
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $response['users']->links() }}
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