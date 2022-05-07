@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-3 text-center">Blogovi</h1>
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-outline-dark rounded-pill" href="/blogs/create"><i class="bi bi-plus-lg"> </i> Dodaj blog
                    </a>

                </div>
                <table class="table table-striped">
                    <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Slika</th>
                    <th scope="col">Naslov</th>
                    <th scope="col">Kratak opis</th>
{{--                    <th scope="col">Ceo tekst</th>--}}
                    <th scope="col">Tagovi</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </thead>
                    <tbody id="html">
                    @foreach ($blogs as $b)
                        <tr class="">
                            <td>{{ $b->id }}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("/images/blogs/".$b->image)}}"></td>
                            <td>{{ $b->title }}</a></td>
                            <td>{{ $b->short_desc }}</a></td>
                            <td>@foreach($b->tags as $t)
                                    <small>{{$t->name}}@if(!$loop->last),@endif</small>
                                @endforeach</td>
                            <td><a class="px-2 py-0 btn btn-outline-success" href="/blogs/{{$b->id}}/edit">Izmeni</a></td>

                            <td><a data-id="{{$b->id}}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset("js/blogs.js")}}"></script>

@endsection

