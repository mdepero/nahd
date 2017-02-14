<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Report;
use App\FSection;
use App\FDescriptionArea;
use App\FConcernArea;
use App\FDescriptionOption;
use App\FConcernOption;

class AdminController extends Controller
{
    public function __construct(){
        
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

    public function formSectionEditDescriptionArea($secid, $id){

        $fdescriptionarea = FDescriptionArea::find($id);

        return view('admin.edit-form-description-area', compact('fdescriptionarea', 'secid', 'id'));
    }

    public function formSectionNewDescriptionOption(Request $request, $secid, $descid){

        $fdescriptionoption = new FDescriptionOption;

        $fdescriptionoption->f_description_area_id = $descid;

        $fdescriptionoption->label = $request->label;

        $fdescriptionoption->save();

        return redirect('/admin/form/'.$secid.'/description_area/'.$descid);
    }

    public function formSectionDeleteDescriptionOption(Request $request, $secid, $descid, $id){

        FDescriptionOption::destroy($id);

        return redirect('/admin/form/'.$secid.'/description_area/'.$descid);
    }

    public function formSectionEditConcernArea($secid, $id){

        $fconcernarea = FConcernArea::find($id);

        return view('admin.edit-form-concern-area', compact('fconcernarea', 'secid', 'id'));
    }

    public function formSectionNewConcernOption(Request $request, $secid, $conid){

        $fconcernoption = new FConcernOption;

        $fconcernoption->f_concern_area_id = $conid;

        $fconcernoption->label = $request->label;

        $fconcernoption->save();

        return redirect('/admin/form/'.$secid.'/concern_area/'.$conid);
    }

    public function formSectionDeleteConcernOption(Request $request, $secid, $conid, $id){

        FConcernOption::destroy($id);

        return redirect('/admin/form/'.$secid.'/concern_area/'.$conid);
    }
}
