window.onload = function() {
    $(".delete").click(obrisi);
}
const token = $('meta[name="csrf-token"]').attr('content');

function obrisi(){
    let value=confirm("Da li ste sigurni da zelite da obrisete?");
    if(value){
        let id=this.dataset.id;
        let url="/blogs/"+id;
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: url,
            method: "DELETE",
            data: {},
            dataType: "json",
            success: function(data){
                alert(data.uspeh)
                blogs(data.blogs)
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

function blogs(blogs){
    let html=""
    for(b of blogs){
        html+=`
        <tr class="">
            <td>${b.id}</td>
            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="/images/blogs/${b.image}"></td>
            <td>${b.title}</a></td>
        <td>${b.short_desc}</a></td>
        <td>`


        jQuery.each(b.tags, function (key, value) {
            html+=` <small> ${value.name}
`
            if( key+1 != b.tags.length ) {
                html+=`,`

            }        html+=`</small>`
        })
            html+=`</td>
        <td><a class="px-2 py-0 btn btn-outline-success" href="/blogs/${b.id}/edit">Izmeni</a></td>

        <td><a data-id="${b.id}" class=" px-2 py-0 btn btn-outline-danger delete">Obriši </a></td>
    </tr>`
    }
    $("#html").html(html)
    $(".delete").click(obrisi)
}
