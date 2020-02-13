<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_Content_Type;
use App\Model_Dependency;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;


class ContenttypeController extends Controller
{

  public function showContentType($contenttype_slug)
  {
    $contenttype = Site_Content_Type::where('contenttype_slug', $contenttype_slug)->first();

    return view('admin.contenttype.show_contenttype')->with('contenttype' , $contenttype);
  }
  
  public function addContentType(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      if($request->isMethod('get'))
      {
          return view('admin.contenttype.add_contenttype');
      }

      $this->validate($request, 
      [
          'input_contenttype_title' => 'required|min:3|unique:site_content_types,contenttype_title',
          'input_contenttype_slug' => 'required|min:3|unique:site_content_types,contenttype_slug',
      ],
      [
          'input_contenttype_title.required' => 'lütfen İçerik türü adını girin!! ',
          'input_contenttype_slug.required' => 'lütfen benzersiz İçerik türü slugı girin!! ',
      ]);

      $contenttype = new ContentType();

      $contenttype->contenttype_title = $request['input_contenttype_title'];
      $contenttype->contenttype_slug = Str::slug($request['input_contenttype_slug'], '-');
      $contenttype->save();    
      
      return redirect('/admin/contenttype')->with( 'flash_message_success' , $request['input_contenttype_title'].' contenttype, başarıyla kaydedildi!!');;
  }

  public function indexContentType()
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      $data = Site_Content_Type::latest()->paginate(10);
      // echo '<pre>';
      // print_r($data);
      // die;
      return view('admin.contenttype.index_contenttype' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);
  }

  public function editRowContentType($id)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      $data = Site_Content_Type::where('id', $id)->first();
      return view('admin.contenttype.update_contenttype')->with('data' , $data);
  }

  public function updateContentType(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      if($request->isMethod('get'))
      {
          return view('admin.contenttype.index_contenttype');
      }

      $this->validate($request, 
      [
          'input_contenttype_title' => 'required|min:3|unique:site_content_types,contenttype_title,' . $request['contenttype_id'],
          'input_contenttype_slug' => 'required|min:3|unique:site_content_types,contenttype_slug,' . $request['contenttype_id'],
      ],
      [
          'input_contenttype_title.required' => 'lütfen İçerik türü adını girin!! ',
          'input_contenttype_slug.required' => 'lütfen benzersiz İçerik türü slugı girin!! ',
      ]);


      $contenttype = Site_Content_Type::where('id', $request['contenttype_id'])->first();
      $contenttype->contenttype_title = $request['input_contenttype_title'];
      $contenttype->contenttype_slug = Str::slug($request['input_contenttype_slug'], '-');
      $contenttype->save();    

      // return view('admin.contenttype.update_contenttype')->with('data' , $contenttype)->with( 'flash_message_success' , $request['input_contenttype_title'].' contenttype, başarıyla kaydedildi!!');
      return redirect('/admin/contenttype')->with( 'flash_message_success' , $request['input_contenttype_title'].' contenttype, başarıyla kaydedildi!!');;
  }

  public function deletePassibilityContentType(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    $possibility_array = array();
    $tmp_array = array();
    // return $possibility_array;
    if($request->ajax())
    {
        $model_dependency = Model_Dependency::where('model_name', $request['modelname'])->get();
        if(!$model_dependency)
        {
          return $possibility_array;
        }
        $i = 0;
        foreach($model_dependency as $dependency)
        {
          $modelName = 'App\\'.$request['modelname'];
          $data = $modelName::where('id', $request['modelid'])->first();
          $dependency_method = $dependency->eloquent_related_model_method;
          $relatedDataCount = $modelName::where('id', $request['modelid'])->withCount($dependency_method)->get();
          $get_count_code = $dependency_method . '_count';
          $count = $relatedDataCount->first()->$get_count_code;
          // $count = $data->$dependency_method->count();   // old code
          if($count > 0)
          {
          $tmp_array["object_name"] = $data->contenttype_title;
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
  
  public function deleteContentType(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      
      if($request->ajax())
      {
          $data = Site_Content_Type::where('id', $request['model_id'])->first();
          $contenttype_title = $data->contenttype_title;
          $contenttype_id = $data->id;
          $checkDeleteCondition = 1;
          if($checkDeleteCondition)
          {
              $data->delete();
              return response([
                  'success'=>'success',
                  'object_name'=>$contenttype_title,
                  'object_id'=>$contenttype_id
                  ]); 
          }
          else
          {
              return response([
                  'success'=>'fail',
                  'object_name'=>$contenttype_title,
                  'object_id'=>$contenttype_id
                  ]);                 
          }
      }
  }

}
