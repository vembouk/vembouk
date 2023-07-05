<?php

$get_data = "SELECT * FROM customer";
$run_data = mysqli_query($conn,$get_data);

while($row = mysqli_fetch_array($run_data))
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
    $address = $row['address'];
    $country = $row['country'];
    $per1_mob1 = $row['per1_mob1'];
    $per1_lan1 = $row['per1_lan1'];
    $per1_email = $row['per1_email'];
    $per1_other = $row['per1_other'];
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
	echo "

<div id='print$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>
    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'><b>Do You Want To Print</b></h4> 
      </div>
	  
      <div class='modal-body'>
	  
        <form action='my_cv/report.php?id=$id' method='post' enctype='multipart/form-data'>
		<div class='col-sm-12 col-md-12'>
					<div class='form-group'> 
					<h4 class='text-primary'>$client_name Customer Registration Form</h4>
					</div>
					</div>
		<div class='modal-footer'>
			 <input type='hidden' name='print' value='print$id'>
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='YES'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>
        </form>
      </div>

    </div>

  </div>
</div>


	";
}


?>