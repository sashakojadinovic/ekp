@extends("site.layout")
@section("title", "Seoski kulturni centar - Galerija")
@section("content")
{{--{{dd($photos)}}--}}
    <div id="carouselExampleControls" class="carousel slide d-none m-auto" data-bs-ride="carousel">
        <div class="carousel-inner ">
            @foreach($photos as $p)
                <div id="{{$p->id}}" class="carousel-item">
                    <img src="{{asset("images/gallery/"."velika".$p->image)}}" class="img-fluid galleryOne" alt="{{$p->image}}">
                </div>
                @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>


    <div class="wave mt-4">
        <section id="galerija" class="container text-left mt-5 ">
            <h2 class="fw-bold mt-4">Galerija</h2>

            <hr class="" />
            <div class=' row-cols-sm-2 row row-cols-md-3 row-cols-lg-4 row-cols-xl-5'>
                    @foreach($photosPag as $p)
                    <div class="d-flex flex-column align-items-start p-2">

                    <img class="img-fluid picture rounded " data-id="{{$p->id}}" src="{{asset("images/gallery/"."mala".$p->image)}}" />
                    <h5>{{$p->event->title}}</h5>
                    <small>{{$p->project->name}}</small>
                    <small class="text-muted">{{$p->novDatum}}</small></div>
                @endforeach


            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5 d-flex align-items-center justify-content-center">
                    <li class="page-item">
                                            <a class="page-link" href="{{$photosPag->previousPageUrl()}}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Prethodna</span>
                                            </a>
                                        </li>
            @for($i=1;$i<=$photosPag->lastPage();$i++)
                <li class="page-item"><a class="page-link" href="{{$photosPag->url($i)}}">{{$i}}</a></li>
            @endfor
                    <li class="page-item">
                                            <a class="page-link" href="{{$photosPag->nextPageUrl()}}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Naredna</span>
                                            </a>
                                        </li>
                </ul>
            </nav>
        </section>





@endsection
