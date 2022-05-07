@extends("site.layout")
@section("title", "Seoski kulturni centar - Donatori i partneri")
@section("content")
    <div class="wave mt-4">
        <section id="donatori" class="container text-left">
            <h1>Donatori</h1>
            <hr class="" />
            <div class='p-2 row-cols-sm-2 row row-cols-2 row-cols-xs-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-5 d-flex align-items-center g-5'>
                @foreach($donors as $d)
                <a href="{{$d->link}}" target="_blank" class="d-flex align-items-center justify-content-center"><img class="img-fluid rounded" src="{{asset("images/donors/".$d->image)}}" /></a>
                @endforeach
            </div>

            <h1>Partneri</h1>
            <hr class="" />
            <div class='p-2 row-cols-sm-2 row row-cols-2 row-cols-xs-2 row-cols-md-4 row-cols-lg-4 row-cols-xl-5  g-5'>
                @foreach($partners as $p)

                <a href="{{$p->link}}" target="_blank" class="d-flex align-items-center justify-content-center"><img class="img-fluid rounded" src="{{asset("images/donors/".$p->image)}}" /></a>
                @endforeach
            </div>
            <hr class="" />

        </section>
@endsection
