<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Footer;
use App\Model_Dependency;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;


class FooterController extends Controller
{
  
  public function editFooter()
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      $data = Footer::first();
      return view('admin.footer.update_footer')->with('data' , $data);
  }

  public function updateFooter(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
      return redirect('/admin/footer');
    }

    $this->validate($request, 
    [
        'input_footer_email' => 'email',
    ],
    [
        'input_footer_email.email' => 'lütfen geçerli eposta adresini giriniz!! ',
    ]);

    if($request['footer_id'] == 0)
    {
      $footer = new Footer();
    }
    else
    {
      $footer = Footer::where('id', $request['footer_id'])->first();
    }      

    $footer->whatsapp = $request['input_footer_whatsapp'];
    $footer->phone = $request['input_footer_phone'];
    $footer->email = $request['input_footer_email'];
    $footer->address = $request['input_footer_address'];
    $footer->facebook = $request['input_footer_facebook'];
    $footer->twitter = $request['input_footer_twitter'];
    $footer->instagram = $request['input_footer_instagram'];
    $footer->linkedin = $request['input_footer_linkedin'];
    $footer->kvkk_title = $request['input_footer_kvkk_title'];
    $footer->kvkk_link = $request['input_footer_kvkk_link'];
    $footer->isortaklari_title = $request['input_footer_isortaklari_title'];
    $footer->isortaklari_link = $request['input_footer_isortaklari_link'];
    $footer->partnerler_title = $request['input_footer_partnerler_title'];
    $footer->partnerler_link= $request['input_footer_partnerler_link'];
    $footer->kariyer_title = $request['input_footer_kariyer_title'];
    $footer->kariyer_link= $request['input_footer_kariyer_link'];

    $footer->save();    
    
    return redirect('/admin/footer')->with( 'flash_message_success' , $request['input_footer_name'].' footer, başarıyla kaydedildi!!');;

  }

}
