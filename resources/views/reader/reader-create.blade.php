@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Upiši novog člana</h1>

                <form action="/readers" method="POST">
                    @csrf
                    <div class="row">
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-card">Broj članske karte</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="card_id" id="reader-card">
                        </div>
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-name">Ime i prezime</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="name" id="reader-name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-email">E-mail</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="email" id="reader-email">
                        </div>
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-occupation">Zanimanje</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="occupation" id="reader-occupation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-address">Ulica i broj</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="address" id="reader-address">
                        </div>
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-city">Mesto</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="city" id="reader-city">
                        </div>
                    </div>
                    <div class="row">
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-city-code">Poštanski broj</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="city_code" id="reader-city-code">
                        </div>
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="reader-phone">Broj telefona</label>
                            <input class="form-control bg-white rounded-pill" type="text" name="phone_number" id="reader-phone">
                        </div>
                        <div class="my-2">
                            <label class="form-label" for="publisher-comment">Komentar</label>
                            <textarea class="form-control bg-white" name="comment" id="publisher-comment" cols="30"
                                rows="5"></textarea>
                        </div>


                    </div>



                    <div class="d-flex justify-content-end">
                        <a href="/readers" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>Odustani </a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
