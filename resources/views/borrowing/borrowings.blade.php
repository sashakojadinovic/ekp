@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Modal -->
            <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h6 class="modal-title" id="exampleModalLabel">Upozorenje!</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da razdužite primerak sa signaturom ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-dark">Razduži</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">Lista iznajmljivanja knjiga</h1>
            <div class="col-md-10">
                <div class="d-flex justify-content-end">


                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Naslov</th>
                        <th scope="col">Signatura</th>
                        <th scope="col">Čitalac</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{ $borrowing->id }}</td>
                                <td><a class="btn px-2 py-0" href="/books/{{ $borrowing->item()->first()->book()->first()->id }}">{{ $borrowing->item()->first()->book()->first()->title }}</a></td>
                                <td>{{ $borrowing->item()->first()->signature }}</td>
                                <td><a class="btn px-2 py-0" href="/readers/{{ $borrowing->reader()->first()->id }}">{{ $borrowing->reader()->first()->name }}</a></td>
                                <td><a class="btn btn-danger rounded-pill btn-sm " href="#">Razduži</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
