@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Kategorije</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-dark rounded-pill" href="/categories/create"><i class="bi bi-plus-lg"> </i> Dodaj novu
                        kategoriju </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Naziv</th>
                        <th scope="col">Prefiks</th>
                        <th scope="col">Broj izdanja u bazi</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td><a class="btn px-2 py-0" href="/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                                <td>{{ $category->prefix }}</td>
                                <td>{{$category->books()->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
