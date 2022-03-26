<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use DB;

class AdminController extends Controller
{
    public function login(){
    	try{
    		if(Session::has('admin')){
    			return redirect('admin-dashboard');
    		}
    		return view('admin/login');
    	}catch(\Exception $e){
    		return ($e->getMessage());
    	}
    }

    public function loginAdmin(request $request){

    	$validatedData = $request->validate([
		    'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
		]);

    	try{
    		if (Auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
		        {
		            $user = auth()->guard('admin')->user();

		            \Session::put('admin',$user);
		            return redirect()->route('admin-dashboard');

		        } else {
		            return back()->with('error-message','your username and password are wrong.');
		        }
    	}catch(\Exception $e){
    		return ($e->getMessage());
    	}
    }

    public function dashboard(){
    	try{
    		return view('admin/dashboard');
    	}catch(\Exception $e){
    		return ($e->getMessage());
    	}
    }

    public function profile(){
    	try{
    		return view('admin/userprofile');
    	}catch(\Exception $e){
    		return ($e->getMessage());
    	}
    }

    public function logout(){
    	try{
    		Auth::guard('admin')->logout();
    		Session::forget('admin');
    		return redirect('login');
    	}catch(\Exception $e){
    		return ($e->getMessage());
    	};
    }

    public function users(){
        $users=User::orderBy('_id','DESC')->get();
        return view('admin.users.index')->with('allusers',$users);
    }


    public function vendors(){
        $vendors=Vendor::orderBy('_id','DESC')->get();
        return view('admin.vendors.index')->with('vendors',$vendors);
    }


}
