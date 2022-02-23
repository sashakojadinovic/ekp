const container = document.getElementById('author-container');
const author = document.getElementById('author');
const authors = document.getElementById('authors');
const formData = new FormData();
let authorsArray = [];
const config = {
    selector: '#author',
    data: {
        src: fetch('/api/search-author', {
                method: 'post',
                body: formData
            })
            .then(res => res.json())
            .then(data => data),
        keys: ["name"],
        cache: true
    },

    resultItem: {
        highlight: {
            render: true
        }
    }

}
let autoCompleteJS = new autoComplete(config);
document.querySelector("#author").addEventListener("selection", function(event) {
    if (authorsArray.includes(event.detail.selection.value.id)) {
        alert("Autor je već odabran");
        return;
    }
    console.log(event.detail.selection.value);
    author.value = event.detail.selection.value.name;
    const choosenAuthor = document.createElement('span');
    choosenAuthor.className = "choosen-author";
    choosenAuthor.setAttribute('data-authorid', event.detail.selection.value.id);
    choosenAuthor.innerHTML = event.detail.selection.value.name + ' (ID:' + event.detail.selection.value
        .id + ')';
    choosenAuthor.addEventListener('click', function(e) {
        e.target.remove();
        authorsArray = authorsArray.filter(item => item !== Number(e.target.dataset.authorid));
    });
    container.before(choosenAuthor);
    authorsArray.push(event.detail.selection.value.id);
    author.value = "";
    authors.value = authorsArray;

});
const btn = document.getElementById('add-new-author');
btn.addEventListener('click', function(e) {
    e.preventDefault();
    if (document.querySelector("#new-author").value.length < 3) {
        return;
    }
    const req = {
        name: document.querySelector("#new-author").value
    };
    fetch('/api/add-author-adhoc', {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(req)

        })
        .then(res => res.json())
        .then(data => addChoosenAuthor(data));

});

function addChoosenAuthor(author) {

    if (author === 1) {
        alert("Autor sa istim imenom je već upisan u bazu");
        document.querySelector("#new-author").value = "";
        return;
    }
    const choosenAuthor = document.createElement('span');
    choosenAuthor.className = "choosen-author";
    choosenAuthor.setAttribute('data-authorid', author.id);
    choosenAuthor.innerHTML = author.name + ' (ID:' + author.id + ')';
    container.before(choosenAuthor);
    authorsArray.push(author.id);
    authors.value = authorsArray;
    document.querySelector("#new-author").value = "";
    autoCompleteJS = new autoComplete(config);
}
