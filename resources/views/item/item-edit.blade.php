@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni informacije o izdanju</h1>

                <form action="/items/{{$item->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="item-title">Naslov</label>
                        <input class="form-control bg-white rounded-pill" value="{{$item->title}}" type="text" name="title" id="item-title">
                    </div >
                    <div class="my-2">
                        <label class="form-label" for="donator-id">Donator ID</label>
                        <input class="form-control bg-white rounded-pill" value="{{$item->donator()->first()?$item->donator()->first()->id:''}}" type="text" name="donator" id="donator-id">
                    </div >

                    <div class="d-flex justify-content-end">
                    <a href="/items/{{$item->id}}" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                    <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i> Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
