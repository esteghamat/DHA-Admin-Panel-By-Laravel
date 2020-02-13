<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Marka;
use App\Model_Dependency;
use Session;
use Illuminate\Support\Str;

class MarkaController extends Controller
{
    private function checkDouplicate($modelName , $fieldName , $value , $add_or_edit, $current_id=null)
    {
        if($add_or_edit == 'ADD')
        {
            $model = app("App\\$modelName");
            $data = $model::where($fieldName, $value)->first();
            return $data;
        }
        else if($add_or_edit == 'EDIT')
        {
            $model = app("App\\$modelName");
            $data = $model::where([
                                    [$fieldName , $value],
                                    ['id', '<>', $current_id]]
                                    )->first();
            return $data;
        }
    }

    public function showMarka($marka_slug)
    {
      $marka = Marka::where('marka_slug', $marka_slug)->first();

      return view('admin.marka.show_marka')->with('marka' , $marka);
    }
    
    public function addMarka(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
            return view('admin.marka.add_marka');
        }

        $this->validate($request, 
        [
            'input_marka_name' => 'required',
            'input_marka_slug' => 'required|min:3|unique:markas,marka_slug',
            'input_marka_logo_file' => 'required',
            'input_marka_logo_file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'input_marka_name.required' => 'lütfen Marka adını girin!! ',
            'input_marka_slug.required' => 'lütfen benzersiz Marka slugı girin!! ',
            'input_marka_logo_file.required' => 'lütfen Marka imajını girin!! ',
            'input_marka_logo_file.image' => 'lütfen doğru biçimi girin!! ',
        ]);

        if($this->checkDouplicate('Marka' , 'marka_name' , $request['input_marka_name'] , 'ADD'))
        {
            return redirect('/admin/add_marka')->with( 'flash_message_error' , ' Bu '.$request['input_marka_name'].' zaten kayıtlı.!!');
        }

        $marka = new Marka();

        $currentDateTime = Carbon::now()->format('YmdHs');
        $image=$request->file('input_marka_logo_file');
        $new_name='img_uploaded_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);

        $marka->marka_name = $request['input_marka_name'];
        $marka->marka_slug = Str::slug($request['input_marka_slug'], '-');
        $marka->marka_keywords = $request['input_marka_keywords'];
        $marka->marka_description = $request['input_marka_description'];
        $marka->marka_logo_image_name=$new_name;   
        $marka->save();    
        
        // return redirect('/admin/add_marka')->with( 'flash_message_success' , $request['input_marka_name'].' marka, başarıyla kaydedildi!!');
        return redirect('/marka')->with( 'flash_message_success' , $request['input_marka_name'].' marka, başarıyla kaydedildi!!');;
    }

    public function indexMarka()
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        $data = Marka::latest()->paginate(5);
        // echo '<pre>';
        // print_r($data);
        // die;
        return view('admin.marka.index_marka' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);
    }

    public function editRowMarka($id)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        $data = Marka::where('id', $id)->first();
        return view('admin.marka.update_marka')->with('data' , $data);
    }

    public function updateMarka(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
            return view('admin.marka.index_marka');
        }

        $imageName = $request['input_hidden_marka_image_name'];
        $image = $request->file('input_marka_logo_file');
        if (($image != '') or ($request['input_hidden_marka_image_name'] == ''))
        {
            $this->validate($request, 
            [
                'input_marka_name' => 'required',
                'input_marka_slug' => 'required|min:3|unique:markas,marka_slug,' . $request['marka_id'],
                'input_marka_logo_file' => 'required',
                'input_marka_logo_file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'input_marka_name.required' => 'lütfen Marka adını girin!! ',
                'input_marka_slug.required' => 'lütfen benzersiz Marka slugı girin!! ',
                'input_marka_logo_file.required' => 'lütfen Marka imajını girin!! ',
                'input_marka_logo_file.image' => 'lütfen doğru biçimi girin!! ',
            ]);
            $currentDateTime = Carbon::now()->format('YmdHs');
            $new_name='img_uploaded_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);
        }
        else
        {
            $this->validate($request, 
            [
                'input_marka_name' => 'required',
                'input_marka_slug' => 'required|min:3|unique:markas,marka_slug,' . $request['marka_id'],
            ],
            [
                'input_marka_name.required' => 'lütfen Marka adını girin!! ',
                'input_marka_slug.required' => 'lütfen benzersiz Marka slugı girin!! ',
            ]);
            $new_name = $imageName;
        }

        if($this->checkDouplicate('Marka' , 'marka_name' , $request['input_marka_name'],'EDIT' ,$request['marka_id'] ))
        {
            return redirect()->back()->with( 'flash_message_error' , ' Bu '.$request['input_marka_name'].' zaten kayıtlı.!!');
            // return redirect('/admin/update_marka')->with( 'flash_message_error' , ' Bu '.$request['input_marka_name'].' zaten kayıtlı.!!');
        }

        $marka = Marka::where('id', $request['marka_id'])->first();
        $marka->marka_name = $request['input_marka_name'];
        $marka->marka_slug = Str::slug($request['input_marka_slug'], '-');
        $marka->marka_keywords = $request['input_marka_keywords'];
        $marka->marka_description = $request['input_marka_description'];
        $marka->marka_logo_image_name=$new_name;   
        $marka->save();    

        // return view('admin.marka.update_marka')->with('data' , $marka)->with( 'flash_message_success' , $request['input_marka_name'].' marka, başarıyla kaydedildi!!');
        return redirect('/marka')->with( 'flash_message_success' , $request['input_marka_name'].' marka, başarıyla kaydedildi!!');;
    }

    public function deletePassibilityMarka(Request $request)
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
            $tmp_array["object_name"] = $data->marka_name;
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
    
    public function deleteMarka(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        
        if($request->ajax())
        {
            $data = Marka::where('id', $request['model_id'])->first();
            $marka_name = $data->marka_name;
            $marka_id = $data->id;
            if($data->portfolios->count()>0)
            {
                $checkDeleteCondition = 0;
            }
            else
            {
                $checkDeleteCondition = 1;
            }
            if($checkDeleteCondition)
            {
                $data->delete();
                return response([
                    'success'=>'success',
                    'object_name'=>$marka_name,
                    'object_id'=>$marka_id
                    ]); 
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'object_name'=>$marka_name,
                    'object_id'=>$marka_id
                    ]);                 
            }
        }
    }
    
}

