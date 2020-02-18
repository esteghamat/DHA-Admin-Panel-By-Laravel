<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Category;
use App\Model_Dependency;
use App\Site_Content_Type;
use App\Site_Content_Head;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ContentheadController extends Controller
{
    //
    public function indexContentHead()
    {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      $data = Site_Content_Head::latest()->paginate(5);
      // echo '<pre>';
      // print_r($data);
      // die;
      return view('admin.site_contenthead.index_contenthead' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);
    }

    public function showContentHead($contenthead_slug)
    {
      $contenthead = Site_Content_Head::where('contenthead_slug', $contenthead_slug)->first();

      return view('admin.site_contenthead.show_contenthead')->with('contenthead' , $contenthead);
    }

    public function addContentHead(Request $request)
    {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      $contenttypes = Site_Content_Type::all();
      if($request->isMethod('get'))
      {
          return view('admin.site_contenthead.add_contenthead')->with(['contenttypes'=>$contenttypes]);
      }

      $new_name = '';
      $new_logo_name = '';
      $image = $request->file('input_contenthead_image');
      $logo_image = $request->file('input_contenthead_logo_image');

      $rules = [
        'input_contenthead_contenttype_id' => 'required|unique:site_content_heads,site_content_type_id',
        'input_contenthead_title' => 'required|min:3|unique:site_content_heads,contenthead_title',
        'input_contenthead_slug' =>  'required|min:3|unique:site_content_heads,contenthead_slug',
      ];

      $messages = [
        'input_contenthead_contenttype_id.required' => 'lütfen İçerik türü seçin!! ',
        'input_contenthead_contenttype_id.unique' => 'lütfen benzersiz İçerik türü seçin!! Bu tür daha önce seçildi. ',
        'input_contenthead_title.required' => 'lütfen benzersiz başlığı girin!! ',
        'input_contenthead_slug.required' => 'lütfen benzersiz İçerik slugı girin!! ',
      ];
            
      if ($image != '')
      {
        $rules = $rules + 
        [
          'input_contenthead_image' => 'required',
          'input_contenthead_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ];

        $messages = $messages + 
        [
          'input_contenthead_image.required' => 'lütfen imajını girin!! ',
          'input_contenthead_image.image' => 'lütfen doğru biçimi girin!! ',
        ];
      }  

      if ($logo_image != '')
      {
        $rules = $rules + 
        [
          'input_contenthead_logo_image' => 'required',
          'input_contenthead_logo_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ];

        $messages = $messages + 
        [
          'input_contenthead_logo_image.required' => 'lütfen imajını girin!! ',
          'input_contenthead_logo_image.image' => 'lütfen doğru biçimi girin!! ',
        ];
      }  

      $this->validate($request, $rules , $messages);

      $contenthead = new Site_Content_Head();
      if ($image != '')
      {
        $currentDateTime = Carbon::now()->format('YmdHs');
        $image=$request->file('input_contenthead_image');
        $new_name='img_uploaded_headimage_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
        // $image->move(public_path(config('constants.backend_address').'\uploaded_files\images'),$new_name);        
        $image->move(public_path('backend_assets/uploaded_files/images'),$new_name);
      }

      if ($logo_image != '')
      {
        $currentDateTime = Carbon::now()->format('YmdHs');
        $logo_image=$request->file('input_contenthead_logo_image');
        $new_logo_name='img_uploaded_headlogo_'.$currentDateTime.rand(1000 , 9999).'.'.$logo_image->getClientOriginalExtension();
        // $logo_image->move(public_path(config('constants.backend_address').'\uploaded_files\images'),$new_logo_name);        
        $logo_image->move(public_path('backend_assets/uploaded_files/images'),$new_logo_name);
    }

      $contenthead->site_content_type_id = $request['input_contenthead_contenttype_id'];
      $contenthead->contenthead_title = $request['input_contenthead_title'];
      $contenthead->contenthead_slug = Str::slug($request['input_contenthead_slug'], '-');
      $contenthead->contenthead_keywords = $request['input_contenthead_keywords'];
      $contenthead->contenthead_title_description = $request['input_contenthead_title_description'];
      $contenthead->contenthead_description = $request['input_contenthead_description'];
      $contenthead->contenthead_image_name=$new_name;
      $contenthead->contenthead_logo_image_name=$new_logo_name;
      $contenthead->save();
      
      return redirect('/admin/add_contenthead')->with( 'flash_message_success' , $request['input_contenthead_title'].' içeriği, başarıyla kaydedildi!!');;

    }

    public function editRowContentHead($id)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        $data = Site_Content_Head::where('id', $id)->first();
        $contenttypes = Site_Content_Type::all();
        return view('admin.site_contenthead.update_contenthead')->with(['data' => $data ,'contenttypes'=>$contenttypes] );
    }

    public function updateContentHead(Request $request)
    {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      if($request->isMethod('get'))
      {
          return view('admin.site_contenthead.index_contenthead');
      }

      $new_name = '';
      $new_logo_name = '';
      $image = $request->file('input_contenthead_image');
      $logo_image = $request->file('input_contenthead_logo_image');

      $rules = [
        'input_contenthead_contenttype_id' => 'required|unique:site_content_heads,site_content_type_id,' . $request['contenthead_id'],
        'input_contenthead_title' => 'required|min:3|unique:site_content_heads,contenthead_title,' . $request['contenthead_id'],
        'input_contenthead_slug' =>  'required|min:3|unique:site_content_heads,contenthead_slug,' . $request['contenthead_id'],
      ];

      $messages = [
        'input_contenthead_contenttype_id.required' => 'lütfen İçerik türü seçin!! ',
        'input_contenthead_contenttype_id.unique' => 'lütfen benzersiz İçerik türü seçin!! Bu tür daha önce seçildi. ',
        'input_contenthead_title.required' => 'lütfen benzersiz başlığı girin!! ',
        'input_contenthead_slug.required' => 'lütfen benzersiz İçerik slugı girin!! ',
      ];
            
      if ($image != '')
      {
        $rules = $rules + 
        [
          'input_contenthead_image' => 'required',
          'input_contenthead_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ];

        $messages = $messages + 
        [
          'input_contenthead_image.required' => 'lütfen imajını girin!! ',
          'input_contenthead_image.image' => 'lütfen doğru biçimi girin!! ',
        ];
      } 

      if ($logo_image != '')
      {
        $rules = $rules + 
        [
          'input_contenthead_logo_image' => 'required',
          'input_contenthead_logo_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
        ];

        $messages = $messages + 
        [
          'input_contenthead_logo_image.required' => 'lütfen imajını girin!! ',
          'input_contenthead_logo_image.image' => 'lütfen doğru biçimi girin!! ',
        ];
      }  

      $this->validate($request, $rules , $messages);

      $contenthead = Site_Content_Head::where('id', $request['contenthead_id'])->first();
      if($contenthead)
      {
          if ($image != '')
          {
            $currentDateTime = Carbon::now()->format('YmdHs');
            $image=$request->file('input_contenthead_image');
            $new_name='img_uploaded_headimage_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
            // $image->move(public_path(config('constants.backend_address').'\uploaded_files\images'),$new_name);        
            $image->move(public_path('backend_assets/uploaded_files/images'),$new_name);
      }
          else
          {
            $new_name=$request['input_hidden_contenthead_image_name'];
          }

          if ($logo_image != '')
          {
            $currentDateTime = Carbon::now()->format('YmdHs');
            $logo_image=$request->file('input_contenthead_logo_image');
            $new_logo_name='img_uploaded_headlogo_'.$currentDateTime.rand(1000 , 9999).'.'.$logo_image->getClientOriginalExtension();
            // $logo_image->move(public_path(config('constants.backend_address').'\uploaded_files\images'),$new_logo_name);        
            $logo_image->move(public_path('backend_assets/uploaded_files/images'),$new_logo_name);
          }
          else
          {
            $new_logo_name=$request['input_hidden_contenthead_logo_image_name'];
          }

          // return view('test.variables_value_view')->with( ['var1' => $new_name , 'var2' => $new_logo_name]);

          $contenthead->site_content_type_id = $request['input_contenthead_contenttype_id'];
          $contenthead->contenthead_title = $request['input_contenthead_title'];
          $contenthead->contenthead_slug = Str::slug($request['input_contenthead_slug'], '-');
          $contenthead->contenthead_keywords = $request['input_contenthead_keywords'];
          $contenthead->contenthead_title_description = $request['input_contenthead_title_description'];
          $contenthead->contenthead_description = $request['input_contenthead_description'];
          $contenthead->contenthead_image_name=$new_name;
          $contenthead->contenthead_logo_image_name=$new_logo_name;
          $contenthead->save();
          
          return redirect('/contenthead')->with( 'flash_message_success' , $request['input_contenthead_title'].' içeriği, başarıyla kaydedildi!!');;
      }    
      else
      {
          return redirect('/contenthead')->with( 'flash_message_danger' , $request['input_contenthead_title'].' içeriği, Veri kaydedilirken hata oluştu.!!');;
      }

    }

    public function deletePassibilityContentHead(Request $request)
    {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      $possibility_array = array();
      $tmp_array = array();
      if($request->ajax())
      {
          $model_dependency = Model_Dependency::where('model_name', $request['modelname'])->get();
          // if(!$model_dependency)
          if($model_dependency->isEmpty())
          {
            return $possibility_array;
          }
          $i = 0;
          foreach($model_dependency as $dependency)
          {
            $modelName = 'App\\'.$request['modelname'];
            $data = $modelName::where('id', $request['modelid'])->first();
            $dependency_method = $dependency->eloquent_related_model_method;
            if($data->$dependency_method)
            {
              $count = $data->$dependency_method->where('ref_id', $request['modelid'])->count();
            }
            else
            {
              $count = 0;
            }
            if($count > 0)
            {
              $tmp_array["object_name"] = $data->contenthead_title;
              $tmp_array["model_name"] = $dependency->model_name;
              $tmp_array["related_model_name"] = $dependency->related_model_name;
              $tmp_array["is_delete_allowed_with_all_children"] = $dependency->is_delete_allowed_with_all_children;
              $tmp_array["message_first_part"] = $dependency->message_first_part;
              $tmp_array["message_second_part"] = $dependency->message_second_part;
              $tmp_array["related_count"] = $count;
              $tmp_array["eloquent_related_model_method"] = $dependency_method;
              $possibility_array[] = $tmp_array;
              $i = $i + 1;
            }
          }  
          return $possibility_array;
      }
      else 
      {
        return redirect('/admin/dashboard');
      }
    }

    public function deleteContentHead(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        
        if($request->ajax())
        {
            $fail_message='';
            $success_message='';
            $checkDeleteCondition = 1;

            $contenthead = Site_Content_Head::where('id', $request['model_id'])->first();
            if($contenthead)
            {
              $contenthead_title = $contenthead->contenthead_title;
              $contenthead_id = $contenthead->id;                
              $checkDeleteCondition=1;
            }  

            if($checkDeleteCondition==1)
            {
              if($contenthead)  
              {
                $contenthead->delete();
                  return response([
                      'success'=>'success',
                      'object_name'=>$contenthead_title,
                      'object_id'=>$contenthead_id,
                      'message'=>$success_message
                      ]); 
              }      
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'object_name'=>$contenthead_title,
                    'object_id'=>$contenthead_id,
                    'message'=>$fail_message
                    ]);                 
            }
        }
    }

}

