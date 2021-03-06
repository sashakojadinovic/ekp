@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Izdanja</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/books/create"><i class="bi bi-plus-lg"> </i> Dodaj novo
                        izdanje </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Naslov</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Izdavač</th>
                        <th scope="col">Broj primeraka</th>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td><a class="btn px-2 py-0" href="/books/{{ $book->id }}">{{ $book->title }}</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
