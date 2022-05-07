@extends("site.layout")
@section("title", "Seoski kulturni centar - Blog")
@section("content")

{{--{{dd($html)}}--}}
    <div class="wave mt-4">
        <img class="img-fluid galleryOne" src="{{asset("images/blogs/".$blog->image)}}">

        <section id="blog" class="container-fluid">
            <div class="d-flex flex-column">

{{--            </div>--}}
{{--            <h5 class="text-start">Tagovi:</h5>--}}

            <div class="container-fluid d-flex flex-column align-items-start justify-content-center  p-5">
{{--                @foreach($blog->tags as $t)--}}
{{--                    <h4 class="text-decoration-underline text-center">{{$t->name}}@if(!$loop->last),@endif</h4>--}}
{{--                @endforeach--}}
        {!! $html !!}
            </div>
            </div>
        </section>
        <hr class="m-auto"/>
{{--        <section class="mt-4">--}}
{{--            <div class="container">--}}
{{--                <div class="d-flex flex-md-row flex-column justify-content-around align-items-start ">--}}
{{--                        <div class="col-md-5 col-lg-6 col-12">--}}
{{--                            <h3 class="">6 komentara ukupno</h3>--}}

{{--                                    <div class="bg-light rounded border mt-2 p-2">--}}
{{--                                        <h4>John Doe</h4>--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>--}}
{{--                                        <div><small class="text-muted">Datum postavljanja: </small><p>June 27, 2018 at 2:21pm</p></div>--}}

{{--                                    </div>--}}
{{--                            <div class="bg-light rounded border  mt-2 p-2">--}}
{{--                                <h4>John Doe</h4>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>--}}
{{--                                <div><small class="text-muted">Datum postavljanja: </small><p>June 27, 2018 at 2:21pm</p></div>--}}

{{--                            </div>--}}
{{--                                <a class="btn btn-outline-dark mt-2 mb-3 col-12">Prikaži još komentara</a>--}}

{{--                        </div>--}}
{{--                            <div class=" col-md-6 col-lg-4 col-12">--}}
{{--                                <h3 class="">Napiši komentar</h3>--}}
{{--                                <form action="" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <div class="">--}}
{{--                                        <label for="exampleFormControlInput1" class="form-label">Ime i prezime/email</label>--}}
{{--                                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email">--}}
{{--                                    </div>--}}
{{--                                    <div class="">--}}
{{--                                        <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>--}}
{{--                                        <textarea class="form-control rounded" placeholder="Komentar..." name="tekst" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
{{--                                    </div>--}}
{{--                                    <div class="">--}}
{{--                                        <button type="submit" class="btn btn-outline-dark mt-2 mb-3">Napiši komentar</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                </div>--}}


{{--        </section>--}}

@endsection
