@extends('larataller::master')

@section('body')
    <h1 class="text-center">Application Data</h1>
    <form action="{{route('installer.appdata.save')}}" method="POST" class="p-3">
        @csrf
        <div class="form-group">
            <label for="APP_NAME">Application Name</label>
            <input type="text" class="form-control" id="APP_NAME" name="APP_NAME" value="{{config('app.name')}}">  
        </div>
        <div class="form-group">
            <label for="APP_URL">Application URL</label>
            <input type="text" class="form-control" id="APP_URL" name="APP_URL" value="{{config('app.url')}}">  
        </div>
        <div class="form-group">
            <label for="APP_DEBUG">Debug Mode</label>
            <select class="form-control" id="APP_DEBUG" name="APP_DEBUG">
                <option value="true" {{config('app.debug') ? 'selected' : ''}}>TRUE</option>
                <option value="false" {{!config('app.debug') ? 'selected' : ''}}>FALSE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="APP_ENV">Application Environment (optional)</label>
            <input type="text" class="form-control" id="APP_ENV" name="APP_ENV" value="{{config('app.env')}}">  
        </div>
        <div class="form-group text-center mt-5">
            <input type="submit" class="btn btn-success" value="Save & Next">  
        </div>
    </form>
@endsection