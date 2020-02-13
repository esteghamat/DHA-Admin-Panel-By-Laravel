<?php

namespace App\Http\Controllers;

use App\Portfolio;
use App\Marka;
// use App\Category;
use App\Filter;
use App\Gallery;
use App\Gallery_Image;
use App\Model_Dependency;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PortfolioController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexPortfolio()
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        $data = Portfolio::latest()->paginate(5);
        // echo '<pre>';
        // print_r($data);
        // die;

        return view('admin.portfolio.index_portfolio' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*5);
    }

    public function showPortfolio($portfolio_slug)
    {
      $portfolio = Portfolio::where('portfolio_slug', $portfolio_slug)->first();

      return view('admin.portfolio.show_portfolio')->with('portfolio' , $portfolio);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     // public function create()
    public function addPortfolio(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
          $markas = Marka::all();
          // $categories = Category::with('get_children')->get();
          $filters = Filter::all();
          // return view('admin.portfolio.add_portfolio')->with(['markas'=>$markas , 'categories'=>$categories]);
          return view('admin.portfolio.add_portfolio')->with(['markas'=>$markas , 'filters'=>$filters]);
        }

        $this->validate($request, 
        [
            'input_portfolio_marka_id' => 'required',
            'input_portfolio_title' => 'required',
            'input_portfolio_slug' => 'required|min:3|unique:portfolios,portfolio_slug',
            'input_portfolio_description' => 'required',
            // 'input_portfolio_category_id' => 'required',
            'input_portfolio_filter_id' => 'required',
            'input_portfolio_image' => 'required',
            'input_portfolio_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'input_portfolio_marka_id.required' => 'lütfen Marka seçin!! ',
            'input_portfolio_title.required' => 'lütfen başlığı girin!! ',
            'input_portfolio_slug.required' => 'lütfen benzersiz Portfolio slugı girin!! ',
            'input_portfolio_description.required' => 'Lütfen açıklamayı girin!! ',
            // 'input_portfolio_category_id.required' => 'Lütfen kategoriyi girin!! ',
            'input_portfolio_filter_id.required' => 'Lütfen filteri girin!! ',
            'input_portfolio_image.required' => 'lütfen imajını girin!! ',
            'input_portfolio_image.image' => 'lütfen doğru biçimi girin!! ',
        ]);

        if($this->checkDouplicate('Portfolio' , 'portfolio_title' , $request['input_portfolio_title'] , 'ADD'))
        {
            return redirect('/admin/add_portfolio')->with( 'flash_message_error' , ' Bu '.$request['input_portfolio_title'].' zaten kayıtlı.!!');
        }

        $portfolio = new Portfolio();

        $currentDateTime = Carbon::now()->format('YmdHs');
        $image=$request->file('input_portfolio_image');
        $new_name='img_uploaded_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);

        $portfolio->portfolio_title = $request['input_portfolio_title'];
        $portfolio->portfolio_slug = Str::slug($request['input_portfolio_slug'], '-');
        $portfolio->portfolio_keywords = $request['input_portfolio_keywords'];
        $portfolio->portfolio_description = $request['input_portfolio_description'];
        $portfolio->portfolio_image_name=$new_name;   
        $portfolio->marka_id = $request['input_portfolio_marka_id'];
        // $portfolio->category_id = $request['input_portfolio_category_id'];
        $portfolio->filter_id = $request['input_portfolio_filter_id'];
        $portfolio->save();
        
        // return redirect('/admin/add_portfolio')->with( 'flash_message_success' , $request['input_portfolio_title'].' iş, başarıyla kaydedildi!!');
        return redirect('/portfolio')->with( 'flash_message_success' , $request['input_portfolio_title'].' iş, başarıyla kaydedildi!!');;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function editRowPortfolio($id)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        $data = Portfolio::where('id', $id)->first();
        // $categories = Category::with('get_children')->get();
        $filters = Filter::all();
        // return view('admin.portfolio.update_portfolio')->with(['data' => $data ,'categories'=>$categories] );
        return view('admin.portfolio.update_portfolio')->with(['data' => $data ,'filters'=>$filters] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function updatePortfolio(Request $request, Portfolio $portfolio)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }

        if($request->isMethod('get'))
        {
            return view('admin.portfolio.index_portfolio');
        }

        $imageName = $request['input_hidden_portfolio_image_name'];
        $image = $request->file('input_portfolio_image');
        if ($image != '')
        {
            $this->validate($request, 
            [
                'input_portfolio_title' => 'required',
                'input_portfolio_slug' => 'required|min:3|unique:portfolios,portfolio_slug,' . $request['portfolio_id'],
                'input_portfolio_description' => 'required',
                // 'input_portfolio_category_id' => 'required',
                'input_portfolio_filter_id' => 'required',
                'input_portfolio_image' => 'required',
                'input_portfolio_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'input_portfolio_title.required' => 'lütfen başlığı girin!! ',
                'input_portfolio_slug.required' => 'lütfen benzersiz Portfolio slugı girin!! ',
                'input_portfolio_description.required' => 'Lütfen açıklamayı girin!! ',
                // 'input_portfolio_category_id.required' => 'Lütfen kategoriyi girin!! ',
                'input_portfolio_filter_id.required' => 'Lütfen filteri girin!! ',
                'input_portfolio_image.required' => 'lütfen imajını girin!! ',
                'input_portfolio_image.image' => 'lütfen doğru biçimi girin!! ',
            ]);
            $currentDateTime = Carbon::now()->format('YmdHs');
            $new_name='img_uploaded_'.$currentDateTime.rand(1000 , 9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend_assets\uploaded_files\images'),$new_name);
        }
        else
        {
            $this->validate($request, 
            [
                'input_portfolio_title' => 'required',
                'input_portfolio_slug' => 'required|min:3|unique:portfolios,portfolio_slug,' . $request['portfolio_id'],
                'input_portfolio_description' => 'required',
                // 'input_portfolio_category_id' => 'required',
                'input_portfolio_filter_id' => 'required',
            ],
            [
                'input_portfolio_title.required' => 'lütfen başlığı girin!! ',
                'input_portfolio_slug.required' => 'lütfen benzersiz Portfolio slugı girin!! ',
                'input_portfolio_description.required' => 'Lütfen açıklamayı girin!! ',
                // 'input_portfolio_category_id.required' => 'Lütfen kategoriyi girin!! ',
                'input_portfolio_filter_id.required' => 'Lütfen filteri girin!! ',
            ]);
            $new_name = $imageName;
        }

        if($this->checkDouplicate('Portfolio' , 'portfolio_title' , $request['input_portfolio_title'],'EDIT' ,$request['portfolio_id'] ))
        {
            return redirect()->back()->with( 'flash_message_danger' , ' Bu '.$request['input_portfolio_title'].' zaten kayıtlı.!!');
            // return redirect('/admin/update_marka')->with( 'flash_message_error' , ' Bu '.$request['input_marka_name'].' zaten kayıtlı.!!');
        }

        $portfolio = Portfolio::where('id', $request['portfolio_id'])->first();
        if($portfolio)
        {
            $portfolio->portfolio_title = $request['input_portfolio_title'];
            $portfolio->portfolio_slug = Str::slug($request['input_portfolio_slug'], '-');
            $portfolio->portfolio_keywords = $request['input_portfolio_keywords'];
            $portfolio->portfolio_description = $request['input_portfolio_description'];
            $portfolio->portfolio_image_name=$new_name;   
            // $portfolio->category_id = $request['input_portfolio_category_id'];
            $portfolio->filter_id = $request['input_portfolio_filter_id'];
            $portfolio->save();    
            return redirect('/portfolio')->with( 'flash_message_success' , $request['input_portfolio_title'].' portfolio, başarıyla kaydedildi!!');;
        }    
        else
        {
            return redirect('/portfolio')->with( 'flash_message_danger' , $request['input_portfolio_title'].' portfolio, Veri kaydedilirken hata oluştu.!!');;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */

    public function deletePassibilityPortfolio(Request $request)
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
              $tmp_array["object_name"] = $data->portfolio_title;
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

    public function deletePortfolio(Request $request)
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
            $portfolio = Portfolio::has('get_galleries')->where('id', $request['model_id'])->with('get_galleries')->first();
            if($portfolio) // it has a gallery. 
            {
              $portfolio_title = $portfolio->portfolio_title;
              $portfolio_id = $portfolio->id;                
              $checkDeleteCondition=1;
              
              if(isset($portfolio->get_galleries->id))
              {
                $gallery_cur = Gallery::where('id', $portfolio->get_galleries->id)->first();
                if($gallery_cur->get_gallery_images->count()>0)
                {
                  $gallery_images_cur = Gallery_Image::where('gallery_id', $gallery_cur->id);
                  $gallery_images_cur->delete();
                }
                $gallery_cur->delete();
              }
              else   
              {
                return 'Error';
              }
            }
            else  // Portfolio does not have Gallery 
            {
              $portfolio = Portfolio::where('id', $request['model_id'])->first();
              if($portfolio)
              {
                $portfolio_title = $portfolio->portfolio_title;
                $portfolio_id = $portfolio->id;                
                $checkDeleteCondition=1;
              }  
            }
            if($checkDeleteCondition==1)
            {
              if($portfolio)  
              {
                $portfolio->delete();
                  return response([
                      'success'=>'success',
                      'object_name'=>$portfolio_title,
                      'object_id'=>$portfolio_id,
                      'message'=>$success_message
                      ]); 
              }      
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'object_name'=>$portfolio_title,
                    'object_id'=>$portfolio_id,
                    'message'=>$fail_message
                    ]);                 
            }
        }
    }

}

