@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni informacije o autoru</h1>

                <form action="/authors/{{$author->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="author-name">Ime autora</label>
                        <input value="{{$author->name}}" class="form-control bg-white rounded-pill" type="text" name="name" id="author-name">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="author-gender">Pol</label>
                        <select class="form-select bg-white rounded-pill" name="gender" id="author-gender">
                            <option {{$author->gender===-1?'selected':null}} value="-1">Odaberite pol</option>
                            <option {{$author->gender==0?'selected':null}} value="0">Ženski</option>
                            <option {{$author->gender==1?'selected':null}} value="1">Muški</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" for="author-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="author-info" cols="30"
                            rows="10">{{$author->info}}</textarea>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/authors" class="btn btn-secondary rounded-pill  mt-2"><i
                                class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-danger rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
