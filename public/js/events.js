window.onload = function() {
    $(".delete").click(obrisi);
    $('#search').keyup(search)

}
const token = $('meta[name="csrf-token"]').attr('content');

function search(){
    let value=this.value
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: "/events",
        method: "GET",
        data: {"value":value},
        dataType: "json",
        success: function(data){
            console.log(data)
            events(data.events, data.event)
        },
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
            }
            alert(xhr.responseText)
        }
    })

}

function obrisi(){
    let value=confirm("Da li ste sigurni da zelite da obrisete?");
    if(value){
        let id=this.dataset.id;
        let url="/events/"+id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: url,
            method: "DELETE",
            data: {},
            dataType: "json",
            success: function(data){
                if(data.neuspeh){
                    alert(data.neuspeh)
                }
                else{
                alert(data.uspeh)
                console.log(data.events, data.event)}
                events(data.events, data.event)
                // window.location=data.url;
            },
            error: function(xhr, data) {
                console.error(xhr.responseText);
                console.error(xhr.status)
                if (xhr.status == 404) {
                    console.log("404")
                }
                alert(xhr.responseText)
            }
        })
    }
}

function events(events,event){
    let html=`<tr class="bg-secondary">  <td class="text-light">${event.id}</td>
                        <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="images/posters/${event.coverImg}"></td>
                        <td class="text-light">${event.title}</a></td>
                        <td class="text-light">${event.desc}</td>
                        <td class="text-light">${event.date}</td>
                        <td class="text-light">${event.project.name}</td>
                        <td colspan="2"> <button class="btn border-light px-2 py-0 btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample${event.id}" aria-expanded="false" aria-controls="collapseExample">
                                Sve slike za ovaj događaj
                            </button>                               </td>  <td><a class="px-2 py-0 btn border-light btn-success" href="/events/${event.id}/edit">Izmeni</a></td>
                        <td><a data-id="${event.id}" class=" px-2 py-0 btn border-light btn-danger delete">Obriši </a></td>
                        <td ><p class="alert alert-light text-center  fw-bold">Postavljeno na početnu</p></td>
                       </tr>

                    <tr class="">
                        <td colspan="11">
                            <div class="collapse text-end" id="collapseExample${event.id}">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 row-cols-xl-6">`
    for(p of event.photos){
    html+=`<div class="col">
<img class="img img-thumbnail " src="/images/gallery/mala${p.image}"></div>`}
    if(event.photos.length==0){
        html+=`</div> <small class=" my-auto">Nema slika još uvek. Dodajte. </small>`
    }
    html+=`<a class=" my-auto btn btn-outline-success text-end" href="/photosShow/${event.id}">Izmeni slike za ovaj dogadjaj</a>
                            </div>
                        </td></tr>`


    for(e of events){
        html+=`
                  <tr class="">  <td >${e.id}</td>
                        <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="images/posters/${e.coverImg}"></td>
                        <td >${e.title}</a></td>
                        <td >${e.desc}</td>
                        <td >${e.date}</td>
                        <td>${e.project.name}</td>
                        <td colspan="2"> <button class="btn px-2 py-0 btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample${e.id}" aria-expanded="false" aria-controls="collapseExample">
                                Sve slike za ovaj događaj
                            </button>                               </td>  <td><a class="px-2 py-0 btn border-light btn-outline-success" href="/events/${e.id}/edit">Izmeni</a></td>
                        <td><a data-id="${e.id}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>

                            <td><a href="main/${e.id}" class="px-2 py-0 btn btn-outline-info">Za početnu</a></td>
                        </tr>
  <tr class="">
                        <td colspan="11">
                            <div class="collapse text-end" id="collapseExample${e.id}">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 row-cols-xl-6">`
        for(p of e.photos){
            html+=`
    <div class="col">
                                            <img class="img img-thumbnail " src="/images/gallery/mala${p.image}"></div>
    `}
        if(e.photos.length==0){
            html+=` </div> <small class=" my-auto">Nema slika još uvek. Dodajte. </small>`
        }
        html+=`<a class=" my-auto btn btn-outline-success text-end" href="/photosShow/${e.id}">Izmeni slike za ovaj dogadjaj</a>
                            </div>
                        </td></tr>`
    }

$("#html").html(html)
$(".delete").click(obrisi);
}
