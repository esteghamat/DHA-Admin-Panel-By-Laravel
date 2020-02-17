<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_Config;
use App\Config_Type;
use App\Model_Dependency;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;

class ConfigController extends Controller
{

  public function indexConfig()
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    $data = Site_Config::latest()->paginate(10);
    // echo '<pre>';
    // print_r($data);
    // die;
    return view('admin.site_config.index_config' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);
  }

  public function addConfig(Request $request)
  {
    if(!Session::has('adminSession'))
    {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
    }

    if($request->isMethod('get'))
    {
      $configtypes = Config_Type::all();
      return view('admin.site_config.add_edit_config')->with(
            ['configtypes' => $configtypes]);
    }

    $this->validate($request, 
    [
        'input_configtype_id' => 'required',
        'input_config_title' => 'required|min:3|unique:site_configs,config_title',
        'input_config_value' => 'required',
    ],
    [
        'input_configtype_id.required' => 'Lütfen ayar türünü seçin!! ',
        'input_config_title.required' => 'lütfen Ayar adını girin!! ',
        'input_config_title.unique' => 'Lütfen benzersiz bir başlık girin!! ',
        'input_config_value.required' => 'Lütfen ayar değerini girin!! ',
    ]);


    $site_config = new Site_Config();

    $site_config->configtype_id = $request['input_configtype_id'];
    $site_config->config_title = $request['input_config_title'];
    $site_config->config_value = $request['input_config_value'];
    $site_config->save();    
    
    return redirect('/admin/config')->with( 'flash_message_success' , $request['input_config_title'].' ayar türü, başarıyla kaydedildi!!');;

  }

  public function editRowConfig(Request $request , $id = 0 )
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

    if($request->isMethod('get'))
    {
      $config = Site_Config::where('id', $id)->first();
      $configtypes = Config_Type::all();
      return view('admin.site_config.add_edit_config')->with(
        ['config' => $config , 
         'configtypes' => $configtypes,]
      );
    }

    $this->validate($request, 
    [
        'input_configtype_id' => 'required',
        'input_config_title' => 'required|min:3|unique:site_configs,config_title,'. $request['config_id'],
        'input_config_value' => 'required',
    ],
    [
        'input_configtype_id.required' => 'Lütfen ayar türünü seçin!! ',
        'input_config_title.required' => 'lütfen Ayar adını girin!! ',
        'input_config_title.unique' => 'Lütfen benzersiz bir başlık girin!! ',
        'input_config_value.required' => 'Lütfen ayar değerini girin!! ',
    ]);


    $site_config = Site_Config::where('id' ,$request['config_id'] )->first();

    $site_config->configtype_id = $request['input_configtype_id'];
    $site_config->config_title = $request['input_config_title'];
    $site_config->config_value = $request['input_config_value'];
    $site_config->save();    
    
    return redirect('/admin/config')->with( 'flash_message_success' , $request['input_config_title'].' ayar türü, başarıyla kaydedildi!!');;

  }

  public function deletePassibilityConfig(Request $request)
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
          $tmp_array["object_name"] = $data->config_title;
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
  
  public function deleteConfig(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      
      if($request->ajax())
      {
          $data = Site_Config::where('id', $request['model_id'])->first();
          $config_title = $data->config_title;
          $config_id = $data->id;
          $checkDeleteCondition = 1;
          if($checkDeleteCondition)
          {
              $data->delete();
              return response([
                  'success'=>'success',
                  'object_name'=>$config_title,
                  'object_id'=>$config_id
                  ]); 
          }
          else
          {
              return response([
                  'success'=>'fail',
                  'object_name'=>$config_title,
                  'object_id'=>$config_id
                  ]);                 
          }
      }
  }


}
