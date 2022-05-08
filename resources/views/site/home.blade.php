@extends("site.layout")
@section("title", "Seoski kulturni centar - Početna")
@section("content")
    <section id="pocetna" class="h-auto w-auto p-5">
        <div id="" class="container-fluid d-flex p-3 justify-content-around flex-column flex-xl-row">
            <img class="img-fluid glavnaSlika m-auto" alt="glavna slika" src="{{asset("images/posters/"."glavna".$event->coverImg)}}" />
            <div class="d-flex flex-column justify-content-center ms-5 mt-5 mt-xl-0 align-items-xl-start align-items-center">
{{--                <h1 class="display-5">Bitan događaj koji sledi</h1>--}}
{{--                <strong class="text-left">Naziv knjige: </strong>--}}
{{--                <h2 class="text-decoration-underline mb-lg-5 mb-xl-5">{{$event->title}}--}}
{{--                </h2>--}}
{{--                <strong class="">Autor: </strong>--}}
{{--                <small>Datum održavanja: </small>--}}
                    <h5>{{$event->desc}}</h5>
                <h3 class="fw-bold">{{$event->date}}</h3>
                    <h6 class="text-decoration-underline">{{$event->project->name}}</h6>
{{--                    <h5>{{$event->project->name}}</h5>--}}


            </div>

        </div>
    </section>

    <section id="brojevi" class="d-flex align-items-center justify-content-around p-5">
        <div class="row row-cols-md-4 row-cols-sm-2 row-cols-2 d-flex justify-content-around w-100">

            <div class="d-flex flex-column align-items-center text-center justify-content-center">
                <p class="fw-bold text-decoration-underline">Članstvo biblioteke</p>
                <div class="d-flex">
                    <img class="img-fluid" alt="reader" src="https://img.icons8.com/external-itim2101-lineal-itim2101/64/000000/external-reader-life-style-avatar-itim2101-lineal-itim2101-1.png" />
                    <img class="img-fluid" alt="reader 2" src="https://img.icons8.com/external-itim2101-lineal-itim2101/64/000000/external-reader-life-style-avatar-itim2101-lineal-itim2101.png" />

                    <!-- <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-reader-life-style-avatar-itim2101-lineal-color-itim2101.png" />
                        <img src="https://img.icons8.com/external-itim2101-lineal-color-itim2101/64/000000/external-reader-life-style-avatar-itim2101-lineal-color-itim2101-1.png" /> -->
                </div>
                <h3 class="fw-bold citalac"></h3>

            </div>

            <div class="d-flex flex-column align-items-center text-center justify-content-center">
                <p class="fw-bold text-decoration-underline"> Knjižni fond</p>
                <img class="img-fluid" alt="knjige" src="https://img.icons8.com/external-prettycons-solid-prettycons/64/000000/external-books-education-prettycons-solid-prettycons-2.png" />
                <h3 class="fw-bold knjige"></h3>
            </div>
            <div class=" d-flex flex-column align-items-center text-center justify-content-center">
                <p class="fw-bold text-decoration-underline">Održanih dešavanja</p>
                <img class="img-fluid" alt="events" src="https://img.icons8.com/external-icongeek26-glyph-icongeek26/64/000000/external-events-donation-and-charity-icongeek26-glyph-icongeek26.png" />
                <h3 class="fw-bold desavanja"></h3>

            </div>
            <div class=" d-flex flex-column align-items-center text-center justify-content-center">
                <p class="fw-bold text-decoration-underline">Članstvo dečjeg kluba</p>
                <img class="img-fluid" alt="deca" src="https://img.icons8.com/ios-filled/64/000000/children.png" />
                <h3 class="fw-bold deca"></h3>

            </div>
        </div>
    </section>
    <div class="wave mt-4">


    <section id="onama" class="d-flex flex-column align-items-center p-5 container mb-5">



        <div class="d-flex justify-content-between flex-xl-row flex-lg-row flex-column-reverse">
            <div class="col-12 col-lg-6 slikaOnama">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner senka rounded">
                        @foreach($photos as $p)
                        <div class="carousel-item @if($loop->index==0)active @endif">
                            <img src="{{asset("images/gallery/"."velika".$p->image)}}" class=" img-fluid rounded fixed" alt="Mesto za sliku iz galerije">
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 d-flex flex-column justify-content-evenly">
                <h3 class="text-center fw-bold">O seoskom kulturnom centru Markovac...</h3>
                <p><span class="fw-bold">Seoski kulturni centar Markovac</span>
                    je udruženje građanki i građana nastalo kao rezultat
                    rada Umetničke grupe <a href="https://www.hop-la.org/">Hop.la!</a> u Markovcu kod Velike Plane, sa ciljem ponovnog
                    pokretanja kulturnog i društvenog života u selu i okolini. Projekat letnjih pozorišnih
                    radionica za decu, osnivanje Čitaonice “Ekatarina Pavlović”, kulturna dostava i rad na prvim
                    kamišibaji predstavama, bili su baza za povezivanje meštanki/a i umetnika/ca iz šire zajednice i
                    formalno osnivanje udruženja, 16.11.2020. SKCM se zalaže za dostupnost kulture, obrazovanja i socijalnih usluga svim društvenim
                    grupama, bez obzira na pol, etničku pripadnost, mesto stanovanja ili imovno stanje. U lokalnoj
                    zajednici ovaj cilj se ostvaruje kontinuiranim radom Čitaonice (besplatne javne biblioteke) i
                    Dečjeg kluba. Na široj sceni udruženje se povezuje sa sličnim inicijativama i doprinosi javnoj
                    kampanji za decentralizaciju kulture, što je primećeno i vrednovano priznanjima kao što su
                    zahvalnica Beogradske otvorene škole za angažman na polju kulturne decentralizacije i borbe za
                    rodnu ravnopravnost, priznanje BeFema za kulturnu mobilnost, Nagrada Jelena Šantić za
                    poseban doprinos razvoju zajednice kroz umetnost.SKCM deluje i u polju izvođačkih i vizuelnih umetnosti, sa fokusom na umetnost
                    zajednice, ambijentalnu i ekološki održivu umetnost, kao i na očuvanje materijalnog i
                    nematerijalnog kulturnog nasleđa. </p>

            </div>

        </div>

        <div class="d-flex flex-row justify-content-evenly mt-3 col-12">
            {{--                <h3 class="text-center fw-bold">Ukratko o seoskom kulturnom centru u Markovcu..</h3>--}}
            <p id="prikazi"> Zato se, uporedo sa kampanjom za sanaciju Doma kulture i
                povratak prvobitne namene ove zgrade, angažuje na izvođenju kulturnih dešavanja u prostoru
                seoskog domaćinstva: adaptira nekadašnji vinski podrum u javnu biblioteku, od starog koša
                (skladišta za kukuruz) pravi ad hoc pozornicu, a čitav prostor dvorišta koristi kao poligon za
                održavanje različitih aktivnosti za decu predškolskog i školskog uzrasta.Pedagoške aktivnosti SKCM počivaju na principima feminističke pedagogije, koja se zalaže
                protiv tradicionalne hijerarhije odnosa u pedagoškom procesu, a afirmiše slobodu misli i govora,
                kriitički duh i ravnopravnost učesnika u procesu učenja i razvoja. Kreativnost, građanska svest i
                ekološki aktivizam imaju povlašćeno mesto u pedagoškim procesima SKCM-a. Umetnici/e i
                pedagozi/škinje rade zajedno, favorizuje se multidisciplinarni pristup i samostalnost u radu.Svoja znanja i iskustva SKCM rado deli sa pojedinkama/incima i institucijama aktivnim u
                radu sa decom i za decu. Naše saradnici stečenu stručnu praksu koriste u svakodnevnom radu u
                školskim ustanovama i sličnim projektima, dok umetnici koji stvaraju za decu imaju prilike da u
                ranoj fazi kreativnog procesa svoja dela razvijaju u neposrednom kontaktu sa publikom –
                polaznicima našeg Dečjeg kluba. Kroz savetodavni rad i različite oblike kulturterapije, SKCM je angažovan na polju brige
                za mentalno zdravlje i zalaže se za dostupnost socijalnih usluga i u manjim sredinama i
                zajednicima, kao i protiv stigmatizacije psiholoških teškoća i oboljenja, koja je često prisutna u
                patrijarhalnim sredinama.</p>


        </div>
            <a href="#" id="showMore">Prikaži više</a>


    </section>
    <hr class="m-auto">
        <h3 class="mb-4 mt-2 text-center">Naši projekti</h3>

        <section id="radionice" class="d-flex flex-row h-100 d-flex justify-content-around mb-5">

            <div class="container row row-cols-sm-2 row-cols-1 row-cols-xs-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-4">

{{--@foreach($projects as $p)--}}
                <div class="text-center">
                    <caption class=" mb-1">Kamišibaji</caption>

                    <!-- Button trigger modal -->
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalLong1">
                        <img class="img-fluid slika rounded" src="{{asset("images/kamisibaji.jpg")}}" />

                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold" id="exampleModalLongTitle">Kamišibaji</h4>
                                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                        <span  aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-row text-start">
{{--                                    <img class="img-fluid rounded" src="{{asset("images/kamisibaji.jpg")}}" />--}}
                                    <p>
                                        &#8226 Kamišibaji <span class="fst-italic">(od reči kami= papir, i šibaji =pozorište)</span> je drevna japanska umetnost
                                        pripovedanja uz pomoć slika koje izvođač pokazuje, jednu za drugom, na maloj drvenoj
                                        pozornici. Počeli smo da istražujemo ovu zanimljivu formu 2020.godine, u želji da
                                        prilagodimo planirani pozorišni program novonastaloj epidemiološkoj situaciji. U režiji i
                                        izvođenju Anđelke Nikolić i Petra Lukića nastale su naše prve kamišibaji predstave: <span class="text-decoration-underline">„Šta je to
                                        kamišibaji?“, „Dr Li“, „Elmer na štulama“, „Rapatočki“, „Put vetra“, „Žabac i stranac“,
                                        „Kradljivci kokosovih oraha“ </span>. Izvođene su u dvorištima Markovca, za decu, njihove roditelje
                                        i susede. <br/> <br/>
                                        &#8226 Predstava <span class="text-decoration-underline">„Žabac i stranac“</span>, po knjizi Maksa Velthajsa, odvela nas je na Festival ekološkog
                                        pozorišta u Bačkoj Palanci 2020, kao i na <span class="fw-bold">Festival Asitež</span> centra Srbije u Beogradu 2021, i tako
                                        predstavila naš rad široj javnosti. <br/> <br/>
                                        &#8226 2021.godine uspostavili smo saradnju sa izdavačkom kućom <a href="https://kreativnicentar.rs/">Kreativni centar</a>, i napravili
                                        seriju novih predstava, po naslovima „Kišni oblak“ i „Petson kampuje“, a očekuju nas i
                                        premijerna izvođenja naslova „Strašno strašna priča“, „Mama Mu pravi kućicu na drvetu“ i
                                        „Svi se brojimo“. U sklopu projekta „Unutrašnje dvorište“ izvedena je predstava „Meda
                                        Pedington u vrtu“. Postali smo i članovi IKAJA – Međunarodne kamišibaji asocijacije sa
                                        sedištem u Japanu. <br/> <br/>
                                        &#8226
                                        Kamišibaji je pozorišni oblik, ali i inspirativno sredstvo za rad sa decom predškolskog i
                                        osnovnoškolskog uzrasta, budući da razvija maštu, kreativnost, vizuelnu percepciju i govorne
                                        veštine. Zato je članica našeg tima i psihološkinja Aleksandra Miladinović.
                                        No, s obzirom na to da je kamišibaji, pre svega, umetnost pripovedanja uz slike, naši
                                        najvažniji saradnici su – <span class="fst-italic">pisac i ilustrator </span>. Nakon predstava pravljenih prema već postojećim
                                        slikovnicama, u martu 2022. nastaje naš prvi originalni kamišibaji, za koji je, prema
                                        adaptiranoj priči Jasminka Petrovic „Hoću kući“, originalne slike napravila Ana Petrović.
                                        <br/> <br/> &#8226
                                        Kamišibaji predstave izvodimo u Markovcu i okolini, a možete ih videti i u Beogradu, na sceni
                                        Malog pozorišta „Duško Radović“ , u Kragujevcu, na sceni Dramskog studija „Petar Pan“ i –
                                        gde god nas pozovu! U izvođačkom timu osim Petra Lukića nalaze se Đorđe Živadinović
                                        Grgur i Uroš Mladenović, a inicijator i stalni partner na ovom projektu je Umetnička grupa
                                        <a href="https://www.hop-la.org/">Hop.La!</a> <br/> <br/>
                                        &#8226 Naš rad na istraživanju i praktičnoj primeni tehnika kamišibaji pozorišta do sada su podržali
                                        <a href="https://www.rwfund.org/">Rekonstrukcija Ženski fond</a>, <a href="https://www.kultura.gov.rs/">Ministarstvo kulture i informisanja Republike Srbije</a> i  Japanska
                                            fondacija iz Budimpešte.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
{{--                @endforeach--}}

                <div class="text-center">
                    <caption class=" mb-1">Dečji klub</caption>

                    <!-- Button trigger modal -->
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">
                        <img class="img-fluid slika rounded" src="{{asset("images/setnja.jpg")}}" />

                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold" id="exampleModalLongTitle">Dečji klub</h4>
                                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                        <span  aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-row text-start">
                                    <!-- <img class="img-fluid rounded" src="assets/img/onama1.jpg" /> -->
                                    <p>
                                        &#8226 Osnivanju Dečjeg kluba prethodili su projekti rada sa mladima koje je u Markovcu osmislila i
                                        izvela Umetnička grupa <a href="https://www.hop-la.org/">Hop.La! </a> – „Pozorište na selu“ (2019) i Letnji program seoskog
                                        kulturnog centra/Kulturna dostava (2020). <br/> <br/>
                                        &#8226 Klub je pokrenut i kontinuirano radi od jula 2021,
                                        najmanje dva puta nedeljno, i sastoji se od <span class="text-decoration-underline">dramskih, likovnih, čitalačkih, ekoloških, muzičkih</span>
                                        i drugih aktivnosti za decu predškolskog i školskog uzrasta, kroz koje se afirmiše  <span class="text-decoration-underline">
                                            kreativnost,
                                            ravnopravnost, sloboda, kritičko mišljenje, ekološka i građanska svest.</span>
                                        <br/>
                                        <br/>
                                        &#8226
                                        Radionice se odvijaju
                                        u prostoru domaćinstva Nade Babić, u Domu kulture Markovac, i u javnim prostorima
                                        Markovca i okoline – budući da su istraživačke šetnje omiljena aktivnost članova Dečjeg
                                        kluba.
                                        <br/>
                                        <br/>
                                        &#8226
                                        U radu Dečjeg kluba do sada su učestvovali, u svojstvu saradnika: Anđelka Nikolić (pozorišna
                                        rediteljka), Aleksandra Miladinović (psihološkinja), Petar Lukić (glumac i dramski pedagog),
                                        Magdalena Burhan (violistkinja), Snežana Grozdanović (slikarka), Uroš Stojiljković (slikar),
                                        Marko Vasiljević (slikar), Marija Krasić (arhitekta), Snežana Stojanović (filološkinja), Katarina
                                        Stojadinović (dizajnerka enterijera), Adrijana Simović (kostimografkinja). Posebni značaj ima
                                        učešće roditelja i drugih članova porodica dece – polaznika u aktivnostima kluba.
                                        Preko 50 dece iz Markovca i okoline do sada je uzelo učešća u pedagoškim aktivnostima
                                        Seoskog kulturnog centra.
                                        <br/>
                                        &#8226 Tokom leta radujemo se druženju sa decom koja žive u
                                        inostranstvu, i koriste raspust da posete bake i deke i učestvuju u našim aktivnostima.
                                        Važan partner Dečjeg kluba je OŠ „Drugi šumadijski odred“, sa kojom neretko zajedno
                                        organizujemo dešavanja – radionice u Čitaonici „Ekatarina Pavlović“ ili školskoj biblioteci.
                                        Bliski susret sa radom Dečjeg kluba meštanke i meštani Markovca imaju prilikom javnih
                                        prezentacija rada Kluba, kao što je izvođenje predstave „17 izgovora za kašnjenje u školu“ ili
                                        izložbe dečjih radova u Domu kulture.
                                        <br/>
                                        <br/>
                                        &#8226
                                        Podršku radu Dečjeg kluba do sada su pružili <a href="https://www.kultura.gov.rs/">Ministarstvo kulture i informisanja </a>,<a href="https://tragfondacija.org/"> Fondacija
                                        Trag</a> i <a href="https://www.divac.com/rs/Naslovna">Fondacija Ana i Vlade Divac</a>.
                                        Poziv za prijem novih članova stalno je otvoren!
                                    <br/><a class="text-decoration-underline" href="https://docs.google.com/forms/d/1VYV0oKT1Ad_O2QKbbEAXvjNd5k5OEppgDpg5Lri2dW0/"> Klikom na ovaj link možete da izvršite prijavu! </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center">
                    <caption class=" mb-1">Čitaonica "Ekatarina Pavlović"</caption>

                    <!-- Button trigger modal -->
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalLong3">
                        <img class="img-fluid slika rounded" src="{{asset("images/crnac.jpg")}}" />

                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold" id="exampleModalLongTitle">Čitaonica "Ekatarina Pavlović"</h4>
                                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                        <span  aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-row text-start">
                                    <!-- <img class="img-fluid rounded" src="assets/img/onama1.jpg" /> -->
                                    <p>
                                        &#8226
                                        7. jula 2020. otvorena je <span class="text-decoration-underline">Čitaonica „Ekatarina Pavlović“</span> u prostoru seoskog domaćinstva
                                        u Markovcu kod Velike Plane, na inicijativu Umetničke grupa <a href="https://www.hop-la.org/">Hop.La!</a> i neformalne grupe
                                        Seoski kulturni centar Markovac.
                                        <br/> <br/>
                                        &#8226
                                        Ekatarina Pavlović bila je prva pismena Markovčanka, koja je živela u vreme kada
                                        ženska deca nisu pohađala školu. Devojčice su, naime, u ovom selu tek 1887. godine
                                        dobile pravo na obrazovanje, skoro 50 godina nakon dečaka. Obrazovanje je dugo bilo
                                        privilegija kako muškaraca, tako i imućnijeg sloja, a Ekatarina je imala povlašćeni status,
                                        kao supruga učitelja.
                                        <br/> <br/>
                                        &#8226
                                        Čitaonica „Ekatarina Pavlović“ podseća na istorijat rodne i socijalne nepravde u oblasti
                                        obrazovanja i kulture, i zato su u njoj podjednako zastupljene knjige autorki i autora.
                                        <br/> <br/>
                                        &#8226
                                        Izborom naslova teži se izbegavanju sterotipija kada je reč o rodnim ulogama i
                                        odnosima, ili spram njih postoji kritički odnos (barem u odnosu na vreme u kome je
                                        knjiga nastala). Kritički se odnosimo i prema literaturi koja neguje nacionalizam,
                                        kolonijalizam, ksenofobiju, i svaki drugi vid diskriminacije. <span class="text-decoration-underline">Članstvo je dobrovoljno i
                                            besplatno</span>. Postoji i polica za deljenje knjiga i udžbenika.
                                        <br/> <br/>
                                        &#8226
                                        Osim kontinuiranog izdavanja knjiga, Čitaonica deluje kroz program biblioterapije,
                                        odnosno kroz istraživački rad usmeren na skretanje pažnje na rad nepravedno
                                        zapostavljenih autorki. Prva aktivnost na ovom polju je rad „Građanke i građani“ Anđelke
                                        Nikolić o Albini Podgradskoj, zaboravljenoj autorki prvog dramskog komada na našem
                                        jeziku, koji je objavljen u Zborniku Sterijinog pozorja „Na marginama dramske baštine“-
                                        <br/> <br/>
                                        &#8226
                                        Čitaonica deluje na dve lokacije: u domaćinstvu Nade Babić (Nikole Pašića 52) i u Domu
                                        kulture Markovac (kancelarija Matičara).
{{--                                        Radno vreme:--}}
{{--                                        na lokaciji Dom kulture: subota 11 do 14h, utorak 15 do 18h--}}
{{--                                        na lokaciji domaćinstvo Nade Babić: u vreme rada Dečjeg kluba, ili po dogovoru.--}}
{{--                                        Bibliotekarke: Aleksandra Miladinović, Anđelka Nikolić, Jelena Marković, Marija Savić,--}}
{{--                                        Nelica Stojadinović.--}}
{{--                                        U prvoj godini rada u Čitaonici su radili i Filip Miladinović i Ivana Stojanović.--}}
                                        <br/>
                                        &#8226         Dizajn elektronskog kataloga: Saša Kojadinović
                                        <br/> <br/>
                                        &#8226
                                        <span class="fw-bold">Donatori knjiga </span>: izdavačke kuće Kontrast, Kreativni centar, Studentski kulturni centar
                                        Novi Sad, Radni sto, Propolis Books; Sterijino pozorje, Malo pozorište „Duško Radović“ i
                                        Ambasada Angole, Biblioteka „Dimitrije Tucović“ Lazarevac, OŠ „Drugi Šumadijski
                                        odred“, Anđelka Nikolić, Aleksandra Miladinović, Ana Petrović, Jasminka Petrović, Sonja
                                        Ćirić, Draga Ćirić, Gorica Stevanović, Irena Ristić, Jelena Marković, Katarina
                                        Stojadinović, Ksenija Krnajski, Ljubinka Brezojević, Milanka Brkić, Milica Milutinović,
                                        Milica Nikolić, Nataša Ilić, Nikolina Nešić, Andrea i Jovan Petrović, Milena Depolo, Saša
                                        Kojadinović, Saša Perić, Slađana Lazarević i Željko Anđelković, Slavica Milovanović,
                                        Snežana Stojanović, Stefa Bećarević, Slobodan Kaluđerović, Tamara Tošić, Taša
                                        Kaluđerović, Tijana Grumić i Čitaonica Irig, Dragana Vasić, Ana Vilenica, Violeta
                                        Goldman, Viktor Makrin, Jakša Kragulj, Dušica Sinobad i Goran Tomić, Danijela
                                        Zamboni, Žarko Sivčev, Marijana Petrović, Jana Škobić, Jagoda Pavlović, Jelena Matić,
                                        Dejan Matić, Tanja Ignjatović, Miroslav Živanović
                                        <br/> <br/>
                                        &#8226
                                        Osnivanje Čitaonice i njen rad podržali su <a href="https://tragfondacija.org/">Trag fondacija</a> i <a href="https://www.rwfund.org/"> Rekonstrukcija Ženski fond </a>.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center">
                    <caption class=" mb-1">Terapija kulturom</caption>

                    <!-- Button trigger modal -->
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModalLong4">
                        <img class="img-fluid slika rounded" src="{{asset("images/terapija.jpg")}}" />

                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold" id="exampleModalLongTitle">Terapija kulturom</h4>
                                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                        <span  aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-row text-start">
                                    <!-- <img class="img-fluid rounded" src="assets/img/onama1.jpg" /> -->
                                    <p>
                                        &#8226 <span class="fw-bold">Projekat “Terapija kulturom“</span> nastao je iz potrebe da se ublaže negativne posledice
                                        pandemije na mentalno zdravlje. Inicirala ga je Aleksandra Miladinović, diplomirana
                                        psihološkinja i edukantkinja porodične psihoterapije, a realizuje se u saradnji sa drugim
                                        članicama SKCM-a.
                                        <br/> <br/>
                                        &#8226
                                        <span class="text-decoration-underline fw-bold">Biblioterapija predstavlja</span> uticaj književnih dela na psihičko blagostanje. Čitanjem i
                                        analizom književnih dela, vođeni biblioterapeutom učesnici bolje spoznaju sebe, poistovećuju se
                                        sa događajima i likovima, razgovaraju o osećanjima i dolaze do uvida o sopstvenim postupcima i
                                        emocijama.
                                        <br/>
                                        &#8226 Slušajući iskustva i teškoće drugih, korisnici razgovaraju o zajedničkim iskustvima i
                                        teškoćama, ali i o mogućim rešenjima problema.
                                        <br/>
                                        &#8226
                                        Biblioterapijske seanse i radionice namenjene
                                        su deci i odraslima, a koriste se u različitim sferama-u obrazovanju, bibliotekarstvu,
                                        zdravstvenim ustanovama ili preventivnoj zaštiti.

                                        <br/>  <br/>
                                        &#8226
                                        <span class="fw-bold text-decoration-underline">Terapija filmom </span> uključuje projekciju i razgovor o filmu. Nakon pogledanog filma učesnici u
                                        filmoterapiji razgovaraju o sopstvenim doživljajima filma, poredeći ih sa ličnim iskustvima.
                                        Imaju prilike da međusobno podele kako se osećaju, da te emocije zajedno razumeju i da iz njih
                                        nešto nauče.
                                        <br/> <br/>
                                        &#8226
                                        <span class="fw-bold text-decoration-underline"> Muzikoterapija </span> predstavlja skup različitih metoda i tehnika koje koriste zvuk i muziku u
                                        terapijske svrhe. Deluje na sveukupni razvoj, sazrevanje, unapređenje pažnje kod dece i razvoj
                                        socijalizacije. Na muzikoterapiji slušamo muziku, ali je i stvaramo-svojim telima ili
                                        instrumentima. Pokretanje projekta <span class="text-decoration-underline">Terapija kulturom</span> podržala je <a href="https://fjs.org.rs/">Fondacija Jelena Šantić</a>.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <hr class="m-auto" />

@endsection
