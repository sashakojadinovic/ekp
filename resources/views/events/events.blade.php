@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Vesti</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                            <div class="my-1 px-0 col-5 me-2">

                                <input class="form-control bg-white rounded-pill" type="search" id="search"
                                       placeholder="Filtriraj događaje po nazivu">
                            </div>

                    <a class="btn btn-outline-dark rounded-pill" href="/events/create"><i class="bi bi-plus-lg"> </i> Dodaj novi
                        događaj
                    </a>
{{--                    </div>--}}
                </div>

                <div class="table-responsive">
    @if(session("success"))
                    <p class="alert alert-success">{{session("success")}}</p>@endif
                <table class="table table-striped">
                    <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Datum događaja</th>
                    <th scope="col"></th>
                    <th colspan="" scope="col">Klik za prikaz svih slika za ovaj događaj</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </thead>
                    <tbody id="html">
                    @if($event)
                    <tr class="bg-secondary">  <td class="text-light">{{ $event->id }}</td>
                        <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("images/posters/".$event->coverImg)}}"></td>
                        <td class="text-light">{{ $event->title }}</a></td>
                        <td class="text-light">{{$event->desc}}</td>
                        <td class="text-light">{{$event->date}}</td>
                        <td class="text-light">{{$event->project->name}}</td>
                        <td colspan="2"> <button class="btn border-light px-2 py-0 btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$event->id}}" aria-expanded="false" aria-controls="collapseExample">
                                Sve slike za ovaj događaj
                            </button>                               </td>  <td><a class="px-2 py-0 btn border-light btn-success" href="/events/{{$event->id}}/edit">Izmeni</a></td>
                        <td><a data-id="{{$event->id}}" class=" px-2 py-0 btn border-light btn-danger delete">Obriši </a></td>
                        <td ><p class="alert alert-light text-center  fw-bold">Postavljeno na početnu</p></td>
                       </tr>
                    <tr class="">
                        <td colspan="11">
                            <div class="collapse text-end" id="collapseExample{{$event->id}}">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 row-cols-xl-6">
                                    @foreach($event->photos as $p)
                                        <div class="col">
                                            <img class="img img-thumbnail " src="{{asset("/images/gallery/"."mala".$p->image)}}"></div>
                                    @endforeach
                                </div>
                                @if(count($event->photos)==0) <small class=" my-auto">Nema slika još uvek. Dodajte. </small> @endif     <a class=" my-auto btn btn-outline-success text-end" href="/photosShow/{{$event->id}}">Izmeni slike za ovaj dogadjaj</a>
                            </div>
                        </td></tr>
                    @endif
                    @foreach ($events as $e)
                        <tr>
                            <td>{{ $e->id }}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("images/posters/".$e->coverImg)}}"></td>
                            <td>{{ $e->title }}</a></td>
                            <td>{{$e->desc}}</td>
                            <td>{{$e->date}}</td>
                            <td>{{$e->project->name}}</td>
                            <td colspan="2"> <button class="btn px-2 py-0 btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$e->id}}" aria-expanded="false" aria-controls="collapseExample">
                                 Sve slike za ovaj događaj
                                </button>                               </td>  <td><a class="px-2 py-0 btn btn-outline-success" href="/events/{{$e->id}}/edit">Izmeni</a></td>
                            <td><a data-id="{{$e->id}}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                            <td><a href="main/{{$e->id}}" class="px-2 py-0 btn btn-outline-info">Za početnu</a></td>
                        </tr>
<tr>
    <td colspan="11">
                            <div class="collapse text-end" id="collapseExample{{$e->id}}">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 row-cols-xl-6">
                                @foreach($e->photos as $p)
                                    <div class="col">
                                        <img class="img img-thumbnail " src="{{asset("/images/gallery/"."mala".$p->image)}}"></div>
                                @endforeach
                                </div>

                                @if(count($e->photos)==0) <small class="my-auto">Nema slika još uvek. Dodajte. </small> @endif     <a class=" my-auto btn btn-outline-success text-end" href="/photosShow/{{$e->id}}">Izmeni slike za ovaj dogadjaj</a>
                            </div>
    </td></tr>



                    @endforeach

                    </tbody>

                </table>
                </div></div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset("js/events.js")}}"></script>
@endsection
