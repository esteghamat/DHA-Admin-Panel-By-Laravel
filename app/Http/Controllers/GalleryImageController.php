<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Redirect;
use Carbon\Carbon;
use App\Portfolio;
use App\Gallery;
use App\Gallery_Image;
use Session;

class GalleryImageController extends Controller
{
    public function indexInsertImage($id , $ref_title , $ref_type , $ref_display_type)
    {
        $gallery = Gallery::where('ref_id', $id)->first();
        if(!$gallery)
        {
            $gallery = new Gallery();
            $gallery->ref_id = $id;
            $gallery->ref_type = $ref_type;
            $gallery->ref_display_type = $ref_display_type;
            $gallery->gallery_image_count = 0;
            $gallery->save();    
        }

        $gallery_name = $ref_title;
        $gallery_image = Gallery_Image::where('gallery_id', $gallery->id)->get();
        return view('admin.gallery.index_insert_image_gallery')->with(['gallery'=>$gallery , 'gallery_image'=>$gallery_image , 'gallery_name'=>$gallery_name]);
    }

    public function insertImage(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
          $data = Portfolio::latest()->paginate(5);
          return view('admin.portfolio.index_portfolio' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);
        }

        $this->validate($request, 
        [
            'input_image_title' => 'required',
            'input_image_file_name' => 'required',
            'input_image_file_name.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'input_image_title.required' => 'lütfen görüntü başlığı girin!! ',
            'input_image_file_name.required' => 'lütfen Görüntü dosyası girin!! ',
            'input_image_file_name.image' => 'lütfen doğru biçimi girin!! ',
        ]);

        // if($this->checkDouplicate('Gallery_Image' , 'image_title' , $request['input_image_title'] , 'ADD'))
        // {
        //     return redirect('/admin/insert_gallery_image')->with( 'flash_message_error' , ' Bu '.$request['input_image_title'].' zaten kayıtlı.!!');
        // }

        $gallery_image = new Gallery_Image();

        $currentDateTime = Carbon::now()->format('YmdHs');
        $image=$request->file('input_image_file_name');
        $new_name='img_uploaded_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);

        $gallery_image->gallery_id = $request['gallery_id'];
        $gallery_image->image_title = $request['input_image_title'];
        $gallery_image->image_file_name=$new_name;   
        $gallery_image->save();    
        
        $gallery = Gallery::where('id', $request['gallery_id'])->first();
        $gallery->gallery_image_count = $gallery->gallery_image_count + 1;
        $gallery->save();

        // *******************  return view method ********************//
        // $gallery_image = Gallery_Image::where('gallery_id', $gallery->id)->get();
        // $gallery_name = '';
        // if($gallery->ref_type=='portfolio')
        // {
        //     $portfolio = Portfolio::where('id', $gallery->ref_id)->first();
        //     $gallery_name = $portfolio->portfolio_title;
        // }
        
        // return view('admin.gallery.index_insert_image_gallery')
        // ->with(['gallery'=>$gallery , 'gallery_image'=>$gallery_image , 'gallery_name'=>$gallery_name])
        // ->with( 'flash_message_success' , $request['input_image_title'].' görüntü, başarıyla kaydedildi!!');
        // *******************  end return view method ********************//

        return Redirect::back();

    }

    public function deleteGalleryImage(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->ajax())
        {
            $data = Gallery_Image::where('id', $request['image_id'])->first();
            $image_title = $data->image_title;
            $image_id = $data->id;
            $gallery_id = $data->gallery_id;
            $checkDeleteCondition = 1;
            if($checkDeleteCondition)
            {
                $data->delete();
                $gallery = Gallery::where('id', $gallery_id)->first();
                $gallery->gallery_image_count = $gallery->gallery_image_count - 1;
                $gallery->save();
                return response([
                    'success'=>'success',
                    'image_title'=>$image_title,
                    'image_id'=>$image_id
                ]); 
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'image_title'=>$image_title,
                    'image_id'=>$image_id
                    ]);                 
            }
        }

    }

    public function editRowGalleryImage($id)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        $data = Gallery_Image::where('id', $id)->first();
        return view('admin.gallery.update_image_gallery')->with('data' , $data);
    }

    public function updateGalleryImage(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
            return view($request['referrer_gallery_address']);
        }

        $this->validate($request, 
        [
            'input_image_title' => 'required',
        ],
        [
            'input_image_title.required' => 'lütfen Görüntü başlığını girin!! ',
        ]);

        $gallery_image = Gallery_Image::where('id', $request['image_id'])->first();
        $gallery_image->image_title = $request['input_image_title'];
        $gallery_image->save();    
        return redirect($request['referrer_gallery_address'])->with( 'flash_message_success' , $request['input_image_title'].' başlığı, başarıyla kaydedildi!!');;
    }
    
}

