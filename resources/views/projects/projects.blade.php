@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Radionice</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/projects/create"><i class="bi bi-plus-lg"> </i> Dodaj novu
                      kagtegoriju za vesti
                     </a>

                </div>
                <table class="table table-striped">
                    <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Naziv</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </thead>
                    <tbody id="html">
                    @foreach ($projects as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</a></td>
                            <td><a class="px-2 py-0 btn btn-outline-success" href="/projects/{{$p->id}}/edit">Izmeni</a></td>
                            <td><a data-id="{{$p->id}}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset("js/projects.js")}}"></script>
@endsection
