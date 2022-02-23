@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Upiši novog donatora</h1>

                <form action="/donators" method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="donator-name">Ime donatora</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="name" id="donator-name">
                    </div class="my-2">
                    <div>
                        <label class="form-label" for="donator-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="donator-info" cols="30"
                            rows="10"></textarea>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="/donators" class="btn btn-outline-dark rounded-pill  mt-2"><i
                                class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
