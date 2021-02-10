@extends('layouts.admin_app')

@section('content')
<div class="card">
    <header  class="card-header text-left">
        Edit genre
    </header >
    <div class="card-body">
        <form action="{{ route('genre.update', $genre->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="title">Genre name:</label>  
                <div class="col-md-8">
                <input name="genre" value="{{ $genre->genre }}" type="text" class="form-control" placeholder="Enter genre name">                   
                @if ($errors->has('genre'))
                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                @endif
                </div>
            </div>  <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Save Genre</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection