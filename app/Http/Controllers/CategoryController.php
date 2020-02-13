<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Model_Dependency;
use Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
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

    public function showCategory($category_slug)
    {
      $category = Category::with('get_parent')->where('category_slug', $category_slug)->first();

      return view('admin.category.show_category')->with('category' , $category);
    }

    public function addCategory(Request $request)
    {
        if(!Session::has('adminSession'))
        {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
          $mainCategoryList = Category::where('parent_id', 0)->get();
          return view('admin.category.add_category', compact('mainCategoryList'));
        }

        if($request['input_category_level']=='mainCategory')
        {
          $this->validate($request, 
          [
              'input_category_name' => 'required',
              'input_category_slug' => 'required|min:3|unique:categories,category_slug',
          ],
          [
              'input_category_name.required' => 'lütfen category adını girin!! ',
              'input_category_slug.required' => 'lütfen benzersiz kategori slugı girin!! ',
          ]);
        } else if($request['input_category_level']=='subCategory')
        {
          $this->validate($request, 
          [
              'input_category_name' => 'required',
              'input_category_slug' => 'required|min:3|unique:categories,category_slug',
              'input_select_category_level' => 'required',
          ],
          [
              'input_category_name.required' => 'lütfen category adını girin!! ',
              'input_category_slug.required' => 'lütfen benzersiz kategori slugı girin!! ',
              'input_select_category_level.required' => 'lütfen category seviyesi girin!! ',
          ]);
        }

        $parent_id=0;
        if($request['input_category_level']=='subCategory')
        {
          $parent_id = $request['input_select_category_level'];
        } 

        if($this->checkDouplicate('Category' , 'category_name' , $request['input_category_name'] , 'ADD'))
        {
            return redirect('/admin/add_category')->with( 'flash_message_error' , ' Bu '.$request['input_category_name'].' zaten kayıtlı.!!');
        }

        $category = new Category();

        $category->category_name = $request['input_category_name'];
        $category->category_slug = Str::slug($request['input_category_slug'], '-');
        $category->category_description = $request['input_category_description'];
        $category->parent_id = $parent_id;
        $category->save();    
        
        // return redirect('/admin/add_category')->with( 'flash_message_success' , $request['input_category_name'].' kategory, başarıyla kaydedildi!!');
        return redirect('/category')->with( 'flash_message_success' , $request['input_category_name'].' category, başarıyla kaydedildi!!');;

    }

    public function indexcategory()
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        // $data = Category::with('get_parent')->where('id' , 5)->latest()->paginate(10);
        $data = Category::with('get_parent')->latest()->paginate(10);
        // echo '<pre>';
        // print_r($data);
        // die;
        return view('admin.category.index_category' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);
    }

    public function editRowCategory($id)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        $data = Category::where('id', $id)->first();
        $mainCategoryList = Category::where('parent_id', 0)->get();
        return view('admin.category.update_category')->with(['data' => $data ,'mainCategoryList' => $mainCategoryList]);
    }

    public function updateCategory(Request $request)
    {

        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
            return view('admin.category.index_category');
        }

        $this->validate($request, 
        [
          'input_category_name' => 'required',
          'input_category_slug' => 'required|min:3|unique:categories,category_slug,' . $request['category_id'],
        ],
        [
            'input_category_name.required' => 'lütfen category adını girin!! ',
            'input_category_slug.required' => 'lütfen benzersiz kategori slugı girin!! ',
        ]);

        if($this->checkDouplicate('Category' , 'category_name' , $request['input_category_name'],'EDIT' ,$request['category_id'] ))
        {
            return redirect()->back()->with( 'flash_message_error' , ' Bu '.$request['input_category_name'].' zaten kayıtlı.!!');
            // return redirect('/admin/update_category')->with( 'flash_message_error' , ' Bu '.$request['input_category_name'].' zaten kayıtlı.!!');
        }

        $category = Category::where('id', $request['category_id'])->first();
        $category->category_name = $request['input_category_name'];
        $category->category_description = $request['input_category_description'];
        $category->category_slug = Str::slug($request['input_category_slug'], '-');
        $category->save();    
        return redirect('/category')->with( 'flash_message_success' , $request['input_category_name'].' category, başarıyla kaydedildi!!');;
    }


    public function deletePassibilityCategory(Request $request)
    {
      if(!Session::has('adminSession'))
      {
          return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
      }

      $possibility_array = array();
      $tmp_array = array();
      if($request->ajax())
      {
          // return 1111;
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
            $tmp_array["object_name"] = $data->category_name;
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


    public function deleteCategory(Request $request)
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
            $data = Category::where('id', $request['model_id'])->first();
            $child = Category::where('parent_id', $request['model_id'])->first();
            if($child)
            {
              $checkDeleteCondition = 0;
              $fail_message='Bu kategorinin çocuğu var ve silinemez.';
            }
            if($data->portfolios->count()>0)
            {
                $checkDeleteCondition = 0;
                $fail_message=$fail_message . ' . Bu kategori kullanılmıştır. ';
            }
            $category_name = $data->category_name;
            $category_id = $data->id;
            if($checkDeleteCondition)
            {
                $data->delete();
                return response([
                    'success'=>'success',
                    'object_name'=>$category_name,
                    'object_id'=>$category_id,
                    'message'=>$success_message
                    ]); 
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'object_name'=>$category_name,
                    'object_id'=>$category_id,
                    'message'=>$fail_message
                    ]);                 
            }
        }

    }

}
