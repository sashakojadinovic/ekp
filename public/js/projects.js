window.onload = function() {
$(".delete").click(obrisi);

}
const token = $('meta[name="csrf-token"]').attr('content');

function obrisi(){
    let value=confirm("Da li ste sigurni da zelite da obrisete?");
    if(value){
        let id=this.dataset.id;
        let url="/projects/"+id;
        $.ajax({
    headers: {'X-CSRF-TOKEN': token},
    url: url,
    method: "DELETE",
    data: {},
    dataType: "json",
    success: function(data){
        alert(data.uspeh)
        projects(data.projects)
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

function projects(projects){
let html=""
    for(p of projects){
        html+=`  <tr>
                            <td>${p.id}</td>
                            <td>${p.name}</a></td>
                            <td><a class="px-2 py-0 btn btn-outline-success" href="/projects/${p.id}/edit">Izmeni</a></td>
                            <td><a data-id="${p.id}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
                        </tr>`
    }
    $("#html").html(html)
    $(".delete").click(obrisi);

}

