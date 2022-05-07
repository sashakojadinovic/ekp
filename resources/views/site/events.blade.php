@extends("site.layout")
@section("title", "Seoski kulturni centar - Vesti")
@section("content")
    <div class="wave mt-4">
        <section id="vesti" class="container mb-5">
            <input type="hidden" value="" id="filter">

            <h3 id="tekst">Prikazane su sve vesti i svi događaji</h3>
            <button class="btn btn-site px-2 py-0 fw-bold" id="dates">Prikaži samo događaje koji slede</button>
            <div class="card-deck row gy-4 gx-0 mt-1" id="events">

            @foreach($events as $e)
                    <div class="card d-flex flex-row flex-lg-nowrap flex-xl-nowrap flex-wrap  shadow">
                        <img class="img-fluid galleryOne" src="{{asset("images/posters/".$e->coverImg)}}" alt="{{$e->title}}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{$e->title}}</h5>
                            <p class="card-text">{{$e->desc}}</p>
                           <small class="text-muted">Datum: </small> <p class="card-text"> {{$e->date}}</p>
                            <small class="text-decoration-underline">{{$e->project->name}}</small>
                        </div>
                    </div>
    @endforeach
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5" id="pag">
                    <li class="page-item">
                        <a class="page-link" href="{{$events->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Prethodna</span>
                        </a>
                    </li>
                    @for($i=1;$i<=$events->lastPage();$i++)
                    <li class="page-item"><a class="page-link" class="pag" href="{{$events->url($i)}}">{{$i}}</a></li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{$events->nextPageUrl()}}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Naredna</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>

    @endsection
