<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Site_Content_Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Model_Dependency;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->input();
            $credential = $request->only('email', 'password');
            if(Auth::attempt($credential))
            {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => 1])) 
                {
                    Session::put('adminSession',$data['email']);
                    return redirect('/admin/dashboard');
                }
                else
                {
                    return redirect('/admin')->with( 'flash_message_error' , 'For dashboard access, you should login as Admin!!');
                }
                // echo '<pre>';
                // print_r($data);
                // die;           
            }
            else
            {
                // echo '<pre>';
                // print_r($data);
                // die;
                return redirect('/admin')->with( 'flash_message_error' , 'Invalid Username or Password!!');
            }
        }
        else if(Session::has('adminSession'))
        {
            return view('admin.dashboard');
        }
        else
        {
            return view('admin.admin_login');
        }
    } 

    public function register(Request $request)
    {
      if(Session::has('adminSession'))
      {
        return redirect('/admin')->with( 'flash_message_error' , 'Kayıt olmak istiyorsanız, önce çıkış yapmalısınız!!');
      }

      if($request->isMethod('get'))
      {
        return view('admin.admin_register');
      }  
 
    // dd($request['name'] . '---' . $request['email'] . '---' .  $request['password'] );
    $this->validate($request, 
    [
      'name' => 'required|string|max:255|unique:users,name',
      'email' => 'required|string|email|max:255|unique:users,email',
      'password' => 'required|min:8|confirmed',
    ],
    [
        'name.required' => 'lütfen kullanıcı adı girin!!',
        'name.string' => 'lütfen sadece geçerli karakterler girin!!',
        'name.unique' => 'lütfen benzersiz kullanıcı adı girin!!',
        'email.required' => 'lütfen e-posta girin!!',
        'email.string' => 'lütfen sadece geçerli karakterler girin!!',
        'email.email' => 'lütfen geçerli bir e-posta biçimi girin!!',
        'email.unique' => 'lütfen benzersiz e-posta girin!!',
        'password.required' => 'lütfen şifre giriniz!!',
        'password.string' => 'lütfen sadece geçerli karakterler girin!!',
        'password.min' => 'şifre en az 8 harf olmalıdır!!',
    ]);

    $newuser = new User();
    $newuser->name = $request['name'];
    $newuser->email = $request['email'];
    $newuser->password =Hash::make($request['password']);
    $newuser->save();    
    
    return redirect('/admin')->with( 'flash_message_success' , 'lütfen giriş yapın');

  }


    public function registerRedirect()
    {
      return redirect('/admin/register');
    }

    public function dashboard()
    {
        if(Session::has('adminSession'))
        {
            return view('admin.dashboard'); 
        }
        else
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access dashboard!!');
        }
    }

    public function settings()
    {
        if(Session::has('adminSession'))
        {
            return view('admin.settings');
        }
        else
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access dashboard!!');
        }
    }

    public function check_password(Request $request)
    {

        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access dashboard!!');
        }

        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1' , 'email'=> Auth::user()->email])->first();
        if(Hash::check($current_password , $check_password->password))
        {
            echo 'true';
            die;
        }
        else
        {
            echo 'false';
            die;
        }
    }

    public function update_password(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access dashboard!!');
        }

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // *********  Good method to view variable values in controller ******
            // echo "<pre>";
            // print_r($data);
            // die;
            // *********  Good method to view variable values in controller ******
            $check_password = User::where(['email'=> Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password , $check_password->password))
            {
                $password = bcrypt($data['new_pwd']);
                User::where(['email'=> Auth::user()->email])->update(['password'=>$password]);
                return redirect('/admin/settings')->with( 'flash_message_success' , 'Password changed successfully.');
            }
            else
            {
                return redirect('/admin/settings')->with( 'flash_message_error' , 'Incorrect current Password.');
            }

        }

    }

    public function logout()
    {
        Session()->forget('email','password','admin','adminSession');
        Session()->flush();
        return redirect('/admin')->with( 'flash_message_success' , 'Logout Successfuly!!');
    }

    public function userAdminAccess()
    {
      if(!Session::has('adminSession'))
      {
        return redirect('/admin')->with( 'flash_message_error' , 'Please login to access dashboard!!');
      }
      
      $data = User::paginate(10);
      return view('admin.user_admin_access' , compact('data'))->with('i' , (request()->input('page' , 1) -1)*10);

    }

    public function grantAdminAccess(Request $request)
    {
      $data = User::where('id' , $request['user_id'])->first();
      if($request['isadmin']==1)
      {
        $data->admin = 0;
        $newIsAdmin = 0;
      }
      else //
      {
        $data->admin = 1;
        $newIsAdmin = 1;
      }
      $data->save();
      return response([
          'success'=>'success',
          'newIsAdmin'=>$newIsAdmin,
          ]);
    }

    public function deletePassibilityUser(Request $request)
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
            $tmp_array["object_name"] = $data->name;
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
    
    public function deleteUser(Request $request)
    {
        if(!Session::has('adminSession'))
        {
            return redirect('/admin')->with( 'flash_message_error' , 'Please login to access this page!!');
        }
        
        if($request->ajax())
        {
            $data = User::where('id', $request['model_id'])->first();
            $user_name = $data->name;
            $user_id = $data->id;
            $checkDeleteCondition = 1;
            if($checkDeleteCondition)
            {
                $data->delete();
                return response([
                    'success'=>'success',
                    'object_name'=>$user_name,
                    'object_id'=>$user_id
                    ]); 
            }
            else
            {
                return response([
                    'success'=>'fail',
                    'object_name'=>$user_name,
                    'object_id'=>$user_id
                    ]);                 
            }
        }
    }
  

}
