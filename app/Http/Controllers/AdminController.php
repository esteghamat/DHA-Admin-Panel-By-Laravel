<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Site_Content_Type;
use Illuminate\Support\Facades\Hash;

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

    // public function loadContenttype()
    // {
    //   $contenttype = Site_Content_Type::orderBy('id', 'ASC')->first();
    //   // echo '<pre>';
    //   // print_r($contenttype);
    //   // die;    
    //   if($contenttype)
    //   {
    //     echo '<pre>';
    //     print_r($contenttype);
    //     die;    
    //     return response([
    //       'success'=>'success',
    //       'contenttype_id'=>$contenttype->id,
    //       'contenttype_title'=>$contenttype->contenttype_title,
    //       'contenttype_slug'=>$contenttype->contenttype_slug,
    //       'message'=>'İlk içerik türü bulur.'
    //       ]); 
    //   }
    //   else
    //   {
    //     return response([
    //       'success'=>'fail',
    //       'contenttype_id'=>0,
    //       'contenttype_title'=>'',
    //       'contenttype_slug'=>'',
    //       'message'=>'Hiçbir içerik türü yok. Lütfen önce içerik türü ekleyin.'
    //       ]); 
    //   }

    // }

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
}
