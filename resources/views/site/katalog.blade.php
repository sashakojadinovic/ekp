@extends("site.layout")
@section("title", "Seoski kulturni centar - Katalog")
@section("content")
    <div class="wave mt-4 ">
        <form>
            <div class="d-flex flex-wrap mb-5 mb-md-3 justify-content-md-around p-md-0 p-2 justify-content-between align-items-start form-row">
                <div class="col-md-3 col-sm-6 col-12">
                    <input class="search form-control rounded " placeholder="Pretraži po naslovu..">
                    <small class="fw-bold">* u pretragu uključite Č, Ć, Š, Đ</small>
                </div>
                <div class="col-md-3 col-sm-5 col-12">

                    <input class="searchAuthor form-control rounded " placeholder="Pretraži po autoru..">
                    <small class="fw-bold">* u pretragu uključite Č, Ć, Š, Đ</small>
                    <br/>
                    <small class="fw-bold">* Za pretragu kucate : Prezime autora/autorke <span class="text-danger fw-bold h2">,</span> Ime</small>

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
<div id="main">
            @include('site.pagination')
</div>


            {{--            <ul class="pagination mt-5" >--}}

{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{$books->previousPageUrl()}}" aria-label="Previous">--}}
{{--                        <span aria-hidden="true">&laquo;</span>--}}
{{--                        <span class="sr-only">Prethodna</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @for($i=1;$i<=$books->lastPage();$i++)--}}
{{--                    <li class="page-item"><a class="page-link pag" href="{{$books->url($i)}}">{{$i}}</a></li>--}}
{{--                @endfor--}}
{{--                {{$books->onEachSide(5)->links("pagination::bootstrap-4")}}--}}
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{$books->nextPageUrl()}}" aria-label="Next">--}}
{{--                        <span aria-hidden="true">&raquo;</span>--}}
{{--                        <span class="sr-only">Naredna</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--        </nav>--}}

@endsection
