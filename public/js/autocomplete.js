const hiddens = {};
document.addEventListener('keydown', e => {
    if (e.key === "Escape") {
        if (document.querySelector('.autocomplete')) {
            document.querySelector('.autocomplete').remove();
        }
    }
});
document.addEventListener('click', e => {
    if (document.querySelector('.autocomplete')) {
        document.querySelector('.autocomplete').remove();
    }
});
/* document.getElementById('author').addEventListener('keydown', e => {
    if (e.key === "ArrowDown") {
        const drop = document.querySelector('.autocomplete');
        console.log(drop.firstChild);
        drop.firstChild.focus();
    }
}); */
function showList(elm, data) {
    if (document.querySelector('.autocomplete')) {
        document.querySelector('.autocomplete').remove();
    }

    const listContainer = document.createElement('ul');
    listContainer.className = "autocomplete mt-1 list-group position-absolute top-100 w-100 pe-0 z-index-3 border";
    listContainer.addEventListener('keydown', e => {
        switch (e.key) {
            case "ArrowUp":

                break;
        }
    })

    data.forEach((element, index) => {
        const listItem = document.createElement('li');
        listItem.role = "button";
        listItem.className = "list-group-item list-group-item-action";
        listItem.dataset.id = element.id;
        const value = Object.keys(element)[1];
        listItem.addEventListener('click', e => {
            elm.value = "";
            listContainer.remove();
            createBadge(element[value], element.id, elm);
        });
        listItem.innerHTML = element[value];
        listContainer.appendChild(listItem);
        elm.parentNode.insertBefore(listContainer, elm);
    });

}
function createBadge(name, id, elm) {  //name - name in DB, id - ID in DB, elm - target element (author, category or publisher)
    console.log(name);
    if(name==='' || id===''){
        return;
    }
    if (!hiddens[elm.id]) {
        hiddens[elm.id] = [];
    }
    const elSpan = document.createElement('span');
    elSpan.className = "badge rounded-pill bg-dark fs-6 fw-normal";
    elSpan.innerHTML = name + " x";
    elSpan.setAttribute('id', 'donator' + id);
    elSpan.addEventListener('click', function (e) {
        e.target.remove();
        hiddens[elm.id] = hiddens[elm.id].filter(e => e !== id);
        document.getElementById(elm.id + '-array').value = hiddens[elm.id];
    })
    //console.log(document.getElementById(elm.id+'-array'));
    hiddens[elm.id].push(id);
    document.getElementById(elm.id + '-array').value = hiddens[elm.id];
    elm.parentNode.insertBefore(elSpan, elm);

}
function getData(elm, model, field) {
    const f = field || 'name';
    if (elm.value.length < 2 && document.querySelector('.autocomplete')) {
        document.querySelector('.autocomplete').remove();
        return;
    }
    axios.get('/autocomplete-search', {
        params: {
            m: model,
            f: f,
            q: elm.value
        }
    })
        .then(res => {
            //console.log(res.data);
            showList(elm, res.data);

        });
}
