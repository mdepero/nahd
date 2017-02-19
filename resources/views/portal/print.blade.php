<?php


require('pdf/fpdf.php');

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
	$this->Cell(100,8,$data[1][1][0],1,2,'R',true);
	$this->Cell(100,8,$data[1][7][0].' '.$data[1][8][0],1,2,'R',true);
	
	$this->SetFont('Arial','',11);
	$this->Cell(100,6,$data[1][3][0],1,0,'R',true);
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


function printImages($header,$form,$pdf){

	$currentImages = scandir("uploads/".$_REQUEST['table']."/".$form);
	if(sizeof($currentImages)>2){
		$pdf->AddPage();

		$pdf->SetFont('Arial','B',18);

		$pdf->Cell(190,15,$header,0,1,'C');

		$pdf->SetFont('Arial','',11);

		$x = 10;
		$y = 70;
		$col=0;
		$row = 0;
		foreach($currentImages as $value){
			if($value!='.'&&$value!='..'){
				$path = "uploads/".$_REQUEST['table']."/".$form."/".$value;
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
				$pdf->Text($x+10,$y+$ytextoffset,str_replace('NOCAPTION','',str_replace('_',' ',str_replace('~', ' ', str_replace('.jpg','',str_replace('.jpeg','',str_replace('.png','',$value)))))));
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
			}
		}//end foreach
	}//end files found in folder
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
$pdf->Cell(70,10,$data[1][7][0].' '.$data[1][8][0],'T',0,'L');
$pdf->Cell(30,10,'Home Phone: ','T',0,'R');
$pdf->Cell(30,10,$data[1][13][0],'TR',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'Address: ','L',0,'R');
$pdf->Cell(70,10,$data[1][9][0],0,0,'L');
$pdf->Cell(30,10,'Mobile Phone: ',0,0,'R');
$pdf->Cell(30,10,$data[1][14][0],'R',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'','L',0,'R');
$pdf->Cell(70,10,$data[1][10][0].', '.$data[1][11][0].' '.$data[1][12][0],0,0,'L');
$pdf->Cell(30,10,'Business Phone: ',0,0,'R');
$pdf->Cell(30,10,$data[1][15][0],'R',1,'L');

$pdf->Cell(30,10,'',0,0,'R');
$pdf->Cell(30,10,'Email: ','LB',0,'R');
$pdf->Cell(70,10,$data[1][16][0],'B',0,'L');
$pdf->Cell(30,10,'','B',0,'R');
$pdf->Cell(30,10,'','BR',1,'L');


$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,10,'Property ',0,0,'R');

$pdf->SetFont('Arial','',11);

$pdf->Cell(30,10,'Street: ','TL',0,'R');
$pdf->Cell(70,10,$data[1][1][0],'T',0,'L');
$pdf->Cell(30,10,'State: ','T',0,'R');
$pdf->Cell(30,10,$data[1][2][0],'TR',1,'L');

$pdf->Cell(30,10,'',0,0,'RB');
$pdf->Cell(30,10,'City: ','LB',0,'R');
$pdf->Cell(70,10,$data[1][4][0],'B',0,'L');
$pdf->Cell(30,10,'Zip Code: ','B',0,'R');
$pdf->Cell(30,10,$data[1][5][0],'RB',1,'L');


$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,10,'Inspection ',0,0,'R');

$pdf->SetFont('Arial','',11);

$pdf->Cell(30,10,'Date: ','TL',0,'R');
$pdf->Cell(70,10,$data[1][3][0],'T',0,'L');
$pdf->Cell(30,10,'Time: ','T',0,'R');
$pdf->Cell(30,10,$data[1][6][0],'TR',1,'L');

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

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Roofing ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][1][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Exterior ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][2][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Structure ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][3][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Electrical ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][4][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Heating ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][5][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Cooling ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][6][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Insulation ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][7][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Plumbing ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][8][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');

$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,15,'Interior ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][9][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');



$pdf->SetFont('Arial','B',15);

$pdf->Cell(120,15,'Overall Rating (1-Worst, 10-Best): ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(30,15,$data[12][10][0],0,1,'L');



$pdf->SetFont('Arial','B',15);

$pdf->Cell(30,13,'Final Notes ',0,0,'R');

$pdf->SetFont('Arial','',13);
$pdf->Cell(160,5,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[12][11][0],'LR','L');
$pdf->Cell(30,15,'',0,0,'R');
$pdf->Cell(160,5,'','LBR',1,'L');


printImages('Summary Images',12,$pdf);



$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Roofing',0,1,'L');

$form=2;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Roofing Materials ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Chimneys ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row **SPECIAL FOR INTEGER RANK*****
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Risk of Leaks (1-5) ',0,0,'R');
$pdf->SetFont('Arial','B',13);//BOLDED LETTER
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->Cell(10,5,$data[$form][3][0].' ','L','C',0);
$pdf->SetFont('Arial','',13);//UNBOLDED LETTER
$pdf->Cell(122,5,' (1=Lowest Risk, 5=High Risk)','R',1,'L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Roof ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Chimney ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][11][0],'LR','L');
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');



printImages('Roofing Report Images',$form,$pdf);



$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Exterior',0,1,'L');

$form=3;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Lot ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Gutters/Downspouts ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Exterior Walls ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Lot ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Gutters/Downspouts ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=11;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Windows ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=14;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Walls ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=17;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Siding ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=20;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Doors ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=23;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Porch/Landings ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=26;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Columns/Beams ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=29;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Garage/Carport ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=32;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Landscaping/Walks ',0,0,'R');//CHANGE LABEL******
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][35][0],'LR','L');
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Exterior Report Images',$form,$pdf);




$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Structure',0,1,'L');//Change Title*****

$form=4;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Structural Elements ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Foundations ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Floors ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Wall Structures ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][4][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][5][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=6;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Foundations ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=9;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Floors ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=12;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Beams ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=15;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Columns ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=18;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Concrete ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=21;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Walls ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=24;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Masonry ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=27;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Wood ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=30;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Steel ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=33;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Roofs ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=36;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Chimneys ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][39][0],'LR','L');//CHANGE NOTES ID***********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');



printImages('Structure Report Images',$form,$pdf);



$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Electrical',0,1,'L');//Change Title*****

$form=5;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'System Grounding ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Curcuit Interrupter ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Branch Circuit Wiring ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Outlets ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][4][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][5][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=6;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Conduit/Cable ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=9;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Service Box ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=15;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'System Grounding ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=12;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Panelboard ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=41;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Fuses/Breakers ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=18;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',10);
$pdf->Cell(49,8,'Ground/Arc Fault Interrupters ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=22;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Wires ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=25;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Knob-and-Tube ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=28;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Aluminum ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=31;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Receptacles ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=34;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Lights ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=37;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Appliances ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][40][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Electrical Report Images',$form,$pdf);




$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Heating',0,1,'L');//Change Title*****

$form=6;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Fuel ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Type ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Distribution ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row **SPECIAL FOR INTEGER RANK*****
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Efficiency ',0,0,'R');
$pdf->SetFont('Arial','B',13);//BOLDED LETTER
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->Cell(10,5,$data[$form][4][0].' ','L','C',0);
$pdf->SetFont('Arial','',13);//UNBOLDED LETTER
$pdf->Cell(122,5,' (1=Very Inefficient, 5=Very Efficient)','R',1,'L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Life Stage ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][5][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][6][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=7;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Fuel Tank/Piping ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=10;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Burner/Ventilation ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=13;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Thermostat ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=16;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Furnace ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=19;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Filter ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=22;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Ducts/Registers ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=25;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Boiler ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=28;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(49,8,'Expansion Tank/Valves ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=31;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Piping/Radiators ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=34;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Electric Heat ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][37][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Heating Report Images',$form,$pdf);



$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Cooling/Heat Pump',0,1,'L');//Change Title*****

$form=7;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Air Conditioning ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Cooling Capacity ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Estimated Life Stage ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Compressor ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Indoor Coil ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=11;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Outdoor Coil ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=14;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Indoor Fan ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=17;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Outdoor Fan ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=20;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Refrigerant Lines ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=23;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Condensate ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=26;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Ducts/Registers ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=29;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Thermostat ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=32;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Heat Pump ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=35;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Evaporative Cooler ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][38][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');






printImages('Cooling/Heating Pump Report Images',$form,$pdf);




$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Insulation',0,1,'L');//Change Title*****

$form=8;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Material ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Location/Amount ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Attic ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(49,8,'Basement/Crawlspace ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=11;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Walls ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=14;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Heat Recovery ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=17;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Air/Vapor Barrier ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=20;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Ventilation ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][23][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Insulation Report Images',$form,$pdf);



$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Plumbing',0,1,'L');//Change Title*****

$form=9;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Service Pipe to Home ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Supply Pipe in Home ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Water Heater Type ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Water Heater/Capacity ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][4][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][5][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=6;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Public Service Pipe ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=9;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Private Supply ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=12;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Piping in House ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=15;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Valves ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=18;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Water Heater ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=21;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Waste ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=24;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Traps/Floor Drains ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=27;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Venting ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=30;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Pumps ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=33;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Sink/Faucets ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=36;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Outdoor Faucet ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
$id=39;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Bathrooms ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][42][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Plumbing Report Images',$form,$pdf);





$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Interior',0,1,'L');//Change Title*****

$form=10;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Floors ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Walls ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Ceilings ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Window Type ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][4][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Exterior Door ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][5][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Fireplace Type ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][6][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][7][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Floors ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=11;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Walls ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=14;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Ceilings ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=17;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(49,8,'Trim/Cabinets/Counters ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=20;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Windows ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=23;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Doors ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=26;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Stairs ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=29;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Fireplace/Stove ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=32;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Basement ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=36;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Crawlspace/Attic ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=39;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',9);
$pdf->Cell(49,8,'Smoke/Carbon Monoxide Detectors ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][42][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');




printImages('Interior Report Images',$form,$pdf);




$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Appliances',0,1,'L');//Change Title*****

$form=11;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Range ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Oven ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Clothes Dryer ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][3][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Range ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=8;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Oven/Microwave ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=11;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(49,8,'Kitchen Exhause Fan ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=14;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Refrigerator ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=17;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Dishwasher ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=20;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Waste Disposer ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=23;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Trash Compactor ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=26;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Washing Machine ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}
//Concern Row
$id=29;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Clothes Dryer ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][32][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');


printImages('Appliances Report Images',$form,$pdf);


//TEMPLATE FOR EACH SECTION------------------------------------------------------
/*
$pdf->AddPage();

//HEADER
$pdf->SetFont('Arial','B',25);
$pdf->Cell(0,10,'Roofing',0,1,'L');//Change Title*****

$form=2;//CHANGE FORM*********************************************

//HR
$pdf->Cell(0,1,'',1,0,'C');
$pdf->Ln(10);

//BEGIN DATA

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Description',0,1,'L');

//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'RoofingMaterials ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][1][0],'LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');
//Desc Row
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58,11,'Chimneys ',0,0,'R');
$pdf->SetFont('Arial','',13);
$pdf->Cell(132,3,'','LRT',2,'L');
$pdf->MultiCell(132,5,$data[$form][2][0].'','LR','L');
$pdf->Cell(58,3,'',0,0,'L');
$pdf->Cell(132,3,'','LRB',1,'L');

$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Limitations to Report',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][4][0],'LR','L');//CHANGE LIMITATION NOTES
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

//Concern Row
$id=5;//CHANGE ID***************
if(!(count($data[$form][$id])==1&&$data[$form][$id][0]==''&&$data[$form][$id+1][0]==''&&$data[$form][$id+2][0]==''))
{
$pdf->SetFont('Arial','B',14);
$pdf->Cell(49,8,'Roof ',0,0,'R');//CHANGE LABEL
$pdf->SetFont('Arial','',10);
$int=0;
$first=true;
	foreach($data[$form][$id] as $entry)
	{
		if(!$first)
			$pdf->Cell(49,8,'',0,0,'R');
		$pdf->Cell(47,8,$data[$form][$id][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+1][$int],1,0,'C');
		$pdf->Cell(47,8,$data[$form][$id+2][$int],1,1,'C');
		$first=false;
		$int++;
	}
}


$pdf->Ln(6);

//Header 2
$pdf->SetFont('Arial','IU',18);
$pdf->Cell(0,15,'Section Notes',0,1,'L');

//Limitations/Notes
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LTR',2,'L');
$pdf->MultiCell(160,5,$data[$form][11][0],'LR','L');//CHANGE NOTES ID********
$pdf->Cell(30,3,'',0,0,'R');
$pdf->Cell(160,3,'','LBR',1,'L');

*/


$pdf->Output();




?>