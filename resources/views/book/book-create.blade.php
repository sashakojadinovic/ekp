@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Upiši novo izdanje</h1>

                <form action="/books" method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="book-title">Naslov</label>
                        <input class="form-control bg-white rounded-pill rounded-pill" type="text" name="title" id="book-title">
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="author-id">Autori: </label>
                            <input class="form-control bg-white rounded-pill rounded-pill" type="text" data-model="Author" name="author"
                                id="author">
                                <input id="author-array" type="hidden" name="author-array">
                        </div>
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="donator-id">Donatori: </label>
                            <input class="form-control bg-white rounded-pill rounded-pill" type="text" data-single=true data-model="Donator" name="donator"
                                id="donator">
                                <input id="donator-array" type="hidden" name="donator-array">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="category-id">Kategorije: </label>
                            <input class="form-control bg-white rounded-pill rounded-pill" type="text" data-model="Category" name="category"
                                id="category">
                                <input id="category-array" type="hidden" name="category-array">
                        </div>
                        <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="publisher-id">Izdavači: </label>
                            <input class="form-control bg-white rounded-pill rounded-pill" type="text" data-model="Publisher" name="publisher"
                                id="publisher">
                                <input id="publisher-array" type="hidden" name="publisher-array">
                        </div>
                    </div>

                    <div class="my-2">
                        <label class="form-label" for="book-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="book-info" cols="30" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="hidden" name="donators-list" id="donators-list">
                        <a href="/books" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('donator').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
            document.getElementById('author').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
            document.getElementById('category').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
            document.getElementById('publisher').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
        });

    </script>
@endsection
