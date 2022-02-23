function showList(elm,data){
    if(document.querySelector('.autocomplete')){
        document.querySelector('.autocomplete').remove();
    }

    const listContainer = document.createElement('ul');
    listContainer.className="autocomplete mt-1 list-group";
    //elm.addEventListener('change',(e)=>listContainer.remove());

    data.forEach(element => {
        const listItem = document.createElement('li');
        listItem.className="list-group-item list-group-item-action"
        listItem.dataset.id=element.id;
        listItem.addEventListener('click',e=>{
            //e.stopPropagation();
            elm.value="";
            listContainer.remove();
            createBadge(element.name,element.id,elm);
        });
        listItem.innerHTML = element.name;
        listContainer.appendChild(listItem);
        elm.parentNode.insertBefore(listContainer,elm.nextSibling);
        //console.log(element.name)
    });

}
function createBadge(name, id, elm) {
    const elSpan = document.createElement('span');
    elSpan.className = "badge rounded-pill bg-secondary fs-6 fw-normal mx-1 mb-1";
    elSpan.innerHTML = name + " x";
    elSpan.setAttribute('id', 'donator' + id);
    elSpan.addEventListener('click', function(e) {
        //document.getElementById('donators-list').value = null;
        e.target.remove();
    })
    elm.parentNode.insertBefore(elSpan,elm);

}
function getData(elm, model) {
    if(elm.value.length<3){
        if(document.querySelector('.autocomplete')){
            document.querySelector('.autocomplete').remove();
        }
        return;
    }
    axios.get('/autocomplete-search', {
            params: {
                m: model,
                q: elm.value
            }
        })
        .then(res =>showList(elm,res.data) );
}
