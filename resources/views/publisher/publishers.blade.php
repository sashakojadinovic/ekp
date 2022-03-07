@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Izdavači</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/publishers/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
                        izdavača </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj izdanja u bazi</th>
                    </thead>
                    <tbody>
                        @foreach ($publishers as $publisher)
                            <tr>
                                <td>{{ $publisher->id }}</td>
                                <td><a class="btn px-2 py-0" href="/publishers/{{ $publisher->id }}">{{ $publisher->name }}</a></td>
                                <td>{{$publisher->books()->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
