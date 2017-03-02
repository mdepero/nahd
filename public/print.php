<?php


// if(!isset($_SESSION['report_access']) || $_SESSION['report_access'] != $_REQUEST['report']){
// 	die('<p>Sorry, for security reasons this page can only be accessed directly from your web portal and cannot be refreshed. Please go back to your <a href="/webportal">Web Portal</a> and open your report from there. Thank you.</p>');
// }

// $_SESSION['report_access'] = "";




require('pdf/fpdf.php');



$GLOBALS['report'] = $report;



class PDF extends FPDF
{
// Page header
function Header()
{	
	
	
	$this->Image('images/logo.png',10,10,90,0);
	$this->Image('images/backsplash.png',20,60,170,0);

    $this->SetFont('Arial','B',15);
	
	$this->SetFillColor(0,0,0);
	$this->SetTextColor(255,255,255);
	
	$this->Cell(90,20,'',0,0,'C',false);
    $this->Cell(100,8,'NAHD Official Property Report',1,2,'R',true);
	$this->Cell(100,8,$GLOBALS['report']->paddress,1,2,'R',true);
	$this->Cell(100,8,$GLOBALS['report']->fname.' '.$GLOBALS['report']->lname,1,2,'R',true);
	
	$this->SetFont('Arial','',11);
	$this->Cell(100,6,date('F d, Y',strtotime($GLOBALS['report']->date_inspection)),1,0,'R',true);
	$this->Ln();
	
	$this->SetTextColor(0,0,0);
	$this->SetFont('Arial','I',13);
	$this->Cell(100,7,'www.ohiohomeinspections.net',0,0,'L');
	$this->Cell(90,7,'contact@ohiohomeinspections.net',0,0,'R');
    $this->Ln(13);
	

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}
}


function printImages($section,$pdf){


	if(count($section->images) <= 0) return;


	$pdf->AddPage();

	$pdf->SetFont('Arial','B',18);

	$pdf->Cell(190,15,$section->fsection->label.' Images',0,1,'C');

	$pdf->SetFont('Arial','',11);

	$x = 10;
	$y = 70;
	$col=0;
	$row = 0;
	foreach($section->images as $image){
		$path = substr($image->file_path, 1);
		$imginfo = getimagesize($path);
		$ytextoffset = 65;
		if(($imginfo[0])>($imginfo[1])*1.5){
			//width greater than (8/5)*height
			$pdf->Image($path,$x,$y,90,'');
			$ytextoffset = 5 + (90*($imginfo[1]/$imginfo[0]));
		}
		else{
			$pdf->Image($path,$x,$y,'',60);
		}
		$pdf->Text($x+10,$y+$ytextoffset,$image->caption);
		$x += 100;
		if(++$col==2){
			$col=0;
			$x=10;
			$y+= 72;
			$row++;
		}
		if($row==3){
			$row=0;
			$pdf->AddPage();
			$x=10;
			$y=70;
		}
	}//end foreach
}//end print images








$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();

//TOTAL UNITS ACROSS IS 190****




//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Client/Property Information',0,1,'L');

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//DATA BEGIN
$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,10,'Client ',0,0,'R');

$pdf->SetFont('Arial','',11);

$pdf->Cell(30,10,'Name: ','TL',0,'R');
$pdf->Cell(70,10,$report->fname.' '.$report->lname,'T',0,'L');
$pdf->Cell(30,10,'Home Phone: ','T',0,'R');
$pdf->Cell(30,10,$report->chome_phone,'TR',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'Address: ','L',0,'R');
$pdf->Cell(70,10,$report->caddress,0,0,'L');
$pdf->Cell(30,10,'Mobile Phone: ',0,0,'R');
$pdf->Cell(30,10,$report->cmobile_phone,'R',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'','L',0,'R');
$pdf->Cell(70,10,$report->ccity.', '.$report->cstate.' '.$report->czip,0,0,'L');
$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,"",'R',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'Email: ','LB',0,'R');
$pdf->Cell(70,10,$report->email,'B',0,'L');
$pdf->Cell(30,10,'','B',0,'R');
$pdf->Cell(30,10,'','BR',1,'L');


$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,10,'Property ',0,0,'R');

$pdf->SetFont('Arial','',11);

$pdf->Cell(30,10,'Street: ','TL',0,'R');
$pdf->Cell(70,10,$report->paddress,'T',0,'L');
$pdf->Cell(30,10,'State: ','T',0,'R');
$pdf->Cell(30,10,$report->pstate,'TR',1,'L');

$pdf->Cell(30,10,'',0,0,'RB');
$pdf->Cell(30,10,'City: ','LB',0,'R');
$pdf->Cell(70,10,$report->pcity,'B',0,'L');
$pdf->Cell(30,10,'Zip Code: ','B',0,'R');
$pdf->Cell(30,10,$report->pzip,'RB',1,'L');


$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,10,'Inspection ',0,0,'R');

$pdf->SetFont('Arial','',11);

$pdf->Cell(30,10,'Date: ','TL',0,'R');
$pdf->Cell(70,10,date('F d, Y',strtotime($report->date_inspection)),'T',0,'L');
$pdf->Cell(30,10,'Time: ','T',0,'R');
$pdf->Cell(30,10,$report->time_inspection,'TR',1,'L');

$pdf->Cell(30,10,'',0,0,'RB');
$pdf->Cell(30,10,'Type: ','LB',0,'R');
$pdf->Cell(70,10,'Full Property Inspection','B',0,'L');
$pdf->Cell(30,10,'','B',0,'R');
$pdf->Cell(30,10,'','RB',1,'L');


$pdf->Ln();

//HEADER
$pdf->SetFont('Arial','B',17);
$pdf->Cell(0,8,'Note to the Client',0,1,'L');

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(4);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,12,'When Things Go Wrong','LTR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'There may come a time that you discover something wrong with the house, and you may wonder if your home inspector let you down. There are a few things to consider:','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Intermittent or Concealed Problems','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'Some problems can only be discovered by living in a house. They cannot be discovered during the few hours of a home inspection. For example, some shower stalls leak when water bounces off people in the shower, but do not leak when you simply turn on the tap. Some roofs and basements only leak when the rain is very heavy or is accompanied by wind from a certain direction. Some problems will be discovered when carpets are lifted, furniture and boxes are moved or finishes are removed.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'No Clues','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'These problems may have existed at the time of the inspection but there were no clues to their existence. Lawyers call these latent defects. Our inspections are based on past performance of the house. If there are no clues to the past problem, it is unfair to assume we should foresee a future problem. Home inspectors do not identify latent defects.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'We Always Miss Some Minor Things','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'Some say we are inconsistent because our reports identify some minor problems but not others. Any minor problems noted were discovered while looking for significant problems that would affect the typical person\'s decision to purchase. We note these simply as a courtesy.','LRB','L');

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Sampling Exercise','LTR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'A home inspection is a sampling exercise with respect to components that are numerous, such as bricks, windows, and electrical outlets. Home inspections would take many hours more if each component was to be checked. As a result, some conditions that are visible may go unreported. This is not a failing of the inspector but a result of sampling.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Contractors\' Advice','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'A common source of concern with home inspectors comes from comments made by contractors. Contractors\' opinions often differ from ours. Don\'t be surprised that three roofers all say the roof needs replacement when we said that, with some minor repairs, the roof will last a few more years.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Last Man In Theory','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'While our advice represents the most prudent action in our professional opinion, many contractors are reluctant to undertake these repairs. This is because of the "Last Man In Theory." The contractor fears that if he is the last person to work on the roof, he will be blamed if the roof leaks, whether or not the leak is his fault. Consequently, he won\'t want to do minor repair with high liability when he could re-roof the entire house for more money and reduce the likelihood of a callback. This is understandable.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Most Recent Advice is Best','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'There is more to the "Last Man in Theory." It is human nature for homeowners to believe the last "expert" advice they receive, even if it is contrary to previous advice. As home inspectors, we unfortunately find ourselves in the position of "First Man In" and consequently it is our advice that is often disbelieved.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Why Didn\'t We See it?','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'Contractors and others may say "I can\'t believe you had this house inspected, and they didn\'t find this problem." There are several reasons for these apparent oversights:','LR','L');

$pdf->Cell(5,4,'1.','L',0,'R');
$pdf->Cell(185,4,'It is difficult for homeowners to remember the circumstances of the house, at the time of the inspection. It\'s easy to','R',1,'L');
$pdf->Cell(5,12,'','L',0,'R');
$pdf->MultiCell(185,4,'forget that is was snowing, there were boxes everywhere in the basement or that the furnace could not be turned on because the air conditioning was operating, et cetera. It\'s impossible for contractors to know what the circumstances were when the inspection was performed.','R','L');

$pdf->Cell(5,4,'2.','L',0,'R');
$pdf->Cell(185,4,'When the problem manifests itself, it is very easy to have 20/20 hindsight. Anybody can say that the basement leaks','R',1,'L');
$pdf->Cell(5,4,'','L',0,'R');
$pdf->MultiCell(185,4,'where there are 2 inches of water on the floor. Predicting the problem is a different story.','R','L');

$pdf->Cell(5,4,'3.','L',0,'R');
$pdf->Cell(185,4,'If we spent 1/2 an hour under a kitchen sink or 2 hours removing every electrical switch plate and cover plate, we\'d','R',1,'L');
$pdf->Cell(5,4,'','L',0,'R');
$pdf->MultiCell(185,4,'find more problems too. Unfortunately, the inspection would take several days and would cost considerably more.','R','L');

$pdf->Cell(5,4,'4.','L',0,'R');
$pdf->Cell(185,4,'We are generalists; we are not specialists. The heating contractor may indeed have more heating experience','R',1,'L');
$pdf->Cell(5,12,'','L',0,'R');
$pdf->MultiCell(185,4,'than we do. This is because we are expected to have heating expertise and plumbing expertise, roofing expertise, electrical expertise, et cetera. A home inspector is a generalist the same way a family doctor is a generalist. They have a wonderfully broad knowledge, but are not cardiologists or respirologists.','R','L');

$pdf->Cell(5,4,'5.','L',0,'R');
$pdf->Cell(185,4,'Problems often become apparent when carpets or plaster are removed, when fixtures or cabinets are pulled out, and','R',1,'L');
$pdf->Cell(5,8,'','L',0,'R');
$pdf->MultiCell(185,4,'so on. Many issues appear once work begins on a home. A home inspection is a visual examination. We don\'t perform any invasive or destructive tests','R','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,9,'Not Insurance','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'In conclusion, a home inspection is designed to better your odds. It is not designed to eliminate risk. For that reason, a home inspection should not be considered an insurance policy. The premium that an insurance company would have to charge for a policy with no deductible, no exclusions, no limits and an indefinite period would be a multiple of the fee we charge. It would also not include the knowledge added by the inspection.','LR','L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,4,'','LR',1,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(190,4,'Thank you again for choosing the New Age Home Detectives.','LR','L');

$pdf->Cell(0,4,'','LBR',1,'L');






$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Report Summaries',0,1,'L');

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

// =========== LOOP SUMMARY ==============
foreach($report->sections as $section){

$pdf->SetFont('Arial','B',15);

$sec_title = $section->fsection->label;
if($sec_title == "Cooling/Head Pump"){
	$sec_title = "Cooling";
}
$pdf->Cell(30,15,$sec_title,0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$section->summary,'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');


}
// ============= END LOOP SUMMARY ==================



$pdf->SetFont('Arial','B',15);

$pdf->Cell(120,15,'Overall Rating (1-Worst, 10-Best): ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(30,15,$report->rating,0,1,'L');



$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,13,'Final Notes ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$report->final_remarks,'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');


//***************************************printImages('Summary Images',12,$pdf);


// ====================== LOOP SECTIONS ====================================
foreach($report->sections as $section){
$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,$section->fsection->label,0,1,'L');


//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);


$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');


// ========== LOOP DESCRIPTION =========
foreach($section->descriptions as $description){
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,$description->area->label,0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$description->value,'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

}
// ======== END LOOP DESCRIPTION ========

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$section->limitations,'LR','L');
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Areas of Concern',0,1,'L');

//Concern Heading
$pdf->SetFont('Arial','BI',15);
$pdf->Cell(49,5,'',0,0,'L');
$pdf->Cell(47,5,'Item/Issue',0,0,'C');
$pdf->Cell(47,5,'Location',0,0,'C');
$pdf->Cell(47,5,'Urgency',0,1,'C');

// ====== LOOP CONCERNS ==========
$area = -1;
foreach($section->concerns as $concern){
if($concern->area->id == $area)
	continue;
else
	$area = $concern->area->id;
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,$concern->area->label,0,0,'R');
$pdf->SetFont('Arial','',5);
$int=0;
$first=true;
	foreach($section->concerns as $concern)
	{
		if($concern->area->id != $area)
			continue;
		$pdf->SetFont('Arial','',5);
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		if(strlen($concern->item) > 40)
			$pdf->SetFont('Arial','',5);
		$pdf->Cell(47,8,$concern->item,1,0,'C');
		$pdf->SetFont('Arial','',10);
		if(strlen($concern->location) > 40)
			$pdf->SetFont('Arial','',5);
		$pdf->Cell(47,8,$concern->location,1,0,'C');
		$pdf->SetFont('Arial','',10);
		if(strlen($concern->item) > 40)
			$pdf->SetFont('Arial','',5);
		$pdf->Cell(47,8,$concern->urgency,1,1,'C');
		$first=false;
		//$int++;
	}


}
// ======= END LOOP CONCERNS

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$section->notes,'LR','L');
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');



printImages($section,$pdf);



}
// ============================== END SECTION LOOP ==================================



///$pdf->Output();




?>