@extends("site.layout")
@section("title", "Seoski kulturni centar - Katalog")
@section("content")
    <div class="wave mt-4 ">
        <form>
        <div class="d-flex flex-wrap mb-5 mb-md-3 justify-content-md-around p-md-0 p-2 justify-content-between align-items-center form-row">
                <div class="col-md-3 col-sm-6 col-12">
            <input class="search form-control rounded " placeholder="Pretraži po naslovu..">
                </div>
            <div class="col-md-3 col-sm-5 col-12">

            <input class="searchAuthor form-control rounded " placeholder="Pretraži po autoru..">
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <select class="category form-select">
                    <option value="0" class="form-control">Odaberi žanr</option>
                   @foreach($categories as $c)
                        <option value="{{$c->id}}" class="form-control">{{$c->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-check col-md-2 col-sm-3 col-12 text-start ">
                <input class="form-check-input available" type="checkbox" name="check" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Samo dostupni u čitaonici
                </label>
            </div>
            </div>
        </form>
        <div id="books" class=" container-fluid row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 g-4">
{{--        {{dd($books)}}--}}
        @foreach($books as $b)
        <div class="col">
            <div class="card h-100">
                <img src="{{$b->img_url}}" class="card-img-top" alt="{{$b->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$b->title}}</h5>
                    <h6 class="card-title">
                        @foreach($b->authors as $a)
                        {{$a->name}}
                            @if ($loop->last)
                                @break
                            @endif
                            ,
                        @endforeach</h6>
                    <p class="card-text">{{$b->info}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Broj dostupnih primeraka u čitaonici: </small> <span>{{$b->items_count-$b->borrows_count}}</span>
                </div>
            </div>
        </div>
            @endforeach

    </div>
        <nav aria-label="Page navigation example">
{{--            <ul class="pagination mt-5" >--}}

            <ul  id="pag" class="pagination mt-5 d-flex align-items-center justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="{{$books->previousPageUrl()}}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Prethodna</span>
                    </a>
                </li>
                @for($i=1;$i<=$books->lastPage();$i++)
                    <li class="page-item"><a class="page-link pag" href="{{$books->url($i)}}">{{$i}}</a></li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{$books->nextPageUrl()}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Naredna</span>
                    </a>
                </li>
            </ul>
        </nav>

@endsection
