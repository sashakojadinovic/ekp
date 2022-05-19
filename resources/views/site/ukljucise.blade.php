@extends("site.layout")
@section("title", "Seoski kulturni centar - Uključi se")
@section("content")
    <div class="wave mt-4">
        <section id="ukljucise" class="container text-left col-xl-8 col-lg-8">
            <div id="accordion" class="senka">
                <div class=" rounded mt-5">
                    <div class="card">
                        <button class="btn" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    Kako mogu da doniram knjige?
                                </h5>
                            </div>
                        </button>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p>Potrebno je samo da se dogovorimo oko mesta i vremena za preuzimanje knjiga! Zahvalni smo puno svakom ko dobrovoljno proširuje naš fond knjiga!</p>
                                <h5> Kontakt podaci za doniranje knjiga:</h5>
                                skcmarkovac@gmail.com <br/>
                                https://www.facebook.com/seoskikulturnicentar <br/> 064/ 17 55 993, 061/29 26 791
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    Kako mogu da se uključim u rad SKCM-a?
                                </h5>
                            </div>
                        </button>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                            <div class="card-body">
                                {{--                                <p>Neki tekst o zahvalnosti za volontiranja i koliko nam to znaci</p>--}}
                                <h5>
                                    Volontiraj:
                                </h5>
                                <p>
                                    skcmarkovac@gmail.com <br/>
                                    https://www.facebook.com/seoskikulturnicentar
                                    <br/>
                                    064/ 17 55 993, 061/29 26 791

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    Kako mogu da se učlanim u biblioteku i da li je besplatno?
                                </h5>
                            </div>
                        </button>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p>  &#8226 Članstvo i pozajmljivanje knjiga je besplatno.
                                    <br/>
                                    &#8226 Otvorena je dva puta nedeljno – subotom od 11 do 14h i utorkom od 15 do 18h. Deluje
                                    na dve lokacije: u domaćinstvu Nade Babić (Nikole Pašića 52) i u Domu kulture
                                    Markovac (kancelarija Matičara).
                                <p><i class="fa fa-clock-o me-2" aria-hidden="true"></i>Radno vreme:
                                    <br/>
                                    <span class="fw-bold">na lokaciji Dom kulture: subota 11 do 14h, utorak 15 do 18h <br/>
               na lokaciji domaćinstvo Nade Babić: u vreme rada Dečjeg kluba, ili po dogovoru.</span></p>
                                &#8226 Bibliotekarke koje rade: Aleksandra Miladinović, Anđelka Nikolić, Jelena Marković, Marija Savić,
                                Nelica Stojadinović. U prvoj godini rada u Čitaonici su radili i Filip Miladinović i Ivana Stojanović.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">

                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    Kako mogu da doniram novac kako bih podržao/la rad SKCM-a?
                                </h5>
                            </div>
                        </button>

                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    Doniraj novac: <br/>
                                    Donacije u dinarima<br/>
                                    Primalac: Seoski kulturni centar Markovac<br/>
                                    Broj računa: 160-6000000835442-09<br/>
                                    <!--Svrha uplate: Donacija SKCM<br/>-->
                                    Donacije u evrima<br/>
                                    Primalac: Seoski kulturni centar Markovac<br/>
                                    <!--Svrha uplate: Donacija Seoskom kulturnom centru Markovac<br/>-->
                                    Račun: RS35160600000139899560<br/>
                                    SWIFT: DBDBRSBG<br/>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">

                            <div class="card-header" id="headingFive">
                                <h5 class="mb-0">
                                    Gde mogu da pratim obaveštenja o tome kada će biti naredne bibliterapije/filmoterapije?
                                </h5>
                            </div>
                        </button>

                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordion">
                            <div class="card-body">
                                <p>
                                    Informacije o narednim biblioterapijama ili filmoterapijama možete da pratite na sajtu, facebook grupi, instagram profil ili viber grupi!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="m-auto mt-5" />

@endsection
