@extends("site.layout")
@section("title", "Seoski kulturni centar - Blog")
@section("content")

    <div class="wave mt-4">
        <section id="blog" class="container-fluid">
            <div class=" row g-3 m-auto">
                @foreach($blogs as $b)

                <div class="col-md-6 m-auto mt-3">
                    <div class="card p-2">
                        <div class="row g-0 align-items-center">
                            <div class="col-sm-5">
                                <a href="/blogOne/{{$b->id}}"> <img src="{{asset("images/blogs/".$b->image)}}" class="card-img" alt=""></a>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/blogOne/{{$b->id}}">{{$b->title}}</a></h5>
                                    <p class="card-text ">{{$b->short_desc}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsum rem, delectus deserunt consectetur saepe? Expedita sapiente rerum nostrum fuga non iure minima sunt inventore.</p>
                                    <small>Tagovi:</small> @foreach($b->tags as $t) <small class="text-decoration-underline">{{$t->name}} @if(!$loop->last),@endif</small> @endforeach
                                    <br/>

                                </div>
                                <div class="d-flex justify-content-between align-items-center">

                                    <a href="/blogOne/{{$b->id}}" class="text-decoration-underline ms-2"><h5>Prikaži više</h5></a>
                                    <span class="fw-bold">{{$b->datum}}</span>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5 d-flex align-items-center justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="{{$blogs->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Prethodna</span>
                        </a>
                    </li>
                    @for($i=1;$i<=$blogs->lastPage();$i++)
                        <li class="page-item"><a class="page-link" href="{{$blogs->url($i)}}">{{$i}}</a></li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{$blogs->nextPageUrl()}}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Naredna</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>

@endsection
