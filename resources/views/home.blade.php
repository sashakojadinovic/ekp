@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">EKP KATALOG</div>

                    <div class="card-body">

                       <h4>Broj knjiga: {{$items_count}}</h4>
                       <h4>Broj donatora: {{$donators_count}}</h4>
                       <h4>Broj članova: {{$readers_count}}</h4>
                       <h4>Broj trenutno pozajmljenih knjiga: {{$borrowings_count}}</h4>
                       <p>Najzastupljeniji autor</p>
                       <p>Najčitaniji naslov</p>
                        <p>Najčitaniji autor</p>
                        <p>Najaktivniji član</p>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
