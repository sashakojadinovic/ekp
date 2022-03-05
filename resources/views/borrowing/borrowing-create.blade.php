@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Izdaj primerak knjige sa ID: {{$id}} </h1>

                <form action="/authors" method="POST">
                    @csrf
                    <div class="my-2">

                        <div class="row">
                            <div class="my-2 col-md-6 position-relative">
                                <label class="form-label" for="item-signature">Signatura</label>
                                <input data-model="Item" class="form-control bg-white rounded-pill" type="text" name="signature" id="signature">
                                <input id="signature-array" type="hidden" name="publisher-array">
                            </div>
                            <div class="my-2 col-md-6">
                                <label class="form-label" for="reader-id">Broj članske karte</label>
                                <input class="form-control bg-white rounded-pill" type="text" name="reader_id" id="reader-id">
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/borrowings" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i
                                class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('signature').addEventListener('input',e=>getData(e.target, e.target.dataset.model,'signature'));
        });
    </script>
@endsection
