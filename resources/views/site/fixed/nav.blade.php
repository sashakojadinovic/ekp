
{{--<div>--}}
<div class="overlay"></div>

<header class=" d-flex m-auto p-2 p-xs-2 p-sm-2 flex-column align-items-center flex-xl-row flex-lg-row">
        <nav class="col-xl-8 col-lg-10 col-12 m-auto navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="{{route("pocetna")}}"><img class="img-fluid logo" src="{{asset("images/logo.png")}}" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class=" d-flex align-items-center flex-column flex-xl-row flex-lg-row flex-md-row m-auto col-lg-11 col-xl-10 justify-content-around container">

                    <li class=""><a class="navA" href="{{route("pocetna")}}">Početna</a></li>

{{--                    <li class=""><a class="navA" href="#preporuke">Katalog knjiga</a></li>--}}

                    <li class="">
                        <a href="{{route("vesti")}}" class="navA">Vesti</a>
                    </li>
                    <li class="">
                        <a href="{{route("galerija")}}" class="navA">Galerija</a>
                    </li>
                    <li class="">
                        <a href="{{route("prostor")}}" class="navA">Prostori</a>
                    </li>
                    <li class="">
                        <a href="{{route('blog')}}" class="navA">Blog</a>
                    </li>
                    <li class="">
                        <a href="{{route('donatori')}}" class="navA">Donatori</a>
                    </li>
                    <li class=""><a class="fw-bolder text-decoration-underline navA" href="{{route("zajednica")}}"> Uključite se! </a></li>
{{--                    <li class="">--}}
{{--                        <a class="navA" href="{{route("kontakt")}}">Kontakt</a></li>--}}


                </ul>
            </div>

        </nav>
        <div class="m-auto d-md-block d-lg-block d-xl-block d-none">
            <ul class="d-flex flex-row m-auto align-items-center navigacija">
                <li class="p-2"> <a href="https://www.facebook.com/seoskikulturnicentar/"><i class="fa fa-facebook-square"></i></a></li>
                <li class="p-2"> <a href="https://www.instagram.com/skcmarkovac/"><i class="fa fa-instagram"></i></a></li>
                <li class="p-2"> <a href="mailto:skcmarkovac@gmail.com">

                    <i class="fa fa-envelope"></i></a></li>


            </ul>
        </div>
    </header>
