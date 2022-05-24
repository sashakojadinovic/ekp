@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Čitaoci</h1>
            <div class="col-md-12 my-3">
                <form action="/readers" method="GET">
                    @csrf
                    <div class="row">


                        <div class="col-md-4 ">

                            <input class="form-control bg-white rounded-pill" type="text" name="search_term" id="search_term"
                                placeholder="Pretraži">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select bg-white rounded-pill" name="criteria" id="criteria">

                                <option value="name">u imenu</option>
                                <option value="card_id">u broju članske karte</option>
                                <option value="phone_number">u broju telefona</option>
                                <option value="city">u mestu stanovanja</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="form-control btn btn-default rounded-pill">Filtriraj po zadatom kriterijumu</button>
                        </div><div class="col-md-2">
                            <a href="/readers" class="form-control btn btn-default rounded-pill">Resetuj filter</a>
                        </div>

                    </div>
                </form>

            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-dark rounded-pill" href="/readers/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
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
                                <td><a class="text-decoration-none " href="/readers/{{$reader->id}}">{{ count($reader->borrowing()->get())>0?count($reader->borrowing()->get()):'nema' }}</a></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$readers->links()}}

            </div>
        </div>
    </div>
@endsection
