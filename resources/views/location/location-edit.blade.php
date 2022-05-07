@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni informacije o lokaciji</h1>

                <form action="/locations/{{$location->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                       <label class="form-label" for="location-name">Naziv</label>
                    <input class="form-control bg-white rounded-pill" value="{{$location->name}}" type="text" name="name" id="location-name">
                    </div class="my-2">
                    <div>
                        <label class="form-label" for="location-info">Opis</label>
                    <textarea class="form-control bg-white" name="info" id="location-info" cols="30"
                        rows="10">{{$location->info}}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                    <a href="/locations/{{$location->id}}" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                    <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i> Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
