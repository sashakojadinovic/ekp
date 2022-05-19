@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Naslovi</h1>
            <div class="col-md-12 my-3">
                <div class="row">
                    <div class="col-md-4">
                        <form action="" method="GET">
                            @csrf
                            <div class="my-1 px-0 position-relative">

                                <input class="form-control bg-white rounded-pill" type="text" name="title" id="title"
                                    placeholder="Filtriraj po naslovu"><button
                                    class="btn position-absolute top-0 end-0 rounded-pill" type="submit"><i
                                        class="bi bi-funnel"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="" method="GET">
                            @csrf
                            <div class="my-1 px-0  position-relative">

                                <input class="form-control bg-white rounded-pill" type="text" name="author" id="author"
                                    placeholder="Filtriraj po autoru"><button
                                    class="btn position-absolute top-0 end-0 rounded-pill" type="submit"><i
                                        class="bi bi-funnel"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="" method="GET">
                            @csrf
                            <div class="my-1 px-0  position-relative">

                                <input class="form-control bg-white rounded-pill" type="text" name="publisher" id="publisher"
                                    placeholder="Filtriraj po izdavaču"><button
                                    class="btn position-absolute top-0 end-0 rounded-pill" type="submit"><i class="bi bi-funnel"></i></button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-end">
                <a class="btn btn-dark rounded-pill" href="/books/create"><i class="bi bi-plus-lg"> </i> Dodaj
                    novo
                    izdanje </a>

            </div>
            <table class="table table-striped">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">#</th>
                    <th scope="col">Naslov</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Izdavač</th>
                    <th scope="col">Broj primeraka</th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td class="text-center">
                                @if (!$book->img_url)
                                    <a href="/books/{{ $book->id }}"><img height="60" src="/images/default.png"
                                            alt=""></a>
                                @endif

                                <a href="/books/{{ $book->id }}"><img height="60" src="{{ $book->img_url }}"
                                        alt=""></a>

                            </td>


                            <td class="align-middle"><a class="btn px-2 py-0 fw-bolder "
                                    href="/books/{{ $book->id }}">{{ $book->title }}</a>
                            </td>
                            <td class="align-middle">
                                @foreach ($book->authors()->get() as $author)
                                    <a class="btn px-2 py-0" href="/authors/{{ $author->id }}">{{ $author->name }}
                                    </a>
                                @endforeach
                            <td class="align-middle">
                                @foreach ($book->publishers()->get() as $publisher)
                                    <a class="btn px-2 py-0"
                                        href="/publishers/{{ $publisher->id }}">{{ $publisher->name }}
                                    </a>
                                @endforeach
                            </td>
                            <td class="align-middle">{{ $book->items()->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{-- {{ $books->links() }} --}}
    </div>
    </div>
@endsection
