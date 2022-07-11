    {{--                    {{dd($books)}}--}}
    <div id="books" class=" container-fluid row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4">

    @foreach($books as $b)
{{--                        {{dd($b)}}--}}
        <div class="col">
            <div class="card h-100">
                <img src="{{asset($b->img_url)}}" class="card-img-top" alt="{{$b->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$b->title}}</h5>
                    <small>Autor/ka:</small>
                    <h6 class="card-title">
                        @foreach($b->authors as $a)
                            {{$a->name}}
                            @if ($loop->last)
                                @break
                            @endif
                            i
                        @endforeach</h6>
                    <small>Žanr:</small>
                        <h6> @foreach($b->categories as $a)
                                {{$a->name}}
                                @if ($loop->last)
                                    @break
                                @endif
                                ,
                            @endforeach</h6>
                    <small>Izdavač:</small>
                    <h6> @foreach($b->publishers as $a)
                            {{$a->name}}
                            @if ($loop->last)
                                @break
                            @endif
                            ,
                        @endforeach</h6>
{{--                    <small>Godina izdanja:</small>--}}
{{--                    <p>{{$b->year}}</p>--}}

                    {{--                            <p class="card-text">{{$b->info}}</p>--}}
                </div>
                <div class="card-footer">
                    <small class="text-muted">Broj dostupnih primeraka u čitaonici: </small> <span>{{$b->items_count-$b->borrows_count}}</span>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <nav aria-label="Page navigation example">

    <ul  id="pag" class="pagination mt-5 d-flex align-items-center justify-content-center">

    {{$books->onEachSide(5)->links("pagination::bootstrap-4")}}
    </ul>
    </nav>
{{--{!! $books->links() !!}--}}
