window.onload = function() {
    $(".delete").click(obrisi);

}
const token = $('meta[name="csrf-token"]').attr('content');

function obrisi(){
    let value=confirm("Da li ste sigurni da zelite da obrisete?");
    if(value){
        let id=this.dataset.id;
        let url="/donors/"+id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: url,
            method: "DELETE",
            data: {},
            dataType: "json",
            success: function(data){
                alert(data.uspeh)
                donors(data.donors)
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

function donors(donors){
    let html=""
    for(d of donors){
        html+=`      <tr class="text-center">
                            <td>${d.id}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="/images/donors/${d.image}"></td>
                            <td>${d.name}</a></td>
                            <td><a target="_blank" href="${d.link}">Klik ka njihovom sajtu</a></td>
                            <td>`
                            if(d.donor_partner==0){
                                html+=`Partner`
                            }
                            else{
                                html+=`Donator`

                            }

    html+=`   </td>
                            <td><a class="px-2 py-0 btn btn-outline-success" href="/donors/${d.id}/edit">Izmeni</a></td>
                            <td><a data-id="${d.id}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                        </tr>`
    }


    $("#html").html(html)
    $(".delete").click(obrisi)

}

