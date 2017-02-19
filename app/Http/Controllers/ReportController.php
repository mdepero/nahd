<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Report;
use App\FSection;
use App\Section;
use App\FDescriptionArea;
use App\Description;
use App\FConcernArea;
use App\Concern;
use App\Image;

class ReportController extends Controller
{

    public function __construct(){

        $this->middleware('admin');
    }

    public function newReport(){

    	$report = new Report;

    	$report->save();

    	$activeSections = FSection::where('active',1)->get();

    	foreach($activeSections as $fsection){

    		$newSection = new Section;

    		$newSection->report_id = $report->id;

    		$newSection->f_section_id = $fsection->id;

    		$newSection->save();

    		$activeDescriptionAreas = FDescriptionArea::where('active',1)->where('f_section_id',$fsection->id)->get();

    		foreach($activeDescriptionAreas as $descriptionArea){

    			$newDescription = new Description;

    			$newDescription->section_id = $newSection->id;

    			$newDescription->area_id = $descriptionArea->id;

    			$newDescription->save();
    		}
    	}

    	return redirect('/admin/report/'.$report->id.'/details');
    }

    public function editReport($id){

    	$report = Report::find($id);

    	return view('admin.edit-report', compact('report'));
    }

    public function editReportDetails($id){

    	$report = Report::find($id);

    	return view('admin.edit-report-details', compact('report'));
    }

    public function saveReportDetails(Request $request, $id){

    	$report = Report::find($id);

    	$report->fill($request->all());

    	$report->save();

    	return redirect('/admin/report/'.$id);

    }

    public function editReportSummary($id){

    	$report = Report::find($id);

    	return view('admin.edit-report-summary', compact('report'));
    }

    public function saveReportSummary(Request $request, $id){

    	$report = Report::find($id);

    	$report->rating = $request->rating;

    	$report->final_remarks = $request->final_remarks;

    	$report->save();

    	foreach($request->all() as $key => $field){

    		if(is_int($key)){

    			$section = Section::find($key);

    			$section->summary = $field;

    			$section->save();
    		}
    	}

    	$report->save();

    	return redirect('/admin/report/'.$id);

    }

    public function editReportSection($reportid, $id){

    	$section = Section::find($id);

    	$possible_concern_areas = FConcernArea::where('f_section_id',$section->fsection->id)->get();

    	return view('admin.edit-report-section', compact('section', 'possible_concern_areas'));
    }



    public function saveReportSection(Request $request, $reportid, $id){

    	// UPDATE EXISTING DESCRIPTIONS AND CONCERNS

    	foreach($request->all() as $key => $field){

    		if(is_numeric(str_replace('desc_', '', $key))){

    			$description = Description::find(str_replace('desc_', '', $key));

    			$description->value = $field;

    			$description->save();
    		}

    		if(is_numeric(str_replace('conc_', '', $key))){

    			$con_id = str_replace('conc_', '', $key);

    			$concern = Concern::find($con_id);

    			$concern->item = $request->input('conc_'.$con_id);

    			$concern->location = $request->input('conc_loc_'.$con_id);

    			$concern->urgency = $request->input('conc_urg_'.$con_id);

    			$concern->item = $field;

    			$concern->save();
    		}
    	}

    	// NEW CONCERNS

    	$new_concerns = $request->input('new_conc');

    	$new_areas = $request->input('new_conc_area');

    	$new_locations = $request->input('new_conc_loc');

    	$new_urgencies = $request->input('new_conc_urg');

    	if(!$new_concerns) $new_concerns = array(); // init empty

    	foreach($new_concerns as $key => $item){

    		$new_concern = new Concern;

    		$new_concern->section_id = $id;

    		$new_concern->area_id = $new_areas[$key];

    		$new_concern->item = $item;

    		$new_concern->location = $new_locations[$key];

    		$new_concern->urgency = $new_urgencies[$key];

    		$new_concern->save();
    	}

    	// DELETING CONCERNS

    	$concerns_to_delete = $request->input('conc_delete');

    	if(!$concerns_to_delete) $concerns_to_delete = array(); // init empty

    	foreach($concerns_to_delete as $concern_to_delete){

    		Concern::destroy($concern_to_delete);
    	}

    	// GENERAL SECTION ATTRIBUTES

    	$section = Section::find($id);

    	$section->limitations = $request->limitations;

    	$section->notes = $request->notes;

    	$section->save();

    	return redirect('/admin/report/'.$reportid);

    }

    public function addSectionImage(Request $request, $reportid, $id){

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $picture = date('His').$filename;
            $destinationPath = 'uploads';
            $image->move($destinationPath, $picture);
            
            $newImage = new Image;

            $newImage->section_id = $id;

            $newImage->caption = $request->caption;

            $newImage->file_path = '/uploads/'.$picture;

            $newImage->save();

            return redirect('/admin/report/'.$reportid.'/'.$id);

        }else{

            return redirect('/admin/report/'.$reportid.'/'.$id)->withErrors(['No image attached or file too large, upload aborted.']);
        }
    }

    public function deleteImage(Request $request, $reportid, $secid, $id){

        $image = Image::find($id);

        try{
            unlink($image->file_path);
        }catch(\Exception $e){};

        $image->delete();

        return redirect('/admin/report/'.$reportid.'/'.$secid);

    }
}
