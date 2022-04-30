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
                            <p class="modal-title" id="exampleModalLabel">Upozorenje!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da izbrišete čitaoca?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-dark">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">{{ $reader->name }}</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-outline-dark rounded-pill" href="/readers"><i class="bi bi-arrow-90deg-up">
                            </i>Spisak čitalaca</a>
                    </div>
                    <div>
                        <a class="btn btn-outline-dark rounded-pill mx-1 d-inline-block"
                            href="/readers/{{ $reader->id }}/edit"><i class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/readers/{{ $reader->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-outline-dark rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši
                            </button>

                        </form>
                    </div>
                </div>
                <div id="reader" class="mt-5">
                    <p>Broj članske karte: <span>{{ $reader->card_id }}</span> </p>
                    <p>Ime i prezime: <span>{{ $reader->name }}</span> </p>
                    <p>E-mail: <span>{{ $reader->email }}</span> </p>
                    <p>Zanimanje: <span>{{ $reader->occupation }}</span> </p>
                    <p>Adresa: <span>{{ $reader->address }}, {{ $reader->city }} {{ $reader->city_code }}</span> </p>
                    <p>Broj telefona: <span>{{ $reader->phone_number }}</span> </p>
                    <p>Komentar: <span>{{ $reader->comment }}</span></p>
                </div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Signatura</th>
                        <th scope="col">Vreme izdavanja</th>
                        <th scope="col">Akcija</th>
                    </thead>
                    <tbody>

                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{ $borrowing->id }}</td>
                                <td><a class="btn px-2 py-0" href="/books/{{$borrowing->book->id}}">{{$borrowing->book->title}}</a></td>
                                <td>{{$borrowing->signature}}</td>
                                <td>{{ $borrowing->date }}</td>
                                <td><button class="btn btn-sm btn-danger rounded-pill">Vrati</button></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        const warning = document.getElementById('modalWarning');
        const form = document.getElementById('deleteForm');
        const delBtn = document.getElementById('deleteBtn');
        const confBtn = document.getElementById('confirmBtn');
        delBtn.addEventListener('click', e => e.preventDefault());
        confBtn.addEventListener('click', e => form.submit());
    </script>
@endsection
