@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Izmeni informacije o autoru</h1>

                <form action="/readers/{{$reader->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="reader-card">Broj članske karte</label>
                        <input value="{{$reader->card_id}}" class="form-control bg-white" type="text" name="card_id" id="reader-card">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-name">Ime i prezime</label>
                        <input value="{{$reader->name}}" class="form-control bg-white" type="text" name="name" id="reader-name">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-email">E-mail</label>
                        <input value="{{$reader->email}}" class="form-control bg-white" type="text" name="email" id="reader-email">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-occupation">Zanimanje</label>
                        <input value="{{$reader->occupation}}" class="form-control bg-white" type="text" name="occupation" id="reader-occupation">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-address">Ulica i broj</label>
                        <input value="{{$reader->address}}" class="form-control bg-white" type="text" name="address" id="reader-address">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-city">Mesto</label>
                        <input value="{{$reader->city}}" class="form-control bg-white" type="text" name="city" id="reader-city">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-city-code">Poštanski broj</label>
                        <input value="{{$reader->city_code}}" class="form-control bg-white" type="text" name="city_code" id="reader-city-code">
                    </div class="my-2">
                    <div class="my-2">
                        <label class="form-label" for="reader-phone">Broj telefona</label>
                        <input value="{{$reader->phone_number}}" class="form-control bg-white" type="text" name="phone_number" id="reader-phone">
                    </div class="my-2"><div>
                        <label class="form-label" for="publisher-comment">Komentar</label>
                        <textarea class="form-control bg-white" name="comment" id="publisher-comment" cols="30"
                            rows="10">{{$reader->comment}}</textarea>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/readers" class="btn btn-outline-dark rounded-pill  mt-2"><i
                                class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
