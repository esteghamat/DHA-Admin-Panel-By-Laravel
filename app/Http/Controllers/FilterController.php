<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filter;
use App\Model_Dependency;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Str;


class FilterController extends Controller
{

  public function showFilter($filter_slug)
  {
    $filter = Filter::where('filter_slug', $filter_slug)->first();

    return view('admin.filter.show_filter')->with('filter' , $filter);
  }
  
  public function addFilter(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      if($request->isMethod('get'))
      {
          return view('admin.filter.add_filter');
      }

      $this->validate($request, 
      [
          'input_filter_name' => 'required|min:3|unique:filters,filter_name',
          'input_filter_slug' => 'required|min:3|unique:filters,filter_slug',
      ],
      [
          'input_filter_name.required' => 'lütfen Filter adını girin!! ',
          'input_filter_slug.required' => 'lütfen benzersiz Filter slugı girin!! ',
      ]);

      $filter = new Filter();

      $filter->filter_name = $request['input_filter_name'];
      $filter->filter_slug = Str::slug($request['input_filter_slug'], '-');
      $filter->save();    
      
      return redirect('/admin/filter')->with( 'flash_message_success' , $request['input_filter_name'].' filter, başarıyla kaydedildi!!');;
  }

  public function indexFilter()
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      $data = Filter::latest()->paginate(10);
      // echo '<pre>';
      // print_r($data);
      // die;
      return view('admin.filter.index_filter' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);
  }

  public function editRowFilter($id)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      $data = Filter::where('id', $id)->first();
      return view('admin.filter.update_filter')->with('data' , $data);
  }

  public function updateFilter(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      if($request->isMethod('get'))
      {
          return view('admin.filter.index_filter');
      }

      $this->validate($request, 
      [
          'input_filter_name' => 'required|min:3|unique:filters,filter_name,' . $request['filter_id'],
          'input_filter_slug' => 'required|min:3|unique:filters,filter_slug,' . $request['filter_id'],
      ],
      [
          'input_filter_name.required' => 'lütfen Filter adını girin!! ',
          'input_filter_slug.required' => 'lütfen benzersiz Filter slugı girin!! ',
      ]);


      $filter = Filter::where('id', $request['filter_id'])->first();
      $filter->filter_name = $request['input_filter_name'];
      $filter->filter_slug = Str::slug($request['input_filter_slug'], '-');
      $filter->save();    

      // return view('admin.filter.update_filter')->with('data' , $filter)->with( 'flash_message_success' , $request['input_filter_name'].' filter, başarıyla kaydedildi!!');
      return redirect('/admin/filter')->with( 'flash_message_success' , $request['input_filter_name'].' filter, başarıyla kaydedildi!!');;
  }

  public function deletePassibilityFilter(Request $request)
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
          $count = $data->$dependency_method->count();
          if($count > 0)
          {
          $tmp_array["object_name"] = $data->filter_name;
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
  
  public function deleteFilter(Request $request)
  {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }
      
      if($request->ajax())
      {
          $data = Filter::where('id', $request['model_id'])->first();
          $filter_name = $data->filter_name;
          $filter_id = $data->id;
          $checkDeleteCondition = 1;
          if($checkDeleteCondition)
          {
              $data->delete();
              return response([
                  'success'=>'success',
                  'object_name'=>$filter_name,
                  'object_id'=>$filter_id
                  ]); 
          }
          else
          {
              return response([
                  'success'=>'fail',
                  'object_name'=>$filter_name,
                  'object_id'=>$filter_id
                  ]);                 
          }
      }
  }

}

