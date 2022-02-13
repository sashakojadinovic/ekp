@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-3 text-center">Upiši novo izdanje</h1>

                <form action="/books" method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="form-label" for="book-title">Naslov</label>
                        <input class="form-control bg-white" type="text" name="title" id="book-title">
                    </div>
                    <div class="my-2">
                        <label  class="form-label" for="donator-id">Donatori: </label>
                        <input class="form-control bg-white" type="text" name="donator" id="donator-id">
                    </div>
                    <div class="my-2">
                        <label class="form-label" for="book-info">Opis</label>
                        <textarea class="form-control bg-white" name="info" id="book-info" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/books" class="btn btn-outline-dark  mt-2"><i class="bi bi-x-circle"> </i> Odustani</a>
                        <button type="submit" class="btn btn-outline-dark mt-2 mx-1"><i class="bi bi-cloud-arrow-up"> </i>
                            Sačuvaj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const inputElement = document.getElementById('donator-id');
            axios.get('/autocomplete-search', {
                    params: {
                        m: "Donator",
                        q: ""
                    }
                })
                .then(function(res) {
                    const datasrc = res.data.map(function(item) {
                        return {
                            label: item.name,
                            value: item.id
                        };
                    });
                    console.log(datasrc)
                    const ac = new Autocomplete(inputElement, {
                        data: datasrc,
                        onSelectItem: ({label,value})=>{
                            console.log("Selected item has value: "+value);
                            inputElement.value="";
                            document.getElementById('donator-id').before(createBadge(label));

                        }
                    });
                });
        });
        function createBadge(title){
            const elSpan = document.createElement('span');
            elSpan.className ="badge rounded-pill bg-secondary fs-6 fw-normal mx-1 mb-1";
            elSpan.innerHTML =title+ " x";
            elSpan.addEventListener('click',function(e){
                e.target.remove();
            })
            return elSpan;

        }
    </script>
@endsection
