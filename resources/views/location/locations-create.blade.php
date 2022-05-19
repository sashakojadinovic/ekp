@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Definiši novu lokaciju</h1>

                <form action="/locations" method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="location-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="name" id="location-name">
                    </div class="my-2">
                    <div>
                        <label class="form-label" for="location-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="location-info" cols="30"
                            rows="10"></textarea>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/locations" class="btn btn-secondary rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-danger rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
