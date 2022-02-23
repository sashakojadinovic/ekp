@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Izmeni informacije o donatoru</h1>

                <form action="/donators/{{$donator->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                       <label class="form-label" for="donator-name">Ime donatora</label>
                    <input class="form-control bg-white rounded-pill" value="{{$donator->name}}" type="text" name="name" id="donator-name">
                    </div class="my-2">
                    <div>
                        <label class="form-label" for="donator-info">Opis</label>
                    <textarea class="form-control bg-white" name="info" id="donator-info" cols="30"
                        rows="10">{{$donator->info}}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                    <a href="/donators/{{$donator->id}}" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                    <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i> Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
