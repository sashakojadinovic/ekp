@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Dodaj novi događaj</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/events" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="event-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="title" id="event-name">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="event-desc">Opis</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="desc" id="event-desc">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="event-type">Odaberi oblast za koju je vezano</label>
                        <select class="form-select bg-white rounded-pill" name="project_id" id="event-type">
                          @foreach($projects as $p)
                              <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-2 row g-3">
                        <div class="col">
                            <label class="form-label" for="event-date">Datum i vreme kada se održava</label>
                            <input class="form-control col-sm-3 rounded-pill" type="datetime-local" name="date" id="event-date">
                        </div>
                        <div class="col">
                            <label class="form-label" for="event-image">Izaberi naslovnu sliku</label>
                            <input class="form-control rounded-pill" type="file" name="coverImg" id="event-image">
                        </div>


                    </div>



                    <div class="d-flex justify-content-end">
                        <a href="/events" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
