@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Dodaj primerak izdanja "{{ $book->title }}" </h1>
                <div id="saved-items">
                    {{-- {{dd($book->items()->get())}} --}}
                    @foreach ($book->items()->get() as $item)
                        <p>{{ $book->name }} {{ $item->signature }}</p>
                    @endforeach
                </div>

                <form action="/items" method="POST">
                    @csrf
                    <div class="my-2">
                        <div class="row">
                            <div class="my-2 col-md-6">
                                <label class="form-label" for="signature">Signatura:</label>
                                <input class="form-control bg-white rounded-pill" type="text" name="signature"
                                    id="signature">
                            </div>
                            <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="donator">Donatori: </label>
                            <input class="form-control bg-white rounded-pill" type="text" data-single=true data-model="Donator" name="donator"
                                id="donator">
                                <input id="donator-array" type="hidden" name="donator-array" value="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="my-2 col-md-6">

                                <input class="form-check-input" type="checkbox" name="available" id="available" value="1" checked><label
                                    class="ms-1" for="available"> Dostupno</label>
                            </div>
                        </div>

                        <input type="hidden" name="items_to_save">

                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <div class="d-flex justify-content-end">
                            <button id="submitBtn" class="btn btn-outline-dark rounded-pill">Dodaj primerak</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('donator').addEventListener('input', (e) => getData(e.target, e.target.dataset.model));
        });

    </script>
@endsection
