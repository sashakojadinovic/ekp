@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni izdanje {{$book->title}}</h1>

                <form action="/books/{{$book->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="book-title">Naslov</label>
                        <input value="{{$book->title}}" class="form-control bg-white rounded-pill" type="text" name="title" id="book-title">
                    </div>
                    <div class="row">

                        <div class="my-2 col-md-12 position-relative">

                            <label>
                                Dodaj sliku
                            </label>
                            <img width="100" src="{{$book->img_url}}" alt="">
                            <input type="file" class="form-control rounded-pill"  name="image">
                            <label class="form-label" for="author">Autori: </label>

                            <input placeholder="Pronađi..." class="form-control bg-white rounded-pill" type="text"
                                data-model="Author" name="author" id="author">
                            <input id="author-array" type="hidden" name="author-array">
                        </div>
                        </div>
                    <div class="row">
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="category">Kategorije: </label>
                            <input placeholder="Pronađi..." class="form-control bg-white rounded-pill" type="text"
                                data-model="Category" name="category" id="category">
                            <input id="category-array" type="hidden" name="category-array" value="1">
                        </div>
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="age">Uzrast: </label>
                            <input class="form-control bg-white rounded-pill" type="text" name="age" id="age">

                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="year">Godina izdavanja: </label>
                            <input class="form-control bg-white rounded-pill" type="text" name="year" id="year">
                        </div>
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="publisher">Izdavači: </label>
                            <input placeholder="Pronađi..." class="form-control bg-white rounded-pill" type="text"
                                data-model="Publisher" name="publisher" id="publisher">
                            <input id="publisher-array" type="hidden" name="publisher-array">
                        </div>
                    </div>

                    <div class="my-2">
                        <label class="form-label" for="book-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="book-info" cols="30" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- <input type="hidden" name="donators-list" id="donators-list"> -->
                        <a href="/books" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i
                                class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj izmene i dodaj primerke</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Load data
            @foreach ($book->authors()->get() as $author )
                //console.log("{{$author->name}}");
                createBadge("{{$author->name}}","{{$author->id}}",document.getElementById('author'));
            @endforeach
            @foreach ($book->categories()->get() as $category )
                //console.log("{{$author->name}}");
                createBadge("{{$category->name}}","{{$category->id}}",document.getElementById('category'));
            @endforeach
            @foreach ($book->publishers()->get() as $publisher )
                //console.log("{{$publisher->name}}");
                createBadge("{{$publisher->name}}","{{$publisher->id}}",document.getElementById('publisher'));
            @endforeach

            //document.getElementById('donator').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
            document.getElementById('author').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
            document.getElementById('category').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
            document.getElementById('publisher').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
        });
    </script>
@endsection
