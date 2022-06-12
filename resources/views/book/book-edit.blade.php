@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Izmeni izdanje "{{ $book->title }}"</h1>

                <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="my-2">
                            <label class="form-label" for="book-title">Naslov</label>
                            <input value="{{ $book->title }}" class="form-control bg-white rounded-pill" type="text"
                                name="title" id="book-title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 my-2">
                            <div class="img-container">
                                <img height="270" id="img-preview" src="/{{ $book->img_url }}" alt="">
                                <button id="delete-img" class="btn btn-secondary align-top position-relative"
                                    style="right:38px">X</button>
                            </div>
                            <label class="form-label">
                                Dodaj sliku
                            </label>
                            <input id="img-input" type="file" class="form-control rounded-pill" name="image">
                        </div>
                        <div class="col-md-9">
                            <div class="row">

                                <div class="my-2 position-relative">
                                    <label class="form-label" for="author">Autori: </label>
                                    <div class="tag-container position-relative form-control bg-white rounded-pill  ps-2">
                                        <input placeholder="Pronađi..." type="text" data-model="Author" name="author"
                                            id="author">
                                        <button class="btn position-absolute top-0 end-0 rounded-pill adhoc" type="button"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Upiši novog autora">
                                            <i class="bi bi-capslock text-secondary"></i>

                                    </div>
                                    <input id="author-array" type="hidden" name="author-array">
                                </div>
                            </div>
                            <div class="row">
                                <div class="my-2 position-relative">
                                    <label class="form-label" for="publisher">Izdavači: </label>
                                    <div class="tag-container position-relative form-control bg-white rounded-pill  ps-2">
                                        <input placeholder="Pronađi..." type="text" data-model="Publisher" name="publisher"
                                            id="publisher">
                                        <button class="btn position-absolute top-0 end-0 rounded-pill adhoc" type="button"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Upiši novog izdavača">
                                            <i class="bi bi-capslock text-secondary"></i>
                                    </div>
                                    <input id="publisher-array" type="hidden" name="publisher-array">
                                </div>
                            </div>
                            <div class="row">
                                <div class="my-2 position-relative">
                                    <label class="form-label" for="category">Kategorija: </label>

                                    <select class=" form-control bg-white rounded-pill  ps-2" name="category-array"
                                        id="category">
                                        <option value="0">Izaberi kategoriju</option>
                                        @foreach ($categories as $category )
                                            <option {{$book->categories()->first()->id===$category->id? 'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="row">
                                <div class="my-2 col-md-6 position-relative">
                                    <label class="form-label" for="year">Godina izdavanja: </label>
                                    <input value="{{ $book->year }}" class="form-control bg-white rounded-pill"
                                        type="text" name="year" id="year">
                                </div>
                                <div class="my-2 col-md-6 position-relative">
                                    <label class="form-label" for="age">Uzrast: </label>
                                    <input value="{{ $book->age }}" class="form-control bg-white rounded-pill"
                                        type="text" name="age" id="age">

                                </div>

                            </div>

                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="my-2">
                    <label class="form-label" for="book-info">Opis</label>
                    <textarea class="form-control bg-white" name="info" id="book-info" cols="30" rows="5">{{ $book->info }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <!-- <input type="hidden" name="donators-list" id="donators-list"> -->
                    <a href="/books/{{ $book->id }}" class="btn btn-secondary rounded-pill  mt-2"><i
                            class="bi bi-x-circle"> </i>
                        Odustani</a>
                    <button type="submit" class="btn btn-danger rounded-pill mt-2 mx-1"><i class="bi bi-cloud-arrow-up">
                        </i>
                        Sačuvaj izmene</button>
                </div>
            </div>


            </form>
        </div>
    </div>
    </div>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($book->authors()->get() as $author)
                createBadge("{{ $author->name }}", "{{ $author->id }}", document.getElementById('author'));
            @endforeach
            @foreach ($book->categories()->get() as $category)
                createBadge("{{ $category->name }}", "{{ $category->id }}", document.getElementById(
                    'category'));
            @endforeach
            @foreach ($book->publishers()->get() as $publisher)
                createBadge("{{ $publisher->name }}", "{{ $publisher->id }}", document.getElementById(
                    'publisher'));
            @endforeach
            document.getElementById('author').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
            document.getElementById('category').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
            document.getElementById('publisher').addEventListener('input', (e) => getData(e.target, e.target.dataset
                .model));
            document.querySelectorAll('.adhoc').forEach(btn => {
                btn.addEventListener('click', e => adHoc(e));
            });
            const imgPreview = document.getElementById('img-preview');
            const imgInput = document.getElementById('img-input');
            document.getElementById('delete-img').addEventListener('click', e => {
                e.preventDefault();
                imgInput.value = null;
                imgPreview.src = "";
                document.getElementById('delete-img').classList.add("d-none");

            })

            imgInput.addEventListener('change', e => {
                //document.getElementById('delete-btn').style.display=block;
                if (e.target.files[0]) {
                    document.getElementById('delete-img').classList.remove("d-none");
                }

                const [file] = imgInput.files;
                if (file) {
                    console.log(URL.createObjectURL(e.target.files[0]));
                    imgPreview.src = URL.createObjectURL(e.target.files[0]);

                }
            });

            function adHoc(e) {
                //console.log(e.currentTarget)
                const inputValue = e.currentTarget.previousElementSibling.value;
                const model = e.currentTarget.previousElementSibling.dataset.model;
                if (inputValue.length < 2 || inputValue === "") {
                    return;
                }
                axios.post('/api/adhoc', {
                        model: model,
                        data: inputValue

                    })
                    .then(res => {
                        //console.log(res.data);
                        createBadge(res.data.name, res.data.id, document.getElementById(model.toLowerCase()));

                    });
                e.currentTarget.previousElementSibling.value = "";
            }

        });
    </script>
@endsection
