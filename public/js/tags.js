window.onload = function() {
    $("#dodajTag").click(dodaj);

}
const token = $('meta[name="csrf-token"]').attr('content');

function dodaj(){
    let value=$('#tag-name').val()
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: "/addTag",
        method: "post",
        data: {'name':value},
        dataType: "json",
        success: function(data){
            tags(data)
            // window.location=data.url;
        },
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
            }
            if (xhr.status == 422) {
                console.log(xhr.responseJSON.errors)
                alert(xhr.responseJSON.errors.name[0])
                $('#tag-name').val("")
            }
            // alert(data)
        }
    })
}

function tags(tags){
    let html=""
    for(t of tags){
        html+=`  <div class="form-check-inline">
                                <input class="form-check-input" name="tags[]" type="checkbox" value="${t.id}" id="defaultCheck${t.id}">
                                <label class="form-check-label" for="defaultCheck${t.id}">
                                    ${t.name}
                                </label>
                            </div>`
    }
    $("#html").html(html)
}
