@extends('layouts.app')
@section('content')
    <div class="container">

        @if ($errors->any())
            <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni donatora/partnera</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/donors/{{$donor->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="my-2">
                        <label class="form-label" for="donor-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="name" value="{{$donor->name}}" id="donor-name">

                    </div>
                    <div class="my-2">
                        <a target="_blank" href="{{$donor->link}}">Klik ka njihovom sajtu</a>
                        <label class="form-label" for="donor-link">Izmeni link</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="link" value="{{$donor->link}}" id="donor-link">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="donor-type">Odaberi</label>
                        <select class="form-select bg-white rounded-pill" name="donor_partner" id="donor-type">
                            @if($donor->donor_partner==0)
                                <option selected value="0">Partner</option>
                                <option value="1">Donator</option>

                            @else
                                <option value="0">Partner</option>
                                <option selected value="1">Donator</option>

                            @endif
                        </select>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="donor-image">Izmeni sliku</label>
                        <br/>
{{--                        <div class="my-2 d-flex flex-row justify-content-around">--}}

                        <img class="img img-thumbnail " src="{{asset("/images/donors/".$donor->image)}}">
                        <input class="form-control" type="file" name="image" id="donor-image">
{{--                        </div>--}}
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/donors" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Izmeni</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
