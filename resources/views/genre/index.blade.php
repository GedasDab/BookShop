@extends('layouts.admin_app')

@section('content')
@if ($message = Session::get('success'))
    <div class="container-fluid"> 
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    </div>
@endif

<div class="card">
    <header  class="card-header text-right">
        <a href="{{ route('genre.create') }}" class="btn btn-primary ml-md-4"><i class="fa fa-plus"></i> New Genre</a>
    </header >
    <div class="card-body">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"></th>
          <th scope="col">Genre</th>
          <th scope="col">Last modified</th>
          <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @forelse ($genres as $genre)
    <tr>
        <td>{{ $genre->id }}</td>
        <td>{{ $genre->genre }}</td>
        <td>{{ $genre->created_at }}</td>
        <td class="text-right">
            <form action="{{ route('genre.destroy', $genre->id)}}" method="post">
                @csrf
                @method('DELETE')
                <a href="{{ route('genre.edit', $genre->id)}}" class="btn btn-info btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
            </form>
        </td>
    </tr>                 
@empty       
<p>No genres</p> 
@endforelse
    </tbody>
</table>
{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $genres->links() !!}
</div>
</div>
</div>
@endsection 