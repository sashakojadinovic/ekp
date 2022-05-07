@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Donatori i partneri</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/donors/create"><i class="bi bi-plus-lg"> </i> Dodaj novog donatora/partnera
                    </a>

                </div>
                <table class="table table-striped">
                    <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Slika</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Link</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </thead>
                    <tbody id="html">
                    @foreach ($donors as $d)
                        <tr class="">
                            <td>{{ $d->id }}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("/images/donors/".$d->image)}}"></td>
                            <td>{{ $d->name }}</a></td>
                            <td><a target="_blank" href="{{$d->link}}">Klik ka njihovom sajtu</a></td>
                            <td>@if($d->donor_partner==0)
                            Partner
                                @else
                                Donator
                                    @endif
                            </td>
                            <td><a class="px-2 py-0 btn btn-outline-success" href="/donors/{{$d->id}}/edit">Izmeni</a></td>
                            <td><a data-id="{{$d->id}}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset("js/donors.js")}}"></script>
@endsection
