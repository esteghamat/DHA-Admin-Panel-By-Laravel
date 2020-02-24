<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Filter;
use App\Site_Config;
use App\Config_Type;
use App\Site_Content_Head;
use App\Site_Content_Item;
use App\Site_Contactus_Message;
use App\Footer;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SiteController extends Controller
{

  public function index()
  {
    // $işlerimiz = Portfolio::all();
    // $işlerimiz_count = $işlerimiz->count();

    $filters = Filter::all();
    $filters_count = $filters->count();

    $contentheads = Site_Content_Head::all();

    $contentitems = Site_Content_Item::orderBy('site_content_type_id', 'ASC')
                                     ->orderBy('custom_order' , 'ASC')
                                     ->get();

    return view('index')->with(
              [
                'filters' => $filters , 
                'filters_count' => $filters_count ,
                'contentheads' => $contentheads ,
                'contentitems' => $contentitems ,
              ]);
  }

  public function whoweare()
  {

    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
        $query->where('contenttype_slug','=','biz_kimiz');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','biz_kimiz');
    })->orderBy('custom_order' , 'ASC')->get(); 
      
    return view('pages.biz-kimiz')->with(
      [
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);
  }

  public function digitalrecetemiz()
  {

    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','dijital-recetemiz');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','dijital-recetemiz');
    })->orderBy('custom_order' , 'ASC')->get(); 
      
    return view('pages.digital')->with(
      [
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);
 
  }

  public function references()
  {

    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','referenslar');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','referenslar');
    })->orderBy('custom_order' , 'ASC')->get(); 
      
    return view('pages.references')->with(
      [
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);

  }

  public function blog()
  {

    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','blog');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','blog');
    })->orderBy('custom_order' , 'ASC')->get(); 
      
    return view('pages.blog')->with(
      [
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);

  }

  public function worksamples()
  {

    $filters = Filter::all();
    $filters_count = $filters->count();

    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','islerimiz');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','islerimiz');
    })->orderBy('custom_order' , 'ASC')->get(); 
      
    return view('pages.islerimiz')->with(
      [
        'filters' => $filters , 
        'filters_count' => $filters_count , 
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);

  }
  
  public function contact()
  {

    return view('pages.contact');

  }
  
  public function contactus_savemessage_sendemail(Request $request)
  {
    if($request->isMethod('get'))
    {
        return view('pages.contact');
    }

    $this->validate($request, 
    [
      'input_contactus_name' => 'required',
      'input_contactus_email' => 'required|email',
      'input_contactus_message_subject' => 'required',
      'input_contactus_message_text' => 'required',
    ],
    [
      'input_contactus_name.required' => 'lütfen adı girin!! ',
      'input_contactus_email.required' => 'lütfen e-posta girin!! ',
      'input_contactus_email.email' => 'lütfen doğru bir e-posta adresi girin!! ',
      'input_contactus_message_subject.required' => 'lütfen mesaj için bir başlık girin!! ',
      'input_contactus_message_text.required' => 'lütfen mesaj girin!! ',
    ]);

    $site_contactus_message = new Site_Contactus_Message();

    $site_contactus_message->contactus_name = $request['input_contactus_name'];
    $site_contactus_message->contactus_email = $request['input_contactus_email'];
    $site_contactus_message->contactus_phonenumber = $request['input_contactus_phonenumber'];
    $site_contactus_message->contactus_message_subject = $request['input_contactus_message_subject'];
    $site_contactus_message->contactus_message_text = $request['input_contactus_message_text'];

    $site_contactus_message->save(); 
    
    $data = array(
      'input_contactus_name' => $request['input_contactus_name'],
      'input_contactus_email' => $request['input_contactus_email'],
      'input_contactus_phonenumber' => $request['input_contactus_phonenumber'],
      'input_contactus_message_subject' => $request['input_contactus_message_subject'],
      'input_contactus_message_text' => $request['input_contactus_message_text'],
    );
    
    $configtype_email = Config_Type::where('configtype_title' , 'email')->first();
    if($configtype_email)
    {
      $configtype_email_id = $configtype_email->id;
    }
    else {
      $configtype_email_id = 0;
    }
    $receiver_contactus_email = Site_Config::where('configtype_id' , $configtype_email_id)
    ->where('config_title' , 'Bize ulaşın e-posta alıcısı')->first();

    if(isset($receiver_contactus_email))
    {
      $receiver_contactus_email_address = $receiver_contactus_email->config_value;
    }
    else {  
      $receiver_contactus_email_address = 'm.esteghamatdba@gmail.com';
    }

	Mail::to($receiver_contactus_email_address)->send(new SendMail($data));

    return back();//->with('success' , 'Bizimle iletişime geçtiğiniz için teşekkürler.');
    // return redirect('/contact')->with( 'flash_message_success' , 'mesajınız "' . $request['input_contactus_message_subject'].'" başarıyla gönderildi.');;

  }

  public function blogdetails($blog_slug)
  {
 
    $contentheads = Site_Content_Head::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','blog');
    })->first(); 

    $contentitems = Site_Content_Item::whereHas('site_content_type', function ($query) {
      $query->where('contenttype_slug','=','blog');
    })->orderBy('custom_order' , 'ASC')->get(); 

    return view('pages.blogs.blogdetails')->with(
      [
        'blog_slug' => $blog_slug, 
        'contentheads' => $contentheads , 
        'contentitems' => $contentitems , 
      ]);

  }

}
