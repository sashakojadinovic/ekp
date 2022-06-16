@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Donatori</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-dark rounded-pill" href="/donators/create"><i class="bi bi-plus-lg"> </i> Dodaj novog
                        donatora </a>

                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Ime</th>
                        <th scope="col">Broj donacija</th>
                    </thead>
                    <tbody>
                        @foreach ($donators as $donator)
                            <tr>
                                <td><a class="btn px-2 py-0" href="/donators/{{ $donator->id }}">{{ $donator->name }}</a></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ method_exists($donators,'links')?$donators->links():'' }}
            </div>
        </div>
    </div>
@endsection
