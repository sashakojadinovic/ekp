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
                            <p>Da li ste sigurni da želite da izbrišete izdanje?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-dark">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">{{ $book->title }}</h1>
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-outline-dark rounded-pill" href="/books"><i class="bi bi-arrow-90deg-up"> </i>Sva
                            izdanja</a>
                    </div>
                    <div>
                        <a class="btn btn-outline-dark rounded-pill mx-1 d-inline-block"
                            href="/books/{{ $book->id }}/edit"><i class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/books/{{ $book->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-outline-dark rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši
                            </button>

                        </form>
                    </div>

                </div>


                <div class="mt-5">
                    <h6>Autor: <span>{{ $book->authors()->first() ? $book->authors()->first()->name : '' }}</span> </h6>
                    <h6>Kategorija: <span>{{ $book->categories()->first() ? $book->categories()->first()->name : '' }}</span>
                    </h6>
                    <h6>Izdavač: <span>{{ $book->publishers()->first() ? $book->publishers()->first()->name : '' }}</span>
                    </h6>
                    <h6>Godina izdanja: <span>{{ $book->year ? $book->year . '.' : '' }}</span></h6>
                    <h6>Uzrast: <span>{{ $book->age ? $book->age : '' }}</span></h6>


                    <h6>Opis:</h6>
                    <p>{{ $book->info }}</p>

                </div>
                <div class="mt-5">
                    <h6>Primerci ovog izdanja:</h6>
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Signatura</th>
                            <th scope="col">Status</th>
                            <th scope="col">Akcija</th>
                        </thead>
                        <tbody>
                            @foreach ($book->items()->get() as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->signature }}</td>
                                    <td>
                                        @if ($item->borrowing()->exists())
                                            <span>Izdato</span>
                                        @else
                                            <span>Raspoloživo</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($item->borrowing()->exists())
                                        <a class="btn btn-info rounded-pill btn-sm " href="#">Vrati</a></td>
                                        @else
                                        <a class="btn btn-warning rounded-pill btn-sm " href="#">Izdaj</a></td>
                                        @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
