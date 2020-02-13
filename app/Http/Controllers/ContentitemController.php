<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model_Dependency;
use App\Site_Content_Type;
use App\Site_Content_Item;
use App\Marka;
use App\Filter;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ContentitemController extends Controller
{

  public function setDefaultFor_IndexContentItem()
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }
    $data =  array();
    $contenttype = Site_Content_Type::orderby('id' , 'ASC')->first();
    $contenttype_slug_default = $contenttype->contenttype_slug;

    //  echo '<pre>';
    //  print_r($data);
    // die;
    // return view('admin.site_contentitem.index_contentitem' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);
    $url_contentitem_slug = '/contentitem/' . $contenttype_slug_default;
    return redirect($url_contentitem_slug);

  }

  public function IndexContentItem($contentitem_slug)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }
    $data =  array();
    $contenttype = Site_Content_Type::where('contenttype_slug' , $contentitem_slug)->first();
    $contenttype_id_default = $contenttype->id;
    $contenttype_title_default = $contenttype->contenttype_title;
    $contenttype_slug_default = $contenttype->contenttype_slug;

    $data['contenttypes'] = Site_Content_Type::orderby('id' , 'ASC')->get();
    $data['contentitems'] = Site_Content_Item::where('site_content_type_id' , $contenttype_id_default)->orderBy('custom_order', 'ASC')->paginate(5);    
    $data['contenttype_id_default'] = $contenttype_id_default;
    $data['contenttype_title_default'] = $contenttype_title_default;
    $data['contenttype_slug_default'] = $contenttype_slug_default;
    //  echo '<pre>';
    //  print_r($data);
    // die;
    return view('admin.site_contentitem.index_contentitem' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);

  }

  public function showContentItem($contenttype_slug , $contentitem_slug)
  {
    $contentitem = Site_Content_item::where('contentitem_slug', $contentitem_slug)->first();
    // echo '<pre>';
    // print_r($contentitem_slug);
    // die;
    return view('admin.site_contentitem.show_contentitem')->with('contentitem' , $contentitem);
  }

  public function addContentItem(Request $request,$contenttype_id = 0)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
      $markas = Marka::all();
      $filters = Filter::all();
      $contenttypes = Site_Content_Type::all();
      foreach($contenttypes as $contenttype)
      {
        if($contenttype->id == $contenttype_id)
        {
          $cotenttype_title = $contenttype->contenttype_title;
        break;
      }
      }
      return view('admin.site_contentitem.add_contentitem')->with(
            ['markas'=>$markas , 
             'filters'=>$filters , 
             'contenttypes' => $contenttypes , 
             'selected_contenttype_id' => $contenttype_id ,
             'contenttype_title' => $cotenttype_title
             ]);
    }

    $new_name = '';
    $new_logo_name = '';
    $image = $request->file('input_contentitem_image');
    $logo_image = $request->file('input_contentitem_logo_image');

    $rules = [
      'input_contentitem_title' => 'required|min:3|unique:site_content_items,contentitem_title',
      'input_contentitem_slug' =>  'required|min:3|unique:site_content_items,contentitem_slug',
    ];

    $messages = [
      'input_contentitem_title.required' => 'lütfen benzersiz başlığı girin!! ',
      'input_contentitem_slug.required' => 'lütfen benzersiz İçerik slugı girin!! ',
    ];
          
    if ($image != '')
    {
      $rules = $rules + 
      [
        'input_contentitem_image' => 'required',
        'input_contentitem_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
      ];

      $messages = $messages + 
      [
        'input_contentitem_image.required' => 'lütfen imajını girin!! ',
        'input_contentitem_image.image' => 'lütfen doğru biçimi girin!! ',
      ];
    }  

    if ($logo_image != '')
    {
      $rules = $rules + 
      [
        'input_contentitem_logo_image' => 'required',
        'input_contentitem_logo_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
      ];

      $messages = $messages + 
      [
        'input_contentitem_logo_image.required' => 'lütfen imajını girin!! ',
        'input_contentitem_logo_image.image' => 'lütfen doğru biçimi girin!! ',
      ];
    }  

    $this->validate($request, $rules , $messages);

    // for redirect after insert
    $contenttype = Site_Content_Type::where('id' , $request['input_hidden_contentitem_contenttype_id'])->first();
    $contenttype_slug_default = $contenttype->contenttype_slug;

    $ct_id = $request['input_hidden_contentitem_contenttype_id'];
    $contentitems_count = Site_Content_Item::whereHas('site_content_type', function ($query) use ($ct_id){
      $query->where('id','=', $ct_id);
    })->count(); 
    $custom_order = $contentitems_count + 1;
    
    $contentitem = new Site_Content_Item();

    if ($image != '')
    {
      $currentDateTime = Carbon::now()->format('YmdHs');
      $image=$request->file('input_contentitem_image');
      $new_name='img_uploaded_itemimage_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
      $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);        
    }

    if ($logo_image != '')
    {
      $currentDateTime = Carbon::now()->format('YmdHs');
      $logo_image=$request->file('input_contentitem_logo_image');
      $new_logo_name='img_uploaded_itemlogo_'.$currentDateTime.rand(1000 , 9999).'.'.$logo_image->getClientOriginalExtension();
      $logo_image->move(public_path('backend_assets\uploaded_files\images'),$new_logo_name);        
    }

    $contentitem->site_content_type_id = $request['input_hidden_contentitem_contenttype_id'];
    $contentitem->contentitem_title = $request['input_contentitem_title'];
    $contentitem->contentitem_slug = Str::slug($request['input_contentitem_slug'], '-');
    $contentitem->contentitem_keywords = $request['input_contentitem_keywords'];
    $contentitem->contentitem_title_description = $request['input_contentitem_title_description'];
    $contentitem->contentitem_description = $request['input_contentitem_description'];
    $contentitem->contentitem_url = $request['input_contentitem_url'];
    $contentitem->contentitem_image_name=$new_name;
    $contentitem->contentitem_logo_image_name=$new_logo_name;
    $contentitem->marka_id = $request['input_contentitem_marka_id'];
    $contentitem->filter_id = $request['input_contentitem_filter_id'];
    $contentitem->custom_order = $custom_order;
    $contentitem->save();
    
    $url_contentitem_slug = '/contentitem/' . $contenttype_slug_default;
    return redirect($url_contentitem_slug);

  }

  public function editRowContentItem($id)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    $data = Site_Content_Item::where('id', $id)->first();
    $contenttypes = Site_Content_Type::all();
    $markas = Marka::all();
    $filters = Filter::all();
    return view('admin.site_contentitem.update_contentitem')->with(
      ['markas'=>$markas , 
       'filters'=>$filters , 
       'data' => $data ,
       'contenttypes'=>$contenttypes
       ] );
  }

  public function updateContentItem(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
      return redirect('/contentitem');
    }

    $new_name = '';
    $new_logo_name = '';
    $image = $request->file('input_contentitem_image');
    $logo_image = $request->file('input_contentitem_logo_image');

    $rules = [
      'input_contentitem_title' => 'required|min:3|unique:site_content_items,contentitem_title,' . $request['contentitem_id'],
      'input_contentitem_slug' =>  'required|min:3|unique:site_content_items,contentitem_slug,' . $request['contentitem_id'],
    ];

    $messages = [
      'input_contentitem_title.required' => 'lütfen benzersiz başlığı girin!! ',
      'input_contentitem_slug.required' => 'lütfen benzersiz İçerik slugı girin!! ',
    ];
          
    if ($image != '')
    {
      $rules = $rules + 
      [
        'input_contentitem_image' => 'required',
        'input_contentitem_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
      ];

      $messages = $messages + 
      [
        'input_contentitem_image.required' => 'lütfen imajını girin!! ',
        'input_contentitem_image.image' => 'lütfen doğru biçimi girin!! ',
      ];
    }  

    if ($logo_image != '')
    {
      $rules = $rules + 
      [
        'input_contentitem_logo_image' => 'required',
        'input_contentitem_logo_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048'
      ];

      $messages = $messages + 
      [
        'input_contentitem_logo_image.required' => 'lütfen imajını girin!! ',
        'input_contentitem_logo_image.image' => 'lütfen doğru biçimi girin!! ',
      ];
    }  

    $this->validate($request, $rules , $messages);

    $contentitem = Site_Content_Item::where('id', $request['contentitem_id'])->first();
    if($contentitem)
    {
        if ($image != '')
        {
          $currentDateTime = Carbon::now()->format('YmdHs');
          $image=$request->file('input_contentitem_image');
          $new_name='img_uploaded_itemimage_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
          $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);        
        }
        else
        {
          $new_name=$request['input_hidden_contentitem_image_name'];
        }

        if ($logo_image != '')
        {
          $currentDateTime = Carbon::now()->format('YmdHs');
          $logo_image=$request->file('input_contentitem_logo_image');
          $new_logo_name='img_uploaded_itemlogo_'.$currentDateTime.rand(1000 , 9999).'.'.$logo_image->getClientOriginalExtension();
          $logo_image->move(public_path('backend_assets\uploaded_files\images'),$new_logo_name);
        }
        else
        {
          $new_logo_name=$request['input_hidden_contentitem_logo_image_name'];
        }

        // return view('test.variables_value_view')->with( ['var1' => $new_name , 'var2' => $new_logo_name]);
        $contenttype_slug_hidden = $request['contenttype_slug_hidden'];

        $contentitem->site_content_type_id = $request['contenttype_id_hidden'];
        $contentitem->contentitem_title = $request['input_contentitem_title'];
        $contentitem->contentitem_slug = Str::slug($request['input_contentitem_slug'], '-');
        $contentitem->contentitem_keywords = $request['input_contentitem_keywords'];
        $contentitem->contentitem_title_description = $request['input_contentitem_title_description'];
        $contentitem->contentitem_description = $request['input_contentitem_description'];
        $contentitem->contentitem_url = $request['input_contentitem_url'];
        $contentitem->contentitem_image_name=$new_name;
        $contentitem->contentitem_logo_image_name=$new_logo_name;
        $contentitem->marka_id = $request['input_contentitem_marka_id'];
        $contentitem->filter_id = $request['input_contentitem_filter_id'];
        $contentitem->save();
        
        $return_url = '/contentitem/' . $contenttype_slug_hidden;
        return redirect("$return_url")->with( 'flash_message_success' , $request['input_contentitem_title'].' içeriği, başarıyla kaydedildi!!');;

    }    
    else
    {
        return redirect('/contentitem')->with( 'flash_message_danger' , $request['input_contentitem_title'].' içeriği, Veri kaydedilirken hata oluştu.!!');;
    }
  }

  public function deletePassibilityContentItem(Request $request)
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
            $tmp_array["object_name"] = $data->contentitem_title;
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

  public function deleteContentItem(Request $request)
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

          $contentitem = Site_Content_Item::where('id', $request['model_id'])->first();
          if($contentitem)
          {
            $contentitem_title = $contentitem->contentitem_title;
            $contentitem_id = $contentitem->id;                
            $checkDeleteCondition=1;
          }  

          if($checkDeleteCondition==1)
          {
            if($contentitem)  
            {
              $contentitem->delete();
                return response([
                    'success'=>'success',
                    'object_name'=>$contentitem_title,
                    'object_id'=>$contentitem_id,
                    'message'=>$success_message
                    ]); 
            }      
          }
          else
          {
              return response([
                  'success'=>'fail',
                  'object_name'=>$contentitem_title,
                  'object_id'=>$contentitem_id,
                  'message'=>$fail_message
                  ]);                 
          }
      }
  }

  public function reOrderContentItem(Request $request)
  {
    $contentitems = Site_Content_item::select('id' , 'site_content_type_id' , 'custom_order')->where('site_content_type_id', $request['site_content_type_id'])->orderby('custom_order' , 'ASC')->get();
    $columns_new_order = 0;
    $change_order_step = 1 ;
    foreach($contentitems as $contentitem)
    {
      if($contentitem->id == $request['id'])
      {
        if($contentitem->custom_order == $request['new_order'])
        {
          break;
        }
        if($contentitem->custom_order < $request['new_order'] )
        {
          $change_order_step = -1 ;
        }
        else if($contentitem->custom_order > $request['new_order'])
        {
          $change_order_step = 1 ;
        }

        Site_Content_item::where('id', $request['id'])->update(['custom_order' => $request['new_order']]);
        continue;
      }

      if($change_order_step == 1)
      {
          if($contentitem->custom_order < $request['new_order'])
          {
            continue;
          }
    
          if($contentitem->custom_order >= $request['new_order'])
          {
            if($columns_new_order == 0)
            {
              Site_Content_item::where('id', $contentitem->id)->update(['custom_order' => ($contentitem->custom_order + $change_order_step)]);
              $columns_new_order = $contentitem->custom_order + $change_order_step;
            }
            else
            {
              $columns_new_order = $columns_new_order + 1;
              Site_Content_item::where('id', $contentitem->id)->update(['custom_order' => $columns_new_order]);
            }
          }
      } // end if($change_order_step == 1)
      else  // $change_order_step == 0
      {
        if($contentitem->custom_order > $request['new_order'])
        {
            break;
        }
  
        if($contentitem->custom_order <= $request['new_order'])
        {
          if($columns_new_order == 0)
          {
            Site_Content_item::where('id', $contentitem->id)->update(['custom_order' => ($contentitem->custom_order + $change_order_step)]);
            $columns_new_order = $contentitem->custom_order + $change_order_step;
          }
          else
          {
            $columns_new_order = $columns_new_order + 1;
            Site_Content_item::where('id', $contentitem->id)->update(['custom_order' => $columns_new_order]);
          }
        }

      } // end else  // $change_order_step == 0

    } // end foreach($contentitems as $contentitem)
    return 1;
  } // end public function reOrderContentItem(Request $request)

}
