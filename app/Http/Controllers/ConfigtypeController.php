<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config_Type;
use App\Model_Dependency;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;

class ConfigtypeController extends Controller
{
  public function indexConfigTypes()
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    $data = Config_Type::latest()->paginate(10);
    // echo '<pre>';
    // print_r($data);
    // die;
    return view('admin.site_config_type.index_configtype' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);
  }

  public function addConfigType(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
        return view('admin.site_config_type.add_configtype');
    }

    $this->validate($request, 
    [
        'input_configtype_title' => 'required|min:3|unique:config_types,configtype_title',
    ],
    [
        'input_configtype_title.required' => 'lütfen İçerik türü adını girin!! ',
        'input_configtype_title.unique' => 'Lütfen benzersiz bir başlık girin!! ',
    ]);

    $configtype = new Config_Type();

    $configtype->configtype_title = $request['input_configtype_title'];
    $configtype->save();    
    
    return redirect('/admin/configtype')->with( 'flash_message_success' , $request['input_configtype_title'].' ayar türü, başarıyla kaydedildi!!');;

  }

  public function editRowConfigType($id)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      $data = Config_Type::where('id', $id)->first();
      return view('admin.site_config_type.update_configtype')->with('data' , $data);
  }

  public function updateConfigType(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
        return view('admin.site_config_type.add_configtype');
    }

    $this->validate($request, 
    [
        'input_configtype_title' => 'required|min:3|unique:config_types,configtype_title',
    ],
    [
        'input_configtype_title.required' => 'lütfen İçerik türü adını girin!! ',
        'input_configtype_title.unique' => 'Lütfen benzersiz bir başlık girin!! ',
    ]);

    $configtype = Config_Type::where('id', $request['configtype_id'])->first();
    $configtype->configtype_title = $request['input_configtype_title'];
    $configtype->save();    

    // return view('admin.configtype.update_configtype')->with('data' , $configtype)->with( 'flash_message_success' , $request['input_configtype_title'].' configtype, başarıyla kaydedildi!!');
    return redirect('/admin/configtype')->with( 'flash_message_success' , $request['input_configtype_title'].' Ayar türü, başarıyla kaydedildi!!');;

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
          $tmp_array["object_name"] = $data->configtype_title;
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
          $data = Config_Type::where('id', $request['model_id'])->first();
          $configtype_title = $data->configtype_title;
          $configtype_id = $data->id;
          $checkDeleteCondition = 1;
          if($checkDeleteCondition)
          {
              $data->delete();
              return response([
                  'success'=>'success',
                  'object_name'=>$configtype_title,
                  'object_id'=>$configtype_id
                  ]); 
          }
          else
          {
              return response([
                  'success'=>'fail',
                  'object_name'=>$configtype_title,
                  'object_id'=>$configtype_id
                  ]);                 
          }
      }
  }

}
