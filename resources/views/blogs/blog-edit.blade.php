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
                <h1 class="mt-3 text-center">Izmeni blog</h1>
                @if(session("success"))
                    <p class="alert alert-success">{{ session("success")}}</p>
                @endif
                <form action="/blogs/{{$blog->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label class="form-label" for="blog-title">Naslov</label>
                        <input class="form-control bg-white rounded-pill" type="text" name="title" value="{{$blog->title}}" id="blog-title">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="blog-short-desc">Kratak opis</label>
                        <textarea class="form-control bg-white rounded-pill"  name="short_desc" id="blog-short-desc">{{$blog->short_desc}}</textarea>
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="blog-short-desc">Tekst</label>
                        <textarea class="ckeditor form-control bg-white rounded-pill" id="desc" name="desc">
{{$html}}
                        </textarea>
                        {{--                        <input class="form-control bg-white rounded-pill" type="text" name="desc" id="blog-short-desc">--}}
                    </div>
                    <label class="form-label" for="blog-tags">Odaberi</label> <br/>

                    <div class="my-2" id="html">
                        @foreach($tags as $t)
                            <div class="form-check-inline">
                                <input class="form-check-input" name="tags[]" type="checkbox" @if(($blog->tags)->contains($t->id)) checked @endif value="{{$t->id}}" id="defaultCheck{{$t->id}}">
                                <label class="form-check-label" for="defaultCheck{{$t->id}}">
                                    {{$t->name}}
                                </label>
                            </div>
                        @endforeach

                    </div>
                    <p>
                        <a class="btn btn-outline-dark rounded-pill mt-2" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Ukoliko nema odgovarajući tag, dodajte ovde
                        </a>
                    <div class="collapse col-md-5 col-10" id="collapseExample">
                        <div class="card card-body">
                            <div class="my-2">
                                <label class="form-label" for="tag-name">Naziv taga</label>
                                <input class="form-control bg-white rounded-pill" type="text" name="tag-name" id="tag-name">
                                <a id="dodajTag" class="btn btn-dark rounded-pill mt-2" href="#"> Dodaj
                                </a>
                            </div>
                        </div>
                    </div>
                    </p>

                    <div class="my-2 row g-3">
                        <div class="col col-sm-3">
                            <img class="img img-thumbnail " src="{{asset("/images/blogs/".$blog->image)}}">
                        </div>
                        <div class="col m-auto">
                            <label class="form-label" for="blog-image">Promeni sliku</label>
                            <input class="form-control rounded-pill" type="file" name="image" id="blog-image">
                        </div>
                    </div>
{{--                    <div class="my-2">--}}
{{--                        --}}
{{--                        <label class="form-label" for="blog-image">Izaberi sliku</label>--}}
{{--                        <input class="form-control rounded-pill" type="file" name="image" id="blog-image">--}}
{{--                    </div>--}}




                    <div class="d-flex justify-content-end">
                        <a href="/blogs" class="btn btn-outline-dark rounded-pill  mt-2"><i class="bi bi-x-circle"> </i>
                            Odustani</a>
                        <button type="submit" class="btn btn-outline-dark rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{asset("js/tags.js")}}"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection
