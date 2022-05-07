@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach($errors as $e)
                <p class="alert alert-danger">{{ $e }}</p>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni događaj</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/events/{{$event->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="my-2">
                        <label class="form-label" for="event-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" value="{{$event->title}}" type="text" name="title" id="event-name">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="event-desc">Opis</label>
                        <input class="form-control bg-white rounded-pill" type="text" value="{{$event->desc}}" name="desc" id="event-desc">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="event-type">Odaberi radionicu za koju je vezano</label>
                        <select class="form-select bg-white rounded-pill" name="project_id" id="event-type">
                            @foreach($projects as $p)
                                @if($p->id==$event->project_id)
                                    <option selected value="{{$p->id}}">{{$p->name}}</option>
                                    @continue
                                @endif
                                <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-2 row g-3">
                        <div class="col">
                            <label class="form-label" >
                                Postavljen datum:    <p class="text-primary"> {{$event->date}}</p></label>
                        </div>
                        <div class="col">
                            <label class="form-label" for="event-date">Izmeni datum i vreme kada se održava </label>
                            <input class="form-control col-sm-3 rounded-pill" type="datetime-local" value="" name="date" id="event-date">

                        </div>


                    </div>

                    <div class="my-2 row g-3">
                        <div class="col col-sm-3">
                            <img class="img img-thumbnail " src="{{asset("/images/posters/".$event->coverImg)}}">
                        </div>
                        <div class="col m-auto">
                        <label class="form-label" for="event-image">Promeni naslovnu sliku</label>
                        <input class="form-control rounded-pill" type="file" name="coverImg" id="event-image">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/events" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Izmeni</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
