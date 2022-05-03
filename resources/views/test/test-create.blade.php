@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="mt-3 text-center">Masovni unos knjiga iz .csv fajla</h1>

                <form action="/tests" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <form action="#">
                                <input type="file" class="form-control rounded-pill" name="csv" id="csv">
                                <button class="mt-3 btn btn-warning rounded-pill">Pošalji</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
