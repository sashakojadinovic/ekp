@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Čitaoci</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/readers/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
                        člana </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Broj članske karte</th>
                        <th scope="col">Ime i prezime</th>
                        <th scope="col">Zaduženja</th>
                    </thead>
                    <tbody>
                        @foreach ($readers as $reader)
                            <tr>
                                <td>{{ $reader->card_id }}</td>
                                <td><a class="btn px-2 py-0" href="/readers/{{ $reader->id }}">{{ $reader->name }}</a></td>
                                <td>{{ count($reader->borrowing()->get())>0?count($reader->borrowing()->get()):'nema' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
               {{ $readers->links()}}
            </div>
        </div>
    </div>
@endsection
