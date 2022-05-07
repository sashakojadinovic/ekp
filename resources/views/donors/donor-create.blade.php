@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                         <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Dodaj novog donatora/partnera</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/donors" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="donor-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="name" id="donor-name">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="donor-link">Link</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="link" id="donor-link">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="donor-type">Odaberi</label>
                        <select class="form-select bg-white rounded-pill" name="donor_partner" id="donor-type">
                            <option value="0">Partner</option>
                            <option value="1">Donator</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="donor-image">Izaberi sliku</label>
                <input class="form-control" type="file" name="image" id="donor-image">
                    </div>




                    <div class="d-flex justify-content-end">
                        <a href="/projects" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
