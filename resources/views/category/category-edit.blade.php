@extends('layouts.app')
@section('content')
@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni kategoriju</h1>

                <form action="/categories/{{ $category->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="category-name">Naziv kategorije</label>
                        <input class="form-control bg-white rounded-pill" value="{{ $category->name }}" type="text"
                            name="name" id="category-name">
                    </div class="my-2">
                    <div>
                        <div class="my-2">
                            <label class="form-label" for="category-prefix">Prefiks u signaturi</label>
                            <input class="form-control bg-white rounded-pill" value="{{ $category->prefix }}" type="text"
                                name="prefix" id="category-prefix">
                        </div class="my-2">
                        <div>
                            <label class="form-label" for="category-info">Opis</label>
                            <textarea class="form-control bg-white" name="info" id="category-info" cols="30"
                                rows="10">{{ $category->info }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="/categories/{{ $category->id }}" class="btn btn-secondary rounded-pill  mt-2"><i
                                    class="bi bi-x-circle"> </i> Odustani</a>
                            <button type="submit" class="btn btn-danger rounded-pill mt-2 mx-1"><i
                                    class="bi bi-cloud-arrow-up"> </i> Sačuvaj</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
