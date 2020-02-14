@extends('layouts.siteLayouts.site_main')

@section('content')


        <div class="contact-header">
            <h1>Randevu</h1>
            <h6>Randevu için bilgileriniz ekleyin, bize göderin. Size enuygun zamanı belirleyelim</h6>
        </div>
        <!-- --------------------------Flash Message------------------------ -->
        @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block" style='margin-bottom: 0px'>
                <button type="button" id="button_message_error" class="close" data-dismiss="alert">×</button>	
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif    
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block" style='margin-bottom: 0px'>
                <button type="button" id="button_message_success" class="close" data-dismiss="alert">×</button>	
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif 
        <!-- --------------------------Form - Contact Us------------------------ -->
        <form class="form" method='POST' action="{{ url('/contact/send_email') }}" name="contact_send_email" id="contact_send_email" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="form-inputs">
                <div>
                  <input type="text" name="input_contactus_name" id="input_contactus_name" placeholder="Adınız ve Soyadınız..." required>
                  <span id="contactusName_msg" class="error_msg"></span>
                  @error('input_contactus_name')
                      <div class="error_msg">{{ $message }}</div>
                  @enderror
                </div>
                <div>
                  <input type="text" name="input_contactus_email" id="input_contactus_email" placeholder="Eposta Adresiniz..." required>
                  <span id="contactusEmail_msg" class="error_msg"></span>
                  @error('input_contactus_email')
                      <div class="error_msg">{{ $message }}</div>
                  @enderror
                </div>
                <div>
                  <input type="text" name="input_contactus_phonenumber" id="input_contactus_phonenumber" placeholder="Telefon Numaranız..." required>
                </div>
                <div>
                  <input type="text" name="input_contactus_message_subject" id="input_contactus_message_subject" placeholder="Konu Baslıgı..." required>
                  <span id="contactusMessageSubject_msg" class="error_msg"></span>
                  @error('contactus_message_subject')
                      <div class="error_msg">{{ $message }}</div>
                  @enderror
                </div>
                <div>
                  <textarea name="input_contactus_message_text" id="input_contactus_message_text" placeholder="Mesajınız..."></textarea>
                  <span id="contactusMessageText_msg" class="error_msg"></span>
                  @error('contactus_message_text')
                      <div class="error_msg">{{ $message }}</div>
                  @enderror
                </div>
            </div>
            <div class="form-submit"><button type="submit">GONDER</button></div>    
        </form>

@endsection