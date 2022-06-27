@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Autori</h1>
            <div class="col-md-12">
                <form action="/authors" method="GET">
                    @csrf
                    <div class="row">


                        <div class="col-md-4 ">

                            <input class="form-control bg-white rounded-pill" type="text" name="search_term" id="search_term"
                                placeholder="Pretraži po imenu ili prezimenu autora">
                        </div>

                        <div class="col-md-4">
                            <button class="form-control btn btn-default rounded-pill">Filtriraj po zadatom kriterijumu</button>
                        </div><div class="col-md-2">
                            <a href="/authors" class="form-control btn btn-default rounded-pill">Resetuj filter</a>
                        </div>

                    </div>
                </form>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-dark rounded-pill" href="/authors/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
                        autora </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Ime i prezime</th>
                        <th scope="col">Broj izdanja u bazi</th>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td><a class="btn px-2 py-0" href="/authors/{{ $author->id }}">{{ $author->name }}</a></td>
                                <td>{{$author->books()->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ method_exists($authors,'links')?$authors->links():'' }}
            </div>
        </div>
    </div>
@endsection
