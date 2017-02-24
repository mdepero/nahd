<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Report;

class PortalController extends Controller
{
	public function __construct(){

        $this->middleware('user');
    }



    public function showReport(Request $request) {

    	if($request->session()->has('admin')) return redirect('/admin');

    	$report = Report::where('access_key', session('key'))->first();

    	return view('portal.dashboard', compact('report'));
    }
	
	public function printReport($id){

		$report = Report::findOrFail($id);
		$valid = false;

		if(session('admin')) $valid = true;

		if(session('key')){
			if(session('key') == $report->access_key) $valid = true;
		}

		if(!$valid) return redirect('/contact')->withErrors(['You do not have persmission to view that page']);

		//return view('portal.print', compact('report'));












		require(public_path('print.php'));







		return $pdf->Output();;




	}    
}
