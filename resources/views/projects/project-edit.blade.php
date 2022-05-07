@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni kategoriju za vesti</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/projects/{{$project->id}}" method="POST">
                    @csrf
                    @method("put")
                    <div class="my-2">
                        <label class="form-label" for="project-name">Naziv</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="name" value="{{$project->name}}" id="project-name">
                    </div class="my-2">



                    <div class="d-flex justify-content-end">
                        <a href="/projects" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Izmeni</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
