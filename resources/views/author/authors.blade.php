@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Autori</h1>
            <div class="col-md-10">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/authors/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
                        autora </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Ime i prezime</th>
                        <th scope="col">Broj izdanja u bazi</th>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td><a class="btn px-2 py-0" href="/authors/{{ $author->id }}">{{ $author->name }}</a></td>
                                <td>{{$author->books()->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
