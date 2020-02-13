<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Redirect;
use Carbon\Carbon;
use App\Portfolio;
use App\Gallery;
use App\Gallery_Image;
use Session;

class GalleryController extends Controller
{
    public function indexGallery()
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        $data = Gallery::latest()->paginate(5);
        // echo '<pre>';
        // print_r($data);
        // die;
        return view('admin.gallery.index_gallery' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);        
    }
}
