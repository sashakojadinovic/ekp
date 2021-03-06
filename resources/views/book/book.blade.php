@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Modal -->
            <div class="modal fade" id="deleteModalWarning" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger  text-white">
                            <h4 class="modal-title" id="exampleModalLabel">Upozorenje!</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da izbrišete izdanje?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" type="button" class="btn btn-danger rounded-pill">Izbriši</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 2 -->
            <div class="modal fade" id="returnModalWarning" tabindex="-1" aria-labelledby="exampleModalLabel2"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger  text-white">
                            <h6 class="modal-title" id="exampleModalLabel2">Upozorenje!</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da vratite primerak izdanja?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#returnModalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn2" type="button" class="btn btn-danger rounded-pill">Vrati</button>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Modal 3 -->
             <div class="modal fade" id="deleteItemModalWarning" tabindex="-1" aria-labelledby="exampleModalLabel3"
             aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header bg-danger  text-white">
                         <h6 class="modal-title" id="exampleModalLabel3">Upozorenje!</h6>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                             aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <p>Da li ste sigurni da želite da izbrišete primerak izdanja?</p>
                     </div>
                     <div class="modal-footer">
                         <button type="button" data-bs-toggle="modal" data-bs-target="#deleteItemModalWarning"
                             class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                         <button id="confirmBtn3" type="button" class="btn btn-danger rounded-pill">Izbriši</button>
                     </div>
                 </div>
             </div>
         </div>

            <h1 class="mt-3 text-center">{{ $book->title }}</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark rounded-pill" href="/books"><i class="bi bi-arrow-90deg-up"> </i>Sva
                            izdanja</a>
                    </div>
                    <div>
                        <a class="btn btn-success rounded-pill mx-1 d-inline-block"
                            href="/books/{{ $book->id }}/edit"><i class="bi bi-pencil-square"> </i> Izmeni </a>
                        <form class="d-inline-block" id="deleteForm" action="/books/{{ $book->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModalWarning"
                                class="btn btn-danger rounded-pill"><i class="bi bi-trash2-fill"> </i> Izbriši
                            </button>

                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 mt-5">
                        @if (!$book->img_url)
                            <img width="100%" src="/images/default.png" alt="">
                        @endif
                        <img width="100%" src={{ asset($book->img_url) }} alt="">
                    </div>
                    <div class="col-md-10 mt-5">
                        <h6 class="fw-bold">Autor: <span class="fw-normal">
                                @if ($book->authors()->first())
                                    @foreach ($book->authors()->get() as $author)
                                        <a class="btn px-2 py-0"
                                            href="/authors/{{ $author->id }}">{{ $author->name }}</a>
                                    @endforeach
                                @endif

                            </span>
                        </h6>
                        <h6 class="fw-bold">Kategorija:
                            <span
                                class="fw-normal">{{ $book->categories()->first() ? $book->categories()->first()->name : '' }}</span>
                        </h6>
                        <h6 class="fw-bold">Izdavač:
                            @foreach ($book->publishers()->get() as $publisher)
                                <a class="py-0 fw-normal text-decoration-none"
                                    href="/publishers/{{ $publisher->id }}">{{ $loop->first ? $publisher->name : ', ' . $publisher->name }}</a>
                            @endforeach
                        </h6>
                        <h6 class="fw-bold">Godina izdanja: <span
                                class="fw-normal">{{ $book->year ? $book->year . '.' : '' }}</span></h6>
                        <h6 class="fw-bold">Uzrast: <span
                                class="fw-normal">{{ $book->age ? $book->age . '+' : '' }}</span></h6>


                        <h6 class="fw-bold">Opis:</h6>
                        <p>{{ $book->info }}</p>
                    </div>
                </div>


                <div class="mt-5">
                    <div class="d-flex justify-content-between">
                        <h3>Primerci ovog izdanja:</h3>
                        <a class="btn btn-dark rounded-pill"
                        @if ($book->categories()->first())
                             href="/items/create?id={{ $book->id }}&cat={{ $book->categories()->first()->id }}"
                        @endif
                           ><i
                                class="bi bi-plus-lg"> </i>
                            Dodaj primerak naslova </a>

                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Signatura</th>
                            <th>Donator</th>
                            <th scope="col">Status</th>
                            <th scope="col">Izdavanje</th>
                            <th scope="col">Izmene</th>
                            <th scope="col">Brisanje</th>

                        </thead>
                        <tbody>
                            @foreach ($book->items()->get() as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->signature }}</td>
                                    <td><a class="btn rounded-pill"
                                            href="/donators/{{ $item->donator()->first()->id ?? '' }}">{{ $item->donator()->first()->name ?? '' }}</a>
                                    </td>
                                    <td>
                                        @if ($item->borrowing()->exists())
                                            <p class="mb-0 text-danger">Izdato <i class="bi bi-arrow-right"></i>
                                                <a class="text-danger text-decoration-none"
                                                    href="/readers/{{ $item->borrowing()->first()->reader()->first()->id }}">
                                                    {{ $item->borrowing()->first()->reader()->first()->name }}</a>
                                            </p>
                                        @else
                                            <span>Raspoloživo</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($item->borrowing()->exists())
                                            <form class="d-inline-block" id="returnForm"
                                                action="/borrowings/{{ $item->borrowing()->first()->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button id="returnBook" data-bs-toggle="modal"
                                                    data-bs-target="#returnModalWarning"
                                                    class="btn btn-sm btn-danger rounded-pill"> Vrati
                                                </button>

                                            </form>
                                        @else
                                            <a class="btn btn-dark rounded-pill btn-sm "
                                                href="/borrowings/create/?id={{ $item->id }}">Izdaj</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success rounded-pill btn-sm"
                                            href="/items/{{ $item->id }}/edit"><i class="bi bi-pencil-square"> </i>
                                            Izmeni </a>
                                    </td>
                                    <td>
                                        <form id="deleteItemForm" action="/items/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="deleteItem" data-bs-toggle="modal" data-bs-target="#deleteItemModalWarning" class="btn btn-danger btn-sm rounded-pill">Izbriši</button>
                                        </form>
                                    </td>
                            @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <h5>Ukupan broj pozajmljivanja: {{count($borrowings)}}</h5>
                    <h3>Istorija pozajmljivanja</h3>

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">Datum pozajmljivanja</th>
                            <th scope="col">Datum vraćanja</th>
                            <th scope="col">Primerak</th>
                            <th scope="col">Pozajmio/pozajmila</th>
                        </thead>
                        <tbody>
                            @foreach ($borrowings as $borrowing)
                                <tr>
                                    <td>{{date_format($borrowing->created_at,"d.m.Y.")}}</td>
                                    <td>{{$borrowing->deleted_at?date_format($borrowing->deleted_at,"d.m.Y."):'nije vraćeno'}}</td>
                                    <td>{{$borrowing->item()->first()->signature}}</td>
                                    <td><a class="btn px-2 py-0" href="/readers/{{$borrowing->reader()->first()->id}}">{{$borrowing->reader()->first()->name}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        //const warning = document.getElementById('modalWarning');
        const deleteForm = document.getElementById('deleteForm');
        const delBtn = document.getElementById('deleteBtn');
        const confBtn = document.getElementById('confirmBtn');
        delBtn.addEventListener('click', e => e.preventDefault());
        confBtn.addEventListener('click', e => deleteForm.submit());
        if (document.getElementById('returnBook')) {
            const returnBtn = document.getElementById('returnBook');
            const returnForm = document.getElementById('returnForm');
            const confBtn2 = document.getElementById('confirmBtn2');
            returnBtn.addEventListener('click', e => e.preventDefault());
            confBtn2.addEventListener('click', e => returnForm.submit());
        }
        const deleteForm3 = document.getElementById('deleteItemForm');
        const delItemBtn = document.getElementById('deleteItem');
        delItemBtn.addEventListener('click', e=>e.preventDefault());
        const confBtn3 = document.getElementById('confirmBtn3');
        confBtn3.addEventListener('click', e => deleteForm3.submit());
    </script>
@endsection
