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
                            <p>Da li ste sigurni da želite da izbrišete autora?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-danger rounded-pill">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">{{ $author->name }}</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark rounded-pill" href="/authors"><i class="bi bi-arrow-90deg-up"> </i>Spisak autora</a>
                    </div>
                    <div>
                        <a class="btn btn-success rounded-pill mx-1 d-inline-block" href="/authors/{{ $author->id }}/edit"><i
                                class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/authors/{{ $author->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-danger rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši </button>

                        </form>
                    </div>

                </div>
                <div class="mt-5">
                    @if ($author->gender===0)
                        <p>Pol: <span>ženski</span> </p>
                    @elseif (($author->gender===1))
                    <p>Pol: <span>muški</span> </p>
                    @endif
                    <h4>Opis:</h4>
                    <p>{{ $author->info }}</p>
                    <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Naslov</th>
                        <th scope="col">Izdavač</th>
                    </thead>
                    <tbody>
                        @foreach ($authors_books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td><a class="btn px-2 py-0" href="/books/{{ $book->id }}">{{ $book->title }}</a></td>
                                <td>
                                    @foreach ($book->publishers()->get() as $publisher )
                                            <a class="btn px-2 py-0" href="/publishers/{{$publisher->id}}">{{$publisher->name}}</a>
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
