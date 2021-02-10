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
    <header  class="card-header">
        Book list
    </header >
    <div class="card-body">
        @forelse ($books as $book)
        <article class="card card-product-list">
            <div class="row no-gutters">
                <aside class="col-md-3">
                    <a href="{{ asset("storage/".$book->cover) }}" class="img-wrap">
                        <span class="badge badge-danger"> NEW </span>
                        <img src="{{ asset("storage/".$book->cover) }}">
                    </a>
                </aside> <!-- col.// -->
                <div class="col-md-6">
                    <div class="info-main">
                        @foreach($book->authors as $author)
                        {{ $author->name }},
                        @endforeach
                        <div class="h5 title"> {{ $book->title }}</div>
                        <div class="rating-wrap mb-3">
                            <ul class="rating-stars">
                                <li style="width:80%" class="stars-active"> 
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> 
                                </li>
                                <li>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> 
                                </li>
                            </ul>
                            <div class="label-rating">7/10</div>
                        </div> <!-- rating-wrap.// -->
                        @foreach($book->genres as $genre)
                        <li>{{ $genre->genre }}</li>
                        @endforeach
                        <p>{{ $book->description }}</p>
                    </div> <!-- info-main.// -->
                </div> <!-- col.// -->
                <aside class="col-sm-3">
                    <div class="info-aside">
                        <div class="price-wrap">
                            <span class="price h5"> $62 </span>	
                        </div> <!-- info-price-detail // -->
                        <p class="text-success">Free shipping</p>
                        <br>
                        <p>
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary btn-block"> Details </a>
                            <a href="#" class="btn btn-light btn-block"><i class="fa fa-heart"></i> 
                                <span class="text">Add to wishlist</span> 
                            </a>
                        </p>
                    </div> <!-- info-aside.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </article> <!-- card-product .// -->       
    @empty       
    <p>No Book</p> 
    @endforelse
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $books->links() !!}
    </div>
    </div>
</div>

@endsection 