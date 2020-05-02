@php 
use DGvai\Larataller\Helpers\Environment;
@endphp

@extends('larataller::master')

@section('body')
    <h1 class="text-center">Finalize Setup</h1>
    <form action="{{route('installer.extra.save')}}" method="POST" class="p-3">
        @csrf
        @foreach($extras as $extra)
        <div class="form-group">
            <label for="{{$extra['key']}}">{{$extra['title']}}</label>
            <input type="text" class="form-control" id="{{$extra['key']}}" name="{{$extra['key']}}" value="{{Environment::pull($extra['key'])}}">  
        </div>
        @endforeach
        <div class="form-group text-center mt-5">
            <input type="submit" class="btn btn-success" value="Save & Run">
        </div>
    </form>
@endsection