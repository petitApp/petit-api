@extends('layouts.app')

@section('content')
    <div class="container p2">
        <div class="d-block">
            <div class="col-12 d-flex justify-content-center">
                <h1 >Animals List</h1>
            </div>
            <a href="{{ route('defaultPaginated') }}" class="d-flex justify-content-center">
                New animal
            </a>
        </div>
        
        @if(isset($responseAnimals) && $responseAnimals['code']===200)
            @foreach ($responseAnimals['animals'] as $animal)
                <div class="row">
                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        {{ $animal->name}}
                    </div>

                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        <a href="{{ route('defaultPaginated', ['animals' => $responseAnimals['animals']]) }}">{{ $animal->id}}</a>
                    </div>

                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        {{ $animal->id_owner}}
                    </div>

                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        {{ $animal->age}}
                    </div>

                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        {{ $animal->sex}}
                    </div>

                    <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                        {{ $animal->location}}
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $responseAnimals['animals']->links() }}
            </div>
        @else
            <div class="d-flex justify-content-center text-danger">
                Fallo en la conexión
            </div>
        @endif 
    </div>
        
    

@endsection