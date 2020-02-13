<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Filter;
use App\Site_Content_Head;
use App\Site_Content_Item;

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
      
    return view('pages.who-we-are')->with(
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
      
    return view('pages.work-samples')->with(
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
