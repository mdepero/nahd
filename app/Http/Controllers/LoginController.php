<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Report;

class LoginController extends Controller
{

	public function showForm(Request $request){

		if($request->session()->has('admin') ){
    		return redirect('/admin')->withErrors(['You are already logged in.']);;
    	}

    	if($request->session()->has('key') ){
    		return redirect('/webportal')->withErrors(['You are already logged in.']);;
    	}

		return view('pages.login');
	}

    public function login(Request $request){

    	if($request->session()->has('admin') ){
    		return redirect('/admin')->withErrors(['You are already logged in.']);;
    	}

    	if($request->session()->has('key') ){
    		return redirect('/webportal')->withErrors(['You are already logged in.']);;
    	}

    	if(!$request->has('key')){
    		return redirect('/login')->withErrors(['No Access Key Sent']);
    	}

    	if($request->input('key') == env('ADMIN_PASS')){
    		$request->session()->put('admin',true);
    		$request->session()->forget('key');

    		return redirect('/admin');
    	}else{

    		if(Report::where('access_key', $request->input('key') )->count() > 0){
    			$request->session()->put('key',$request->input('key'));
    			$request->session()->forget('admin');

    			return redirect('/webportal');
    		}else{
				return redirect('/login')->withErrors(['No matches found for that access key. Please check your key and try again.']);
    		}
    	}

    }

    public function logout(Request $request){

    	$request->session()->forget('key');
    	$request->session()->forget('admin');

    	return redirect('/login')->with('message','You have successfully been logged out.'); // send a "logged out" message with it??
    }
}
