window.onload = function() {
    $('.search').keyup(filter)



}
function filter(pag){
    let page=1;
    console.log(pag)
    if($.isNumeric( pag )){
        page=pag
    }
    let value=$(".search").val();
    callBackAjax("/vesti", "GET",{"page":page, "value":value}, function success(data){
        console.log(data)
      //  books(data, value)}, true)
})}

    function paginacija(e){
        e.preventDefault();
        let id=this.id
        dates(id)
    }
