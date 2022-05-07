@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
                <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
{{--{{dd($photos)}}--}}

                <p class="text-center">Izmeni slike za događaj: </p>
                <h1 class="mt-3 text-center text-decoration-underline">{{$event->title}}</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/photos/{{$event->id}}" method="POST" enctype="multipart/form-data">
                   @csrf
                    <div class="my-2 row g-4">
                        @if(count($photos)==0)
                            <h1>Još uvek nema slika za ovaj događaj. Dodajte.</h1>
                        @else
                        <small>Slike koje su postavljene za ovaj događaj. Ukoliko želite da <span class="text-decoration-underline text-danger">obrišete</span> neku potrebno je da je označite.</small>
                            @foreach($photos as $p)
                            <div class="col col-sm-3 d-flex flex-row align-items-center">
            <input type="checkbox" name="delete[]" value="{{$p->id}}" class=""/>
                            <img class="img-thumbnail" src="{{asset("/images/gallery/"."mala".$p->image)}}">
                            </div>

                        @endforeach
                        @endif

                    </div>

                    <div class="my-2 ">
                        <label class="form-label" for="event-image">Dodaj još slika (mogu da se odaberu više slika odjednom)</label>
                        <input class="form-control rounded-pill" type="file" name="image[]"  id="event-image" multiple>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/events" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Obriši/dodaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
