@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Izmeni informacije o izdanju</h1>

                <form action="/books/{{$book->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="book-title">Naslov</label>
                        <input class="form-control bg-white rounded-pill" value="{{$book->title}}" type="text" name="title" id="book-title">
                    </div >
                    <div class="my-2">
                        <label class="form-label" for="donator-id">Donator ID</label>
                        <input class="form-control bg-white rounded-pill" value="{{$book->donator()->first()?$book->donator()->first()->id:''}}" type="text" name="donator" id="donator-id">
                    </div >
                    <div class="my-2">
                        <label class="form-label" for="book-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="book-info" cols="30"
                            rows="10">{{$book->info}}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                    <a href="/books/{{$book->id}}" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                    <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i> Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
