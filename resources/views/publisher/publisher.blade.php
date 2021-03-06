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
                            <h5 class="modal-title" id="exampleModalLabel">Upozorenje!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da izbrišete izdavača? Izdanja kojima je dodeljen ovaj izdavač ostaće u bazi.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-danger rounded-pill">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">{{ $publisher->name }}</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark rounded-pill" href="/publishers"><i class="bi bi-arrow-90deg-up"> </i>Svi izdavači</a>
                    </div>
                    <div>
                        <a class="btn btn-success rounded-pill mx-1 d-inline-block" href="/publishers/{{ $publisher->id }}/edit"><i
                                class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/publishers/{{ $publisher->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-danger rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši </button>

                        </form>
                    </div>

                </div>


                <div class="mt-5">
                    <h4>Opis:</h4>
                    <p>{{ $publisher->info }}</p>
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Naslov</th>
                            <th scope="col">Autor</th>
                        </thead>
                        <tbody>
                            @foreach ($publishers_books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td><a class="btn px-2 py-0" href="/books/{{ $book->id }}">{{ $book->title }}</a></td>
                                    <td>
                                        @foreach ($book->authors()->get() as $author )
                                            <a class="btn px-2 py-0" href="/authors/{{$author->id}}">{{$author->name}}</a>
                                        @endforeach
                                    </td>
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
