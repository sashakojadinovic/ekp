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
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni primerak izdanja "{{ $item->book()->first()->title }}" </h1>
                <form action="/items/{{$item->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <div class="row">
                            <div class="my-2 col-md-6">
                                <label class="form-label" for="signature">Signatura:</label>
                                <input value="{{$item->signature}}" class="form-control bg-white rounded-pill" type="text" name="signature"
                                    id="signature">
                            </div>
                            <div class="my-2 col-md-6 position-relative">
                            <label class="form-label" for="donator">Donator: </label>
                            <input class="form-control bg-white rounded-pill" type="text" data-single=true data-model="Donator" name="donator"
                                id="donator">
                                <input id="donator-array" type="hidden" name="donator_array" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="my-2 col-md-6">
                                <label for="location">Lokacija:</label>
                                <select class="form-select rounded-pill bg-white" name="location" id="location">
                                    @foreach ($locations as $location )
                                        <option {{$item->location_id===$location->id?'selected':''}} value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="my-2 col-md-6 form-check form-switch pt-4">

                                <input class="form-check-input mt-2 " type="checkbox" name="available" id="available" value="1" checked><label
                                    class="ms-1 mt-2" for="available"> Dostupno</label>
                            </div>
                        </div>

                        <input type="hidden" name="items_to_save">

                        <input type="hidden" name="book_id" value="">
                        <div class="d-flex justify-content-end">
                            <button id="submitBtn" class="btn btn-danger rounded-pill">Sačuvaj primerak</button>
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

