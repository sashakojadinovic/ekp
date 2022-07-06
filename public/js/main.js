window.onload = function() {
    if (this.innerHeight > 10) {
        $('header').addClass('scroll');

    }

    //show more
    $('#showMore').click(prikazi)
    //za galeriju
    if(window.location.href.includes("galerija")){
        $('.picture').click(allImages)
        $('.overlay').click(removeOverlay)
        $(window).keyup(function (e){
            if(e.key=="Escape" && $('#carouselExampleControls').hasClass("d-block"))
                removeOverlay()
        });
    }
    if(window.location.href.includes("vesti")) {
        $('#dates').click(paginacija)
        $('.pag').click(paginacija)
        $('.kat').change(kat)


    }
    if(window.location.href.includes("knjige")) {
        $('.search').keyup(filter)
        $('.searchAuthor').keyup(filter)
        $('.available').change(filter)
        $('.category').change(filter)
        $('.pag').click(paginacija)

    }

    $(window).scroll(function() {
        // if(window.location.href(includes()))
        if (this.scrollY < 750) {

            callBackAjax("/count", "GET", {}, function(data){
                function tajmer(i, number, div) {
                    setInterval(() => {
                        if (i <= number) {
                            $(div).html(i)
                        }
                        i++
                    })
                }
                tajmer($(".citalac").text(),data.readers, ".citalac")
                // tajmer($(".citalac").text(),360, ".citalac")
                tajmer($(".knjige").text(), data.books, ".knjige")
                // tajmer($(".knjige").text(),2560, ".knjige")
                // tajmer($(".desavanja").text(),data.events , ".desavanja")

                tajmer($(".desavanja").text(), 90 , ".desavanja")

                tajmer($(".deca").text(), 60, ".deca")


            }, true)


        }



        if (this.scrollY < 10) {
            $('header').removeClass("scroll");
            //     $('a').hover(function() {
            //         $(this).css('color', '#b18e75')
            //     }, function() {
            //         $(this).css('color', '#232f28')
            //     })
            //
        } else {
            $('header').addClass('scroll')
            //     $('a').hover(function() {
            //             $(this).css('color', '#cdc0aa')
            //         },
            //         function() {
            //             $(this).css('color', '#232f28')
            //         }
            //
            //     )
            //
            //
        }
    })
}
const token = $('meta[name="csrf-token"]').attr('content');

function prikazi(e){
    e.preventDefault()
    $("#prikazi").slideToggle("slow");
    console.log( $(this).text())
    if( $(this).text()=="Prikaži manje"){
        $("#showMore").text("Prikaži više")

    }
    else{
        $("#showMore").text("Prikaži manje")

    }
}

function dates(pag){
    let page=1;
    let value=true;
    let kat=$('.kat').val();
    console.log(pag)
    if($.isNumeric( pag )){
        page=pag
        value=false
    }
    else if(pag!="kat"){
        if($('#filter').val()=="all"){
            $('#filter').val("nearest")
        }
        else{
            $('#filter').val("all")
        }
    }
    let date=$("#filter").val();
    callBackAjax("/vesti", "GET",{"page":page,  "date":date, "kat":kat}, function success(data){
        console.log(data)
        events(data, value)}, true)
}


function events(events, value){
    let html=``
    if(events.data.length==0){
        html="<h1>Za izabranu kategoriju nema rezultata.</h1>"
        $('#events').html(html)
        paginationPrevNext(events)


    }
    else {
        for (e of events.data) {
            html += ` <div class="card d-flex flex-row flex-lg-nowrap flex-xl-nowrap flex-wrap  shadow">
                        <img class="img-fluid galleryOne" src="images/posters/${e.coverImg}" alt="${e.title}">
                        <div class="card-body">
                            <h5 class="card-title  fw-bold">${e.title}</h5>
                            <p class="card-text">${e.desc}</p>
                           <small class="text-muted">Datum održavanja: </small> <p class="card-text">${e.date}</p>
                                       <small class="text-decoration-underline">${e.project.name}</small>

                        </div>
                    </div>`
        }

        $('#events').html(html)
        paginationPrevNext(events)

    }
    if (value) {
        if ($('#filter').val() == "all") {
            $('#tekst').text("Prikazani su samo događaji koji slede")
            $('#dates').text("Prikaži sve vesti i sve događaje")
        } else {

            $('#tekst').text("Prikazane su sve vesti i svi događaji")
            $('#dates').text("Prikaži samo događaje koji slede")
        }
    }

}

function removeOverlay(){
    $('.overlay').css("display", "none")
    $('#carouselExampleControls').removeClass("d-block")
    $('#carouselExampleControls').addClass("d-none")
    $('.carousel-item').removeClass("active")
}


function allImages(e){
    e.preventDefault()
    let id=this.dataset.id
    $('#carouselExampleControls').removeClass("d-none")
    $('#carouselExampleControls').addClass("d-block")
    $('.overlay').css("display", "block")
    $('#'+id).addClass("active")
}

function  imageCarousel(data,id){
    $('#carouselExampleControls').removeClass("d-none")
    $('#carouselExampleControls').addClass("d-block")


}

function callBackAjax(url, method, data, success, forImage) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: url,
        processData: forImage,
        contentType: false,
        method: method,
        data: data,
        dataType: "json",
        success: success,
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
                // window.location.href = "404.php"
            }
            alert(xhr.responseText)
        }
    })
}

function paginacija(e){
    e.preventDefault();
    let id=this.id
    console.log(id)
    dates(id)
}
function kat(){
    dates("kat")
}

function filter(pag){
    let page=1;
    if($.isNumeric( pag )){
        page=pag
    }

    let value=$(".search").val();
    let valueAuthor=$(".searchAuthor").val();
    let category=$(".category").val();
    let available=$("#gridCheck").is(':checked');
    console.log(value)
    console.log(valueAuthor)
    console.log(category)
    console.log(available)
    callBackAjax("/filterBooks", "GET",{"page":page, "value":value, "valueAuthor":valueAuthor, "category":category, "available":available}, function success(data){
        console.log(data)
        books(data)
    })
}

function books(books){
    console.log(books.data)
    let html=``
    if(books.data.length==0){
        console.log("Ti")
        html="<h1>Nema rezultata.</h1>"
        $('#books').html(html)

    }
    else {
        for (b of books.data) {
            html += `  <div class="col">
            <div class="card h-100">
                <img src="${b.img_url}" class="card-img-top" alt="${b.title}">
                <div class="card-body">
                    <h5 class="card-title">${b.title}</h5>
                    <h6 class="card-title">`
            for(a of b.authors) {
                html+=`${a.name}`
            }
            html+=`</h6>
                    <p class="card-text">${b.info}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Broj dostupnih primeraka u čitaonici: </small> <span>${b.items_count-b.borrows_count}</span>
                </div>
            </div>
        </div>`
        }

        $('#books').html(html)
        paginationPrevNext(books)


    }}

function paginationPrevNext(table){
    let next;
    let prev;
    if (table.current_page + 1 <= table.last_page) {
        next = table.current_page + 1;
    } else {
        next = table.last_page;
    }
    if (table.current_page - 1 >= 1) {
        prev = table.current_page - 1;
    } else {
        prev = 1;
    }
    html = ` <li class="page-item">
                        <a class="page-link pag" id="${prev}" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Prethodna</span>
                        </a>
                    </li>`
    for (let i = 1; i <= table.last_page; i++) {
        html += `<li class="page-item"><a href="#" id="${i}" class="page-link pag">${i}</a></li>
`
    }
    html += ` <li class="page-item">
                        <a class="page-link pag" id="${next}" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Naredna</span>
                        </a>
                    </li>`

    $('#pag').html(html)
    $('.pag').click(paginacija)


}
