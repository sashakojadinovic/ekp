@extends("site.layout")
@section("title", "Seoski kulturni centar - Kontakt")
@section("content")
    <div class="wave mt-4 ">
        <div class="m-4 col-lg-6 col-xl-5 col-8 m-auto ">
            <h1>Forma za slanje maila</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
            @endif
        <form action="/sentMail" method="post">
            @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email adresa</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="email@primer.com">
        <small class="">Vaš mail na koji možemo da Vam odgovorimo.</small>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Tekst poruke</label>
        <textarea class="form-control" name="tekst" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
            <div class="">
                <button type="submit" class="btn btn-site mb-3">Pošalji mail</button>
            </div>
        </form>
        </div>
@endsection
