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
                            <h6 class="modal-title" id="exampleModalLabel">Upozorenje!</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Da li ste sigurni da želite da razdužite primerak sa signaturom ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWarning"
                                class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Odustani</button>
                            <button id="confirmBtn" data-borrowing="" onclick="removeBorrowing(JSON.parse(this.dataset.borrowing))" type="button" class="btn btn-danger rounded-pill">Razduži</button>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="mt-3 text-center">Lista iznajmljenih knjiga</h1>
            <div class="col-md-12">
{{--                 <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/borrowings/create"><i
                            class="bi bi-plus-lg"> </i>
                        Izdaj knjigu </a>
                </div> --}}
                <h5>Broj iznajmljenih knjiga: {{count($borrowings)}}</h5>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Vreme</th>
                        <th scope="col">Naslov</th>
                        <th scope="col">Signatura</th>
                        <th scope="col">Čitalac</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{date_format($borrowing->created_at,"d.m.Y. H:i")}}</td>
                                 <td><a class="btn px-2 py-0"
                                        href="/books/{{ $borrowing->item()->first()->book()->first()->id }}">{{ $borrowing->item()->first()->book()->first()->title }}</a>
                                </td>
                                <td>{{ $borrowing->item()->first()->signature }}</td>
                                <td><a class="btn px-2 py-0"
                                        href="/readers/{{ $borrowing->reader()->first()->id }}">{{ $borrowing->reader()->first()->name }}</a>
                                </td>
                                <td><a data-bs-toggle="modal" data-bs-target="#modalWarning"
                                        {{-- onclick="removeBorrowing(event,{{ $borrowing->id }})" --}}
                                        onclick='showModal({id:{{$borrowing->id}}, signature:"{{$borrowing->item()->first()->signature}}"})'
                                        class="btn btn-danger rounded-pill btn-sm " href="#">Razduži
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="deleteForm" action="/borrowings" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
    <script>
        function showModal(borrowing){
            const confirmBtn = document.getElementById('confirmBtn');
            confirmBtn.dataset.borrowing=JSON.stringify(borrowing);

        }
        function removeBorrowing(borrowing) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.setAttribute(`action`, `/borrowings/${borrowing.id}`);
            deleteForm.submit();

        }
    </script>
@endsection
