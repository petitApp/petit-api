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
    
    @foreach ($animals as $item)
        <div class="row">
            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                {{ $item->name}}
            </div>

            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                <a href="{{ route('defaultPaginated', ['animals' => $animals]) }}">{{ $item->id}}</a>
            </div>

            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                {{ $item->id_owner}}
            </div>

            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                {{ $item->age}}
            </div>

            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                {{ $item->sex}}
            </div>

            <div class="col border border-primary rounded mb-2 text-center d-flex justify-content-center">
                {{ $item->location}}
            </div>
        </div>
    @endforeach
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $animals->links()}}
    </div>

@endsection