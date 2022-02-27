@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Test</h1>

                <form action="/books" method="POST">
                    @csrf
                    <div class="row">
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="author-id">Autori: </label>

                            <input class="form-control bg-white rounded-pill" type="text" data-model="Author" name="author"
                                id="author-id">
                        </div>
                        <div class="my-2 col-md-6">
                            <label class="form-label" for="donator-id">Donatori: </label>
                            <input class="form-control bg-white rounded-pill" type="text" data-model="Donator" name="donator"
                                id="donator-id">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('donator-id').addEventListener('input', (e) => getData(e.target, 'Donator'));
            document.getElementById('author-id').addEventListener('input', (e) => getData(e.target, 'Author'));
        });
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

    </script>
@endsection
