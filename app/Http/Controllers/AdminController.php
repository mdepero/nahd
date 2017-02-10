<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Report;
use App\FSection;
use App\FDescriptionArea;
use App\FConcernArea;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard(){

    	$reports = Report::all();

    	return view('admin.dashboard', compact('reports'));
    }

    public function editForm(){

    	$fsections = FSection::where('active',1)->orderBy('order')->get();

    	return view('admin.edit-form', compact('fsections'));
    }

    public function newFormSection(Request $request){

    	$fsection = new FSection;

    	$fsection->label = $request->label;

    	$fsection->save();

    	return redirect('/admin/form');
    }

    public function deleteFormSection($id){

    	$fsection = FSection::find($id);

    	$fsection->active = 0;

    	$fsection->save();

    	return redirect('/admin/form');
    }

    public function editFormSection($id){

    	$fsection = FSection::find($id);

    	return view('admin.edit-form-section', compact('fsection','id'));
    }

    public function formSectionNewDescriptionArea(Request $request, $secid){

    	$fdescriptionarea = new FDescriptionArea;

    	$fdescriptionarea->f_section_id = $secid;

    	$fdescriptionarea->label = $request->label;

    	$fdescriptionarea->save();

    	return redirect('/admin/form/'.$secid);
    }

    public function formSectionDeleteDescriptionArea($secid, $id){

    	$fdescriptionarea = FDescriptionArea::find($id);

    	$fdescriptionarea->active = 0;

    	$fdescriptionarea->save();

    	return redirect('/admin/form/'.$secid);
    }

    public function formSectionNewConcernArea(Request $request, $secid){

    	$fconcernarea = new FConcernArea;

    	$fconcernarea->f_section_id = $secid;

    	$fconcernarea->label = $request->label;

    	$fconcernarea->save();

    	return redirect('/admin/form/'.$secid);
    }

    public function formSectionDeleteConcernArea($secid, $id){

    	$fconcernarea = FConcernArea::find($id);

    	$fconcernarea->active = 0;

    	$fconcernarea->save();

    	return redirect('/admin/form/'.$secid);
    }
}
