@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Naslovi</h1>
            <div class="col-md-12 my-3">
                <form action="/books" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 ">
                            <input class="form-control bg-white rounded-pill" type="text" name="search_term" id="search_term"
                                placeholder="Pretraži">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select bg-white rounded-pill" name="criteria" id="criteria">

                                <option value="title">u naslovu</option>
                                <option value="author">u imenu autora</option>
                                <option value="publisher">u nazivu izdavača</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="form-control btn btn-default rounded-pill">Filtriraj po zadatom
                                kriterijumu</button>
                        </div>
                        <div class="col-md-2">
                            <a href="/books" class="form-control btn btn-default rounded-pill">Resetuj filter</a>
                        </div>
                    </div>

                </form>



            </div>

        </div>


        <div class="d-flex justify-content-end">
            <a class="btn btn-dark rounded-pill" href="/books/create"><i class="bi bi-plus-lg"> </i> Dodaj
                novo
                izdanje </a>

        </div>
        <table class="table table-striped">
            <thead>

                <th scope="col">#</th>
                <th scope="col">Naslov</th>
                <th scope="col">Autor</th>
                <th scope="col">Izdavač</th>
                <th scope="col">Broj primeraka</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>

                        <td class="text-center">
                            @if (!$book->img_url)
                                <a href="/books/{{ $book->id }}"><img height="60" src="/images/default.png" alt=""></a>
                            @endif

                            <a href="/books/{{ $book->id }}"><img height="60" src="{{ $book->img_url }}" alt=""></a>

                        </td>


                        <td class="align-middle"><a class="btn px-2 py-0"
                                href="/books/{{ $book->id }}">{{ $book->title }}</a>
                        </td>
                        <td class="align-middle">
                            @foreach ($book->authors()->get() as $author)
                                <a class="btn px-2 py-0" href="/authors/{{ $author->id }}">{{ $author->name }}
                                </a>
                            @endforeach
                        <td class="align-middle">
                            @foreach ($book->publishers()->get() as $publisher)
                                <a class="btn px-2 py-0" href="/publishers/{{ $publisher->id }}">{{ $publisher->name }}
                                </a>
                            @endforeach
                        </td>
                        <td class="align-middle">{{ $book->items()->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ method_exists($books,'links')?$books->links():'' }}
    </div>

    </div>
    </div>
@endsection
