@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Grupni upis</h1>



                <form action="/csvupload" method="POST" enctype="multipart/form-data">
                    <label for="readers">Postavi .csv fajl za grupni upis članova</label>
                    <div class="row">
                        <div class="col-10">
                            @csrf

                            <input type="file" class="form-control rounded-pill" name="csv" id="readers">
                            <input type="hidden" name="category" value="Author">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-warning rounded-pill">Pošalji</button>
                        </div>
                    </div>
                </form>

                <p></p>
                <form action="/csvupload" method="POST" enctype="multipart/form-data">
                    <label for="readers">Postavi .csv fajl za grupni upis izdanja</label>
                    <div class="row">
                        <div class="col-10">
                            @csrf

                            <input type="file" class="form-control rounded-pill" name="csv" id="books">
                            <input type="hidden" name="category" value="Book">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-warning rounded-pill">Pošalji</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>
    </div>

    <script>

    </script>
@endsection
