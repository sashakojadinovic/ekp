@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Naslovi</h1>
            <div class="col-md-12">

                <form action="" method="GET">
                    @csrf
                    <div class="row">
                        <div class="my-2 col-md-10">

                            <input class="form-control bg-white rounded-pill" type="text" name="title" id="title"
                                placeholder="Filtriraj po naslovu">
                        </div>

                        <div class="my-2 col-md-2">
                            <button class="btn btn-outline-dark rounded-pill" type="submit">Pretraži</button>
                        </div>
                    </div>
                </form>

            </div>


            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-dark rounded-pill" href="/books/create"><i class="bi bi-plus-lg"> </i> Dodaj
                    novo
                    izdanje </a>

            </div>
            <table class="table table-striped">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Naslov</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Izdavač</th>
                    <th scope="col">Broj primeraka</th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td><a class="btn px-2 py-0" href="/books/{{ $book->id }}">{{ $book->title }}</a>
                            </td>
                            <td>
                                @foreach ($book->authors()->get() as $author)
                                    <a class="btn px-2 py-0" href="/authors/{{ $author->id }}">{{ $author->name }}
                                    </a>
                                @endforeach
                            <td>
                                @foreach ($book->publishers()->get() as $publisher)
                                    <a class="btn px-2 py-0"
                                        href="/publishers/{{ $publisher->id }}">{{ $publisher->name }} </a>
                                @endforeach
                            </td>
                            <td>{{ $book->items()->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{-- {{ $books->links() }} --}}
    </div>
    </div>
@endsection
