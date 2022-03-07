@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izdaj primerak knjige </h1>

                <form action="/borrowings" method="POST">
                    @csrf
                    <div class="my-2">

                        <div class="row">
                            <div class="my-2 col-md-6 position-relative">
                                @isset($id)
                                <i class="bi bi-book fs-4"></i>
                                    <p class="d-inline-block mt-2 mb-1">Naslov i signatura</p>
                                    <div class="p-2">
                                        <h4 class="mt-2"> {{ $item->book()->first()->title }}<i class="bi bi-arrow-bar-right float-end fs-1"></i></h4>
                                        <h5>Signatura: {{ $item->signature }} </h5>
                                        <input id="item-id" type="hidden" name="item_id" value="{{$item->id}}">
                                    </div>
                                @else
                                    <label class="form-label" for="item-signature">Signatura</label>
                                    <input data-model="Item" class="form-control bg-white rounded-pill" type="text"
                                        name="signature" id="signature">
                                @endisset
                                <input id="reader-id" type="hidden" name="reader_id">
                            </div>
                            <div class="my-2 col-md-6">
                                <i class="bi bi-people fs-4"></i>
                                <label class="form-label" for="reader-id">Broj članske karte</label>
                                <input class="form-control bg-white rounded-pill" type="text" name="reader_card"
                                    id="reader-card">
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/borrowings" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle">
                            </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i
                                class="bi bi-cloud-arrow-up"> </i>Sačuvaj
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if( document.getElementById('signature')){
                document.getElementById('signature').addEventListener('input', e => getData(e.target, e.target.dataset
                .model, 'signature'));
            }

        });
    </script>
@endsection
