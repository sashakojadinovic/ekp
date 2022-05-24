@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Modal -->
            <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger  text-white">
                            <h4 class="modal-title" id="exampleModalLabel">Upozorenje!</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da izbrišete čitaoca?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-danger rounded-pill">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">{{ $reader->name }}</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark rounded-pill" href="/readers"><i class="bi bi-arrow-90deg-up">
                            </i>Spisak čitalaca</a>
                    </div>
                    <div>
                        <a class="btn btn-success rounded-pill mx-1 d-inline-block"
                            href="/readers/{{ $reader->id }}/edit"><i class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/readers/{{ $reader->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-danger rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši
                            </button>

                        </form>
                    </div>
                </div>
                <div id="reader" class="mt-5">
                    <p>Broj članske karte: <span>{{ $reader->card_id }}</span> </p>
                    <p>Ime i prezime: <span>{{ $reader->name }}</span> </p>
                    @if ($reader->gender === 0)
                        <p>Pol: <span>ženski</span> </p>
                    @elseif ($reader->gender === 1)
                        <p>Pol: <span>muški</span> </p>
                    @endif
                    @if ($reader->date_of_birth)
                    <p>Datum rođenja: <span>{{ date('d.m.Y.',strtotime($reader->date_of_birth)) }}</span> </p>
                    @endif
                    @if ($reader->parents_name)
                        <p>Ime roditelja: <span>{{ $reader->parents_name }}</span> </p>
                    @endif
                    @if ($reader->email)
                       <p>E-mail: <span>{{ $reader->email }}</span> </p>
                    @endif

                    @if ($reader->occupation)
                        <p>Zanimanje: <span>{{ $reader->occupation }}</span> </p>
                    @endif

                    @if ($reader->address || $reader->city)
                        <p>Adresa: <span>{{ $reader->address }} {{ $reader->city }} {{ $reader->city_code }}</span>
                        </p>
                    @endif
                    @if ($reader->phone_number)
                        <p>Broj telefona: <span>{{ $reader->phone_number }}</span> </p>
                    @endif

                    @if ($reader->comment)
                        <p>Komentar: <span>{{ $reader->comment }}</span></p>
                    @endif

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
                                <td><a class="btn px-2 py-0"
                                        href="/books/{{ $borrowing->book->id }}">{{ $borrowing->book->title }}</a>
                                </td>
                                <td>{{ $borrowing->signature }}</td>
                                <td>{{ $borrowing->date }}</td>
                                <td>
                                    <form class="d-inline-block" id="returnForm"
                                        action="/borrowings/{{ $borrowing->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="returnBook" data-bs-toggle="modal" data-bs-target="#returnModalWarning"
                                            class="btn btn-sm btn-danger rounded-pill"> Vrati
                                        </button>

                                    </form>
                                </td>

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
