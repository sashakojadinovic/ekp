@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Upiši novog autora</h1>

                <form action="/authors" method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="author-name">Ime autora</label>
                        <input class="form-control bg-white" type="text" name="name" id="author-name">
                    </div class="my-2">
                    <div>
                        <label class="form-label" for="author-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="author-info" cols="30"
                            rows="10"></textarea>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/authors" class="btn btn-outline-dark  mt-2"><i
                                class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-outline-dark mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
