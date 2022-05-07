@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Lokacije</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/locations/create"><i class="bi bi-plus-lg"> </i> Dodaj novu
                        lokaciju </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Naziv</th>
                        <th scope="col">Broj izdanja na lokaciji</th>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>location
                                <td><a class="btn px-2 py-0" href="/locations/{{ $location->id }}">{{ $location->name }}</a></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
