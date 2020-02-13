@extends('layouts.siteLayouts.site_main')

@section('content')


        <div class="contact-header">
            <h1>Randevu</h1>
            <h6>Randevu için bilgileriniz ekleyin, bize göderin. Size enuygun zamanı belirleyelim</h6>
        </div>
        <form action="" class="form">
            <div class="form-inputs">
                <div><input type="text" name="name" placeholder="Adınız ve Soyadınız..." required></div>
                <div><input type="text" name="email" placeholder="Eposta Adresiniz..." required></div>
                <div><input type="text" name="phonenumber" placeholder="Telefon Numaranız..." required></div>
                <div><input type="text" placeholder="Konu Baslıgı..." required></div>
                <div><textarea name="" id="" placeholder="Mesajınız..."></textarea></div>
            </div>
            <div class="form-submit"><button type="submit">GONDER</button></div>    
        </form>

@endsection