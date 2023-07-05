<?php
//include library
include('library/tcpdf.php');
require('html_table.php');

    

$servername = "localhost";
$dbname ="hrsystemci";
$username ="root";
$password ="";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = base64_decode($this->input->get('I'));
$em_id = $_GET['em_id'];
$emp_id = $GET['emp_id'];
//$id= $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM `customer` WHERE em_id='$id'");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row)
{
    $first_name = $row['first_name'];
    $em_code =$row['em_code'];
    $em_address = $row['em_address'];
    $last_name = $row['last_name'];
    $est_no = $row['est_no'];
    $est_year = $row['est_year'];
    $cr_no = $row['cr_no'];
	$ccr_no = $row['ccr_no'];
    $startdate = $row['startdate'];
	$enddate = $row['enddate'];
    $bussiness_nature = $row['bussiness_nature'];
    $name_ass =$row['name_ass'];
}

//make tcpdf object
$pdf = new TCPDF('P','mm','A4');
//remove default header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


//add page
$pdf ->AddPage();

//add content 
$pdf->setfont('helvetica','B',14);
$pdf->WriteHTMLCell(150,15,'','',"Application For Customer Registration",0,0,'','','C','true');
$pdf->cell(40,15,"",0,1,'C');
$img_file = K_PATH_IMAGES.'tcpdf_logo1.png';
$pdf->Image($img_file, 150, 8, 35, 10, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

/*$image_file = 'logo2.png';
$pdf->Image($image_file, 170, 5, 70, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);*/
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"1",1);
$pdf->cell(40,8,"Name Of The Company",1);
$pdf->cell(110,8,"$first_name",1);
//$pdf->cell(40,8,"Registration no",1);
$pdf->cell(40,8,"Reg. No:$em_code",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"2",1);
$pdf->cell(40,8,"Office Address",1);
$pdf->cell(150,8,"$em_address",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"3",1);
$pdf->cell(40,8,"Legal Status",1);
$pdf->cell(150,8,"$last_name",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"4",1);
$pdf->cell(40,8,"Establishment No",1);
$pdf->cell(45,8,"$est_no",1);
$pdf->cell(55,8,"Year Of Establishment",1);
$pdf->cell(50,8,"$est_year",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"5",1);
$pdf->cell(40,8,"CR Number",1);
$pdf->cell(45,8,"$cr_no",1);
$pdf->cell(55,8,"Chamber of Commerce Reg No",1);
$pdf->cell(50,8,"$ccr_no",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"6",1);
$pdf->cell(40,8,"CR Issue Date",1);
$pdf->cell(45,8,"$startdate",1);
$pdf->cell(55,8,"CR Expiry Date",1);
$pdf->cell(50,8,"$enddate",1);
$pdf->ln();
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,8,"7",1);
$pdf->cell(40,8,"Nature Of Business",1);
$pdf->cell(150,8,"$bussiness_nature",1);
$pdf->ln();

$stmt = $conn->prepare("SELECT * FROM cus_address WHERE emp_id='$id'");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row)
{
   
	
    $address = $row['address'];
    $country = $row['country'];
    $per1_mob1 = $row['per1_mob1'];
    $per1_lan1 = $row['per1_lan1'];
    $per1_email = $row['per1_email'];
    $per1_other = $row['per1_other'];
}
$pdf -> setfont('helvetica','',10);
$pdf->cell(7,40,"8",1);
$pdf->cell(40,40,"Name and Address",1);
$pdf->cell(40,8,"Name",1);
$pdf->cell(110,8,"$address",1);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Designation",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$country",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Mobile Number",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$per1_mob1",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"LandLine Number ",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$per1_lan1",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"E-Mail",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$per1_email",1,0,);
$pdf->ln();
$pdf->cell(7,9,"9",1);

$pdf->WriteHTMLCell(40,9,'','',"Name of Associated Company , if any",1,0,);
$pdf->WriteHTMLCell(150,9,'','',"$name_ass",1,0,);
$pdf->ln();
$pdf->cell(7,15,"10",1);
$pdf->WriteHTMLCell(40,15,'','',"Person Authorized to sign LPO's",1,0,);
$pdf->WriteHTMLCell(75,15,'','',"Full Name & Designation",1,0,);
$pdf->WriteHTMLCell(75,15,'','',"Specimen Signature",1,0,);
$pdf->ln();
$pdf->cell(7,15,"11",1);
$pdf->WriteHTMLCell(40,15,'','',"Person Authorized to sign Cheque, Attach passport & QID copy",1,0,);
$pdf->WriteHTMLCell(75,15,'','',"Full Name & Designation",1,0,);
$pdf->WriteHTMLCell(75,15,'','',"Specimen Signature",1,0,);
$pdf->ln();
$pdf->cell(7,9,"12",1);
$pdf->WriteHTMLCell(115,9,'','',"Contact person in the absence of above with mobile No",1,0,);
$pdf->WriteHTMLCell(75,9,'','',"$per1_other",1,0,);
$pdf->ln();



$stmt = $conn->prepare("SELECT * FROM cus_bank_info WHERE `em_id`='$id'");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row)
{
  $bank_name = $row['bank_name'];
  $branch_name = $row['branch_name'];
  $holder_name = $row['holder_name'];
  $account_number = $row['account_number'];
  $account_type = $row['account_type'];
  $name_customer = $row['name_customer'];
  $designation_payment = $row['designation_payment'];
  $qid_payment = $row['qid_payment'];
  $mobile_number1 = $row['mobile_number1'];
  $mobile_number2 = $row['mobile_number2'];
  $mobile_number3 = $row['mobile_number3'];
  $mobile_number4 = $row['mobile_number4'];
  $e_mailpayment = $row['e_mailpayment'];
  $credit_amount = $row['credit_amount'];
  $credit_days = $row['credit_days'];
  $paymentsecurity = $row['paymentsecurity'];
}
$pdf->cell(7,40,"13",1);
$pdf->cell(40,40,"Bank Information",1);
$pdf->cell(40,8,"Bank Name",1);
$pdf->cell(110,8,"$bank_name",1);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Branch Name",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$branch_name",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Branch Address",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$holder_name",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"A/C No",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$account_number",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"IBAN No",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$account_type",1,0,);
$pdf->ln();
$pdf->cell(7,48,"14",1);
$pdf->WriteHTMLCell(40,48,'','',"Name of The executive to be contacted for payment",1,0,'','false','J','true');
$pdf->cell(150,8,"Full Name & Designation",1,0,'C');
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Name",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$name_customer [ $designation_payment ]",1,0);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"QID",1,0);
$pdf->WriteHTMLCell(110,8,'','',"$qid_payment",1,0);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Mobile No",1,0);
$pdf->WriteHTMLCell(110,8,'','',"$mobile_number1",1,0);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Landline No",1,0);
$pdf->WriteHTMLCell(110,8,'','',"$mobile_number3",1,0);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Email",1,0,);
$pdf->WriteHTMLCell(110,8,'','',"$e_mailpayment",1,0);
$pdf->ln();
$pdf->cell(7,9,"15",1);
$pdf->WriteHTMLCell(40,9,'','',"Amount of Credit Facility Requested",1,0);
$pdf->WriteHTMLCell(40,9,'','',"$credit_amount",1,0,);
$pdf->WriteHTMLCell(40,9,'','',"No of Days Credit period",1,0);
$pdf->WriteHTMLCell(70,9,'','',"$credit_days DAYS",1,0);
$pdf->ln();
$pdf->cell(7,9,"16",1);
$pdf->WriteHTMLCell(40,9,'','',"Payment Security",1,0);
$pdf->WriteHTMLCell(150,9,'','',"$paymentsecurity",1,0);
$pdf->ln();


$stmt = $conn->prepare("SELECT * FROM trade WHERE `em_id`='$id'");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row)
{
    $holder_name = $row['holder_name'];
    $holder_name1 = $row['holder_name1'];
    $name_ref = $row['name_ref'];
    $name_ref1 = $row['name_ref1'];
    $account_number = $row['account_number'];
    $branch_name1 = $row['branch_name1'];
    $ll_ref1 = $row['ll_ref1'];
    $ll_ref11 = $row['ll_ref11'];
    $e_mail1 = $row['e_mail1'];
    $e_mail11 = $row['e_mail11'];
}

$pdf->cell(7,40,"17",1);
$pdf->cell(40,40,"Trade Reference",1);
$pdf->cell(40,8,"Name",1);
$pdf->cell(55,8,"$holder_name",1);
$pdf->cell(55,8,"$holder_name1",1);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"QID",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$name_ref",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$name_ref1",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"Mobile No",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$account_number",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$branch_name1",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"LandLine No",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$ll_ref1",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$ll_ref11",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(40,8,'57','',"E-Mail",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$e_mail1",1,0,);
$pdf->WriteHTMLCell(55,8,'','',"$e_mail11",1,0,);
$pdf->ln();



$stmt = $conn->prepare("SELECT * FROM audit WHERE `em_id`='$id'");
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row)
{
    $holder_name = $row['holder_name'];
    //$holder_name1 = $row['holder_name1'];
    $name_ref = $row['name_ref'];
    //$name_ref1 = $row['name_ref1'];
    $account_number = $row['account_number'];
    $branch_name = $row['branch_name'];
    $ll_ref1 = $row['ll_ref1'];
    $ll_ref2 = $row['ll_ref2'];
    //$ll_ref11 = $row['ll_ref11'];
    $e_mail1 = $row['e_mail1'];
    $final_app = $row['final_app'];
    $next_review = $row['next_review'];
}

$pdf->cell(7,9,"18",1);
$pdf->WriteHTMLCell(40,9,'','',"Auditor Name & Address",1,0,);
$pdf->WriteHTMLCell(150,9,'','',"$holder_name , $name_ref",1,0);
$pdf->ln();
$pdf->cell(7,36,"19",1);
$pdf->WriteHTMLCell(40,36,'','',"Tick the Documents which are Attached",1,0,);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 88, 64, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);
$pdf->WriteHTMLCell(40,12,'','',"CR",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 118, 64, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(30,12,'','',"Establishment Card",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 158, 64, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'','',"Tax Card",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 198, 64, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'','',"Chamber of Commerce Certificate",1,1);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 88, 76, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'57','',"Passport of Owners",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 118, 76, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(30,12,'','',"QID of Owners",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 158, 76, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'','',"QID Copy of Authorized Signatories",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 198, 76, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'','',"PP Copy of Authorized Signatories",1,1);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 88, 88, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'57','',"Undated Postdated Cheque",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 118, 88, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(30,12,'','',"Audited Fiancial Stament",1,0);
$img_file1 = K_PATH_IMAGES.'box.png';
$pdf->Image($img_file1, 158, 88, 5, 5, '', 'PNG', '', false, 300, '', false, false, 0,false,false,false);

$pdf->WriteHTMLCell(40,12,'','',"Trade License",1,0);
$pdf->WriteHTMLCell(40,12,'','',"",1,0);
$pdf->ln();
$pdf->cell(7,10,"20",1);
$pdf->WriteHTMLCell(190,10,'','',"Terms & Conditions of credit facility granted by Aldana Technical Services & Engineering , All goods & services are sold in accordance with Aldana’s standard Terms & Conditions, and in line with specific contractual agreements. ",1,0,'','false','J','true');
$pdf->ln();
$pdf->cell(7,50,"21",1);
$pdf->WriteHTMLCell(190,50,'','',"a) Retention of title remains with Aldana until paid in full.<br/>
                                  b) Aldana reserve the right to increase, decrease or withdraw credit facilities without prior notice
                                  Upon cancellation of any credit facility, no further goods will be supplied to the Buyer including any goods subject to an order
                                 accepted by Aldana's legal entities, but not delivered prior to the date of exercising such discretion and further that Aldana 
                                 shall not be liable to the Buyer for any loss or damage which the Buyer may sustain as a result of the cancellation of credit 
                                 facilities.<br/>
                                 c) Dishonored payments will result in immediate review of credit facilities.<br/>
                                 d) Interest at the rate of 10% (annual) will be incurred if the agreed credit period is exceeded.<br/>
                                 e) The costs of collection of any overdue or unpaid invoices, including but not exclusively, the fees of any agent or solicitor engaged by any Aldana, shall be recoverable in full against the buyer.<br/>
                                 f) Delivery disputes must be conveyed in writing within 7 days, in order for any claim to be recognized by Aldana.",1,0,'','false','J','true');
$pdf->ln();
$pdf->cell(7,10,"22",1);
$pdf->WriteHTMLCell(190,10,'','',"I have read the Terms & Conditions of the credit facility and agree to abide by the Terms & Conditions therein. ",1,0,'','false','J','true');
$pdf->ln();
$pdf -> setfont('helvetica','C',10);
$pdf->cell(7,9,"",1,0);
$pdf->WriteHTMLCell(55,9,'','',"Signature",1,0);
$pdf->WriteHTMLCell(40,9,'','',"Name",1,0,);
$pdf->WriteHTMLCell(35,9,'','',"Date",1,0,);
$pdf->WriteHTMLCell(60,9,'','',"Company Stamp",1,0,);
$pdf->ln();
$pdf->cell(7,30,"",1,0);
$pdf->WriteHTMLCell(55,30,'','',"",1,0);
$pdf->WriteHTMLCell(40,30,'','',"",1,0,);
$pdf->WriteHTMLCell(35,30,'','',"",1,0,);
$pdf->WriteHTMLCell(60,30,'','',"",1,0,);
$pdf->ln();
$pdf->WriteHTMLCell(197,10,'','',"<b>For Office Use Only</b>",1,1,'','','C');
$pdf->cell(40,8,"Approved Credit Limt",1,0);
$pdf->cell(55,8,"$branch_name",1,0);
$pdf->cell(55,8,"Approved Credit Period",1,0);
$pdf->cell(47,8,"$account_number",1,0);
$pdf->ln();
$pdf->cell(40,8,"Terms of Payment",1,0);
$pdf->cell(157,8,"$ll_ref1",1,0);
$pdf->ln();
$pdf->cell(7,8,"23",1,0);
$pdf->cell(33,8,"",1,0);
$pdf->cell(52,8,"Reviewed By",1,0);
$pdf->cell(53,8,"Approved By",1,0);
$pdf->cell(52,8,"Final Approved By",1,0);
$pdf->ln();
$pdf->cell(7,8,"",1,0);
$pdf->cell(33,8,"Name",1,0);
$pdf->cell(52,8,"$ll_ref2",1,0);
$pdf->cell(53,8,"$e_mail1",1,0);
$pdf->cell(52,8,"$final_app",1,0);
$pdf->ln();
$pdf->cell(7,8,"",1,0);
$pdf->cell(33,8,"Signature",1,0);
$pdf->cell(52,8,"",1,0);
$pdf->cell(53,8,"",1,0);
$pdf->cell(52,8,"",1,0);
$pdf->ln();
$pdf->cell(7,8,"",1,0);
$pdf->cell(33,8,"Date",1,0);
$pdf->cell(52,8,"",1,0);
$pdf->cell(53,8,"",1,0);
$pdf->cell(52,8,"",1,0);
$pdf->ln();
$pdf->cell(7,8,"24",1,0);
$pdf->cell(33,8,"Next Review Date",1,0);
$pdf->cell(157,8,"$next_review",1,0);
$pdf->lastPage();

ob_clean();



//output
$pdf->Output(''.$first_name.'  CR.pdf', 'I');
//$pdf->Output();
?>