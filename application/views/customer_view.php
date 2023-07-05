<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
                     <div class="page-wrapper">
                     <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-users" style="color:#1976d2"></i> <?php echo $basic->first_name .' '.$basic->last_name; ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
              <!--  <?php $degvalue = $this->customer_model->getdesignation(); ?>-->
               <!-- <?php $depvalue = $this->customer_model->getdepartment(); ?>-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" style="font-size: 14px;">  Company Info </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" style="font-size: 14px;">Contact</a> </li>
                               <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#education" role="tab" style="font-size: 14px;"> Education</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#experience" role="tab" style="font-size: 14px;"> Experience</a> </li>-->
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bank" role="tab" style="font-size: 14px;"> Bank Account</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#document" role="tab" style="font-size: 14px;"> Document</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#trade" role="tab" style="font-size: 14px;">Trade Reference</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#audit" role="tab" style="font-size: 14px;">Auditor & Approval</a> </li>
                               <!--  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#salary" role="tab" style="font-size: 14px;"> Salary</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#leave" role="tab" style="font-size: 14px;"> Leave</a> </li> -->
                                <!--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#social" role="tab" style="font-size: 14px;"> Social Media</a> </li>-->
                                <!-- <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab" style="font-size: 14px;"> Change Password</a> </li>
                                <?php } else { ?>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password1" role="tab" style="font-size: 14px;"> Change Password</a> </li>                                
                                <?php } ?>-->
                            </ul>
                            <!-- Tab panes -->

                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card">
				                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                   <?php if(!empty($basic->em_image)){ ?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basic->em_image; ?>" class="img-circle" width="150" />
                                    <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php echo $basic->first_name ?>" title="<?php echo $basic->first_name ?>"/>                                   
                                    <?php } ?>
                                    <h4 class="card-title m-t-10"><?php echo $basic->first_name .' '.$basic->last_name; ?></h4>
                                    <h6 class="card-subtitle"><?php echo $basic->des_name; ?></h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo $basic->em_email; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo $basic->em_phone; ?></h6> 
                                <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <a class="btn btn-circle btn-secondary" href="<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->facebook ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="btn btn-circle btn-secondary" href="<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->twitter ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a class="btn btn-circle btn-secondary" href="<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->skype_id ?>" target="_blank"><i class="fa fa-skype"></i></a>
                                <a class="btn btn-circle btn-secondary" href="<?php if(!empty($socialmedia->google_Plus)) echo $socialmedia->google_Plus ?>" target="_blank"><i class="fa fa-google"></i></a>
                            </div>
                        </div>                                                    
                                                </div>
                                                <div class="col-md-8">
				                                <form class="row" action="Update" method="post" enctype="multipart/form-data">
				                                    
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Registration No</label>
				                                        <input type="text" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="ID" name="eid" value="<?php echo $basic->em_code; ?>" required > 
				                                    </div>
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Name Of The Company</label>
				                                        <input type="text" class="form-control form-control-line" placeholder="Employee's FirstName" name="fname" value="<?php echo $basic->first_name; ?>" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Legal Status</label>
				                                        <input type="text" id="" name="lname" class="form-control form-control-line" value="<?php echo $basic->last_name; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Establishment Number</label>
				                                        <input type="text" id="" name="est_no" class="form-control form-control-line" value="<?php echo $basic->est_no; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                     <div class="form-group col-md-4 m-t-10">
				                                        <label>Year Of Establishment</label>
				                                        <input type="text" id="" name="est_year" class="form-control form-control-line" value="<?php echo $basic->est_year; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>CR Number</label>
				                                        <input type="text" id="" name="cr_no" class="form-control form-control-line" value="<?php echo $basic->cr_no; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Chamber of Commerce Reg No</label>
				                                        <input type="text" id="" name="ccr_no" class="form-control form-control-line" value="<?php echo $basic->ccr_no; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>CR Issue Date</label>
				                                        <input type="text" id="" name="startdate" class="form-control form-control-line" value="<?php echo $basic->startdate; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>CR Expiry Date</label>
				                                        <input type="text" id="" name="enddate" class="form-control form-control-line" value="<?php echo $basic->enddate; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Nature Of Business</label>
				                                        <input type="text" id="" name="bussiness_nature" class="form-control form-control-line" value="<?php echo $basic->bussiness_nature; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Name of Associated Company</label>
				                                        <input type="text" id="" name="name_ass" class="form-control form-control-line" value="<?php echo $basic->name_ass; ?>" placeholder="Employee's LastName" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
				                                    </div>
                                                   
                                                   <!--  <div class="form-group col-md-4 m-t-10">
                                                        <label>Blood Group </label>
                                                        <select name="blood" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php echo $basic->em_blood_group; ?>" class="form-control custom-select">
                                                            <option value="<?php echo $basic->em_blood_group; ?>"><?php echo $basic->em_blood_group; ?></option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="AB+">AB+</option>
                                                        </select>
                                                    </div>
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Gender </label>
				                                        <select name="gender" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select">
				                                           
				                                            <option value="<?php echo $basic->em_gender; ?>"><?php echo $basic->em_gender; ?></option>
				                                            <option value="Male">Male</option>
				                                            <option value="Female">Female</option>
				                                        </select>
				                                    </div>
                                                  <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>  <?php } else { ?> 
                                                    <div class="form-group col-md-4 m-t-10">
                                                        <label>User Type </label>
                                                        <select name="role" class="form-control custom-select" required >
				                                            <option value="<?php echo $basic->em_role; ?>"><?php echo $basic->em_role; ?></option>
                                                            <option value="HR">HR</option>
                                                            <option value="EMPLOYEE">Employee</option>
                                                            <option value="ADMIN">Super Admin</option>
                                                        </select>
                                                    </div>-->
                                                    <?php } ?>
                                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>  <?php } else { ?> 
                                                    <div class="form-group col-md-4 m-t-10">
                                                        <label>Status </label>
                                                        <select name="status" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select" required >
				                                            <option value="<?php echo $basic->status; ?>"><?php echo $basic->status; ?></option>
                                                            <option value="ACTIVE">ACTIVE</option>
                                                            <option value="INACTIVE">INACTIVE</option>
                                                        </select>
                                                    </div>
                                                    <?php } ?>				                                    
				                                   <!-- <div class="form-group col-md-4 m-t-10">
				                                        <label>Date Of Birth </label>
				                                        <input type="date" id="example-email2" name="dob" class="form-control" placeholder="" value="<?php echo $basic->em_birthday; ?>" required> 
				                                    </div>
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>NID Number </label>
				                                        <input type="text" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control"placeholder="NID Number" name="nid" value="<?php echo $basic->em_nid; ?>" minlength="10" required> 
				                                    </div>-->
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Contact Number </label>
				                                        <input type="text" class="form-control" placeholder="" name="contact"  value="<?php echo $basic->em_phone; ?>" minlength="10" maxlength="15"> 
				                                    </div>
                                                   <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>  <?php } else { ?> 				                                    
				                                   <!-- <div class="form-group col-md-4 m-t-10">
				                                        <label>Department</label>
				                                        <select name="dept" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select">
				                                            <option value="<?php echo $basic->id; ?>"><?php echo $basic->dep_name; ?></option>
                                            <?Php foreach($depvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->dep_name ?></option>
                                            <?php endforeach; ?>
				                                        </select>
				                                    </div>-->
				                                    <?php } ?>
                                                   <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>  <?php } else { ?> 				                                    
				                                   <!-- <div class="form-group col-md-4 m-t-10">
				                                        <label>Designation </label>
				                                        <select name="deg" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select">
				                                            <option value="<?php echo $basic->id; ?>"><?php echo $basic->des_name; ?></option>
                                            <?Php foreach($degvalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->des_name ?></option>
                                            <?php endforeach; ?>
				                                        </select>
				                                    </div>-->
				                                    <?php } ?>
				                                   <!-- <div class="form-group col-md-4 m-t-10">
				                                        <label>Date Of Joining </label>
				                                        <input type="date" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> id="example-email2" name="joindate" class="form-control" value="<?php echo $basic->em_joining_date; ?>" placeholder=""> 
				                                    </div>
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Contract End Date</label>
				                                        <input type="date" id="example-email2" name="leavedate" class="form-control" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php echo $basic->em_contact_end; ?>" placeholder=""> 
				                                    </div>-->
                                                    
				                                    <div class="form-group col-md-4 m-t-10">
				                                        <label>Email </label>
				                                        <input type="email" id="example-email2" name="email" class="form-control" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php echo $basic->em_email; ?>" placeholder="email@mail.com" minlength="7" required> 
				                                    </div>
                                                    <div class="form-group col-md-4 m-t-10">
                                        <label>Office Address</label>
                                        <input type="address"  name="address" class="form-control" value="<?php echo $basic->address; ?>" placeholder="Enter office Address"> 
                                    </div>
				                                    <div class="form-group col-md-12 m-t-10">
                                   <?php if(!empty($basic->em_image)){ ?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basic->em_image; ?>" class="img-circle" width="150" />
                                    <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php echo $basic->first_name ?>" title="<?php echo $basic->first_name ?>"/>                                   
                                    <?php } ?>
                                                        <label>Image </label>
                                                        <input type="file" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> name="image_url" class="form-control" value=""> 
                                                    </div>
                                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
				                                    <div class="form-actions col-md-12">
                                                        <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
				                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
				                                        <button type="button" class="btn btn-danger">Cancel</button>
				                                    </div>
				                                    <?php } ?>
				                                </form>
                                                </div>
                                        </div>
				                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card">
				                        <div class="card-body">
			                        		<h3 class="card-title">Person1 Contact Information</h3>
			                                <form class="row" action="Parmanent_Address" method="post" enctype="multipart/form-data">
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Name</label>
			                                        <input name="paraddress" value="<?php if(!empty($permanent->address)) echo $permanent->address  ?>" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control" rows="3" minlength="7"><?php if(!empty($permanent->address))  ?>
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Designation</label>
			                                        <input type="text" name="parcountry" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->country)) echo $permanent->country ?>" minlength="2"> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="per1_mob1" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_mob1)) echo $permanent->per1_mob1 ?>"> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="per1_mob2" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_mob1)) echo $permanent->per1_mob2 ?>"  > 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="per1_lan1" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_lan1)) echo $permanent->per1_lan1 ?>"> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="per1_lan2" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_lan1)) echo $permanent->per1_lan2 ?>" > 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>Contact Person in the absence of above with mobile no</label>
			                                        <input type="text" name="per1_other" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_other)) echo $permanent->per1_other ?>" > 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>E-Mail</label>
			                                        <input type="email" name="per1_email" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> value="<?php if(!empty($permanent->per1_email)) echo $permanent->per1_email ?>"  > 
			                                    </div>



                                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>			                                    
			                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id ?>">
                                                    <input type="hidden" name="id" value="<?php if(!empty($permanent->id)) echo $permanent->id  ?>">                                                    
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                    <?php } ?>			                                    
			                                    </form>
			                                    
			                                    <div class="">
			                        				<h3 class="col-md-12">Person2 Contact Information</h3>
			                                    </div>
			                                    <hr>
			                                <form class="row" action="Present_Address" method="post" enctype="multipart/form-data">			                                    
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Name</label>
			                                        <input name="presaddress" value="<?php if(!empty($present->address)) echo $present->address  ?>" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control" required><?php if(!empty($present->address))  ?>
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Designation</label>
			                                        <input type="text" name="prescountry" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->country  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="per1_mob1" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->per1_mob1  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="per1_mob2" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->per1_mob2  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="per1_lan1" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->per1_lan1  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="per1_lan2" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->per1_lan2  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
                                                <div class="form-group col-md-6 m-t-5">
			                                        <label>E-Mail</label>
                                                    <input type="email" name="per1_email" class="form-control form-control-line" placeholder="" value="<?php if(!empty($present->address)) echo $present->per1_email  ?>" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 

			                                    </div>
                                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>			                                    
			                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id ?>">
                                                    <input type="hidden" name="id" value="<?php if(!empty($present->id)) echo $present->id  ?>">
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                    <?php } ?>
			                                </form>
				                        </div>
                                    </div>
                                </div>
                            <!--    <div class="tab-pane" id="education" role="tabpanel">
                                    <div class="card">
                <div class="card-body">
                    <div class="table-responsive ">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Certificate</th>
                                    <th>Institute </th>
                                    <th>Result </th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID </th>
                                    <th>Certificate name</th>
                                    <th>Institute </th>
                                    <th>Result </th>
                                    <th>year</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                          <!--  <tbody>
                               <?php foreach($education as $value): ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->edu_type ?></td>
                                    <td><?php echo $value->institute ?></td>
                                    <td><?php echo $value->result ?></td>
                                    <td><?php echo $value->year ?></td>
                                   <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
                                    <td class="jsgrid-align-center ">
                                        <a href="#" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light education" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a onclick="confirm('Are you sure, you want to delete this?')" href="#" title="Delete" class="btn btn-sm btn-danger waves-effect waves-light edudelet"  data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>                                    
                                    </div>
                                    <div class="card">
                                      
	                                    <div class="card-body">
			                                <form class="row" action="Add_Education" method="post" enctype="multipart/form-data" id="insert_education">
			                                	<span id="error"></span>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Degree Title</label>
			                                        <input type="text" name="name" class="form-control form-control-line" placeholder=" Degree Title" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="1" required> 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Institute Name</label>
			                                        <input type="text" name="institute" class="form-control form-control-line" placeholder=" Institute Name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="3" required> 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Result</label>
			                                        <input type="text" name="result" class="form-control form-control-line" placeholder=" Result" minlength="2" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> required> 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Passing Year</label>
			                                        <input type="text" name="year" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="Passing Year"> 
			                                    </div>
			                                  <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
			                                    <div class="form-actions col-md-6">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                    <?php } ?>
			                                </form>
					                    </div>
                                    </div>
                                </div>-->
                              <!--  <div class="tab-pane" id="experience" role="tabpanel">
                                    <div class="card">
                <div class="card-body">
                    <div class="table-responsive ">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Company name</th>
                                    <th>Position </th>
                                    <th>Work Duration </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID </th>
                                    <th>Company name</th>
                                    <th>Position </th>
                                    <th>Work Duration </th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                          <!--  <tbody>
                               <?php foreach($experience as $value): ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->exp_company ?></td>
                                    <td><?php echo $value->exp_com_position ?></td>
                                    <td><?php echo $value->exp_workduration ?></td>
                                    <td class="jsgrid-align-center ">
                                       <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                       <?php } else { ?>
                                        <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light experience" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <a onclick="confirm('Are you sure, you want to delete this?')" href="#" title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletexp" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>                                     
	                                    <div class="card-body">
			                                <form class="row" action="Add_Experience" method="post" enctype="multipart/form-data">
			                                    	<div class="form-group col-md-6 m-t-5">
			                                    	    <label> Company Name</label>
			                                    	    <input type="text" name="company_name" class="form-control form-control-line company_name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="Company Name" minlength="2" required> 
			                                    	</div>
			                                    	<div class="form-group col-md-6 m-t-5">
			                                    	    <label>Position</label>
			                                    	    <input type="text" name="position_name" class="form-control form-control-line position_name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="Position" minlength="3" required> 
			                                    	</div>
			                                    	<div class="form-group col-md-6 m-t-5">
			                                    	    <label>Address</label>
			                                    	    <input type="text" name="address" class="form-control form-control-line duty" placeholder="Address" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="7" required> 
			                                    	</div>
			                                    	<div class="form-group col-md-6 m-t-5">
			                                    	    <label>Working Duration</label>
			                                    	    <input type="text" name="work_duration" class="form-control form-control-line working_period" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="Working Duration" required> 
			                                    	</div>
			                                 <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
		                                    	<div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">                                                
		                                    	    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
		                                    	</div>
		                                    	<?php } ?>
			                                </form>
					                    </div>
                                    </div>
                                </div>-->
                                <!-- Content Tab Start-->
                                <div class="tab-pane" id="bank" role="tabpanel">
                                    <div class="card">
	                                    <div class="card-body">
			                                <form class="row" action="Add_bank_info" method="post" enctype="multipart/form-data">
                                            <div class="form-group col-md-4 m-t-10">
			                                        <label>Bank Name</label>
			                                        <select name="bank_name" value="<?php if(!empty($bankinfo->bank_name)) echo $bankinfo->bank_name  ?>" class="form-control form-control-line" placeholder="Bank Name"  required> 
			                                  
                                                    <option value="<?php echo $bankinfo->bank_name; ?>"><?php echo $bankinfo->bank_name; ?></option>
                                                            <option value="Qatar National Bank">Qatar National Bank</option>
                                                            <option value="Doha Bank">Doha Bank</option>
                                                            <option value="Commercial Bank of Qatar">Commercial Bank of Qatar</option>
                                                            <option value="Qatar International Islamic Bank">Qatar International Islamic Bank</option>
                                                            <option value="Qatar Islamic Bank">Qatar Islamic Bank</option>
                                                            <option value="Qatar Development Bank">Qatar Development Bank</option>
                                                            <option value="Ahlibank">Ahlibank</option>
                                                            <option value="Masraf Al Rayan">Masraf Al Rayan</option>
                                                            <option value="Dukhan Bank">Dukhan Bank</option>
                                                            <option value="Arab Bank">Arab Bank</option>
                                                            <option value="Mashreq Bank">Mashreq Bank</option>
                                                            <option value="HSBC Bank">HSBC Bank</option>
                                                            <option value="Standard Chartered">Standard Chartered</option>
                                                    </select>
                                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Branch Name</label>
			                                        <input type="text" name="branch_name" value="<?php if(!empty($bankinfo->branch_name)) echo $bankinfo->branch_name  ?>" class="form-control form-control-line" placeholder=" Branch Name"> 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label> Branch Address</label>
			                                        <input type="text" name="holder_name" value="<?php if(!empty($bankinfo->holder_name)) echo $bankinfo->holder_name  ?>" class="form-control form-control-line" placeholder="Bank Holder Name" minlength="5" required> 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Account Number</label>
			                                        <input type="text" name="account_number" value="<?php if(!empty($bankinfo->account_number)) echo $bankinfo->account_number ?>" class="form-control form-control-line" minlength="5" required> 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>IBAN Number</label>
			                                        <input type="text" name="account_type" value="<?php if(!empty($bankinfo->account_type)) echo $bankinfo->account_type ?>" class="form-control form-control-line" placeholder="Bank Account Type"> 
			                                    </div>
                                           
			                        				<h3 class="col-md-12">Name Of The Executive To Be Contacted For Payment</h3>
			                                   
                                              
                                                <div class="form-group col-md-4 m-t-10">
                                                    <label>Name</label>
			                                        <input type="text" name="name_customer" value="<?php if(!empty($bankinfo->name_customer)) echo $bankinfo->name_customer ?>" class="form-control form-control-line" placeholder="Executive Name"> 
			                                    </div>
                                                
					<div class="form-group col-md-4 m-t-10">
						<label>Designation</label>
                        <input type="text" name="designation_payment" value="<?php if(!empty($bankinfo->designation_payment)) echo $bankinfo->designation_payment ?>" class="form-control form-control-line" placeholder="Enter Designation"> 
                        </div>
					
					<div class="form-group col-md-4 m-t-10">
						<label>QID Number</label>
                        <input type="text" name="qid_payment" value="<?php if(!empty($bankinfo->qid_payment)) echo $bankinfo->qid_payment ?>" class="form-control form-control-line" placeholder="Enter QID"> 
                        </div>
                       	<div class="form-group col-md-4 m-t-10">
						<label>Mobile Number</label>
                        <input type="text" name="mobile_number1" value="<?php if(!empty($bankinfo->mobile_number1)) echo $bankinfo->mobile_number1 ?>" class="form-control form-control-line"  minlength="10" maxlength="15"> 
                        </div>
					
						
					<div class="form-group col-md-4 m-t-10">
						<label>Mobile Number</label>
                        <input type="text" name="mobile_number2" value="<?php if(!empty($bankinfo->mobile_number2)) echo $bankinfo->mobile_number2 ?>" class="form-control form-control-line"  minlength="10" maxlength="15"> 
                        </div>
					
						
					<div class="form-group col-md-4 m-t-10">
						<label>Landline Number</label>
                        <input type="text" name="mobile_number3" value="<?php if(!empty($bankinfo->mobile_number3)) echo $bankinfo->mobile_number3 ?>" class="form-control form-control-line"  minlength="10" maxlength="15"> 
                        </div>
						
						
					<div class="form-group col-md-4 m-t-10">
						<label>Landline Number</label>
                        <input type="text" name="mobile_number4" value="<?php if(!empty($bankinfo->mobile_number4)) echo $bankinfo->mobile_number4 ?>" class="form-control form-control-line"  minlength="10" maxlength="15"> 
                        </div>
						
						
					<div class="form-group col-md-4 m-t-10">
						<label>E-Mail</label>
                        <input type="text" name="e_mailpayment" value="<?php if(!empty($bankinfo->e_mailpayment)) echo $bankinfo->e_mailpayment ?>" class="form-control form-control-line" placeholder="email@mail.com" minlength="7"> 
                        </div>
						
						
					<div class="form-group col-md-4 m-t-10">
						<label>Amount Of Credit Fecility Requested </label>
                        <input type="text" name="credit_amount" value="<?php if(!empty($bankinfo->credit_amount)) echo $bankinfo->credit_amount ?>" class="form-control form-control-line" placeholder="Enter The Amount Of Credit Fecility"> 
                        </div>
						
						
					<div class="form-group col-md-4 m-t-10">
						<label>Number Of Days Credit Period </label>
                        <input type="text" name="credit_days" value="<?php if(!empty($bankinfo->credit_days)) echo $bankinfo->credit_days ?>" class="form-control form-control-line" placeholder="Enter No Of Days"> 
                        </div>
						<table width="100%">
	<th>Payment Security</th>
	<tr>	
   <td>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="paymentsecurity" id="inlineRadio1" value="LC">
  <label class="form-check-label" for="inlineRadio1">LC</label>
  </div>
</td>
<td>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="paymentsecurity" id="inlineRadio2" value="Bank Gurantee">
  <label class="form-check-label" for="inlineRadio2">Bank Gurantee</label>
</div>
</td>
<td>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="paymentsecurity" id="inlineRadio3" value="Advance">
  <label class="form-check-label" for="inlineRadio3">Advance</label>
</div>
<td>
						</tr>
						<tr>
<td>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="paymentsecurity" id="inlineRadio4" value="PO Company Gurantee">
  <label class="form-check-label" for="inlineRadio4">PO Company Gurantee</label>
</div>
	</td>
	<td>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="paymentsecurity" id="inlineRadio5" value="Credit">
  <label class="form-check-label" for="inlineRadio5">Credit</label>
</div>
	</td>
</tr>
</table>
                                                
			                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
                                                    <input type="hidden" name="id" value="<?php if(!empty($bankinfo->id)) echo $bankinfo->id  ?>">
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                </form>
					                    </div>
                                    </div>
                                </div>
                                <!-- Content Tab end-->
                                <!-- Contact Tab start-->
                                <div class="tab-pane" id="trade" role="tabpanel">
                                    <div class="card">
	                                    <div class="card-body">
			                                <form class="row" action="Add_trade_info" method="post" enctype="multipart/form-data">
                                            <h3 class="col-md-12">Reference 1</h3>
                                            <div class="form-group col-md-4 m-t-10">
			                                        <label>Name</label>
			                                        <input type="text" name="holder_name" value="<?php if(!empty($tradeinfo->holder_name)) echo $tradeinfo->holder_name  ?>" class="form-control form-control-line" placeholder="" minlength="5" required> 
			                                    </div>
                                            <div class="form-group col-md-4 m-t-10">
			                                        <label>QID</label>
			                                        <input type="text" name="name_ref" value="<?php if(!empty($tradeinfo->name_ref)) echo $tradeinfo->name_ref  ?>" class="form-control form-control-line" placeholder="" minlength="5"> 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="branch_name" value="<?php if(!empty($tradeinfo->branch_name)) echo $tradeinfo->branch_name  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="account_number" value="<?php if(!empty($tradeinfo->account_number)) echo $tradeinfo->account_number ?>" class="form-control form-control-line"  > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref1" value="<?php if(!empty($tradeinfo->ll_ref1)) echo $tradeinfo->ll_ref1  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref2" value="<?php if(!empty($tradeinfo->ll_ref2)) echo $tradeinfo->ll_ref2 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>E-Mail</label>
			                                        <input type="email" name="e_mail1" value="<?php if(!empty($tradeinfo->e_mail1)) echo $tradeinfo->e_mail1?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <h3 class="col-md-12">Reference 2</h3>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>Name</label>
			                                        <input type="text" name="holder_name1" value="<?php if(!empty($tradeinfo->holder_name1)) echo $tradeinfo->holder_name1 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>QID</label>
			                                        <input type="text" name="name_ref1" value="<?php if(!empty($tradeinfo->name_ref1)) echo $tradeinfo->name_ref1  ?>" class="form-control form-control-line" placeholder="" > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="branch_name1" value="<?php if(!empty($tradeinfo->branch_name1)) echo $tradeinfo->branch_name1  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="account_number1" value="<?php if(!empty($tradeinfo->account_number1)) echo $tradeinfo->account_number1 ?>" class="form-control form-control-line"  > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref11" value="<?php if(!empty($tradeinfo->ll_ref11)) echo $tradeinfo->ll_ref11  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref21" value="<?php if(!empty($tradeinfo->ll_ref21)) echo $tradeinfo->ll_ref21 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>E-Mail</label>
			                                        <input type="email" name="e_mail11" value="<?php if(!empty($tradeinfo->e_mail11)) echo $tradeinfo->e_mail11?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <h3 class="col-md-12">Reference 3</h3>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>Name</label>
			                                        <input type="text" name="holder_name11" value="<?php if(!empty($tradeinfo->holder_name11)) echo $tradeinfo->holder_name11 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>QID</label>
			                                        <input type="text" name="name_ref11" value="<?php if(!empty($tradeinfo->name_ref11)) echo $tradeinfo->name_ref11  ?>" class="form-control form-control-line" placeholder="" > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="branch_name11" value="<?php if(!empty($tradeinfo->branch_name11)) echo $tradeinfo->branch_name11  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Mobile Number</label>
			                                        <input type="text" name="account_number11" value="<?php if(!empty($tradeinfo->account_number11)) echo $tradeinfo->account_number11 ?>" class="form-control form-control-line"  > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref111" value="<?php if(!empty($tradeinfo->ll_ref111)) echo $tradeinfo->ll_ref111  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>LandLine Number</label>
			                                        <input type="text" name="ll_ref211" value="<?php if(!empty($tradeinfo->ll_ref211)) echo $tradeinfo->ll_ref211 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>E-Mail</label>
			                                        <input type="email" name="e_mail111" value="<?php if(!empty($tradeinfo->e_mail111)) echo $tradeinfo->e_mail111?>" class="form-control form-control-line"  > 
			                                    </div>

			                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
                                                    <input type="hidden" name="id" value="<?php if(!empty($tradeinfo->id)) echo $tradeinfo->id  ?>">
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                </form>

                                            
					                    </div>
                                    </div>
                                </div>
                                <!-- Contact Tab End-->
                                <!-- Contact Tab start-->
                                <div class="tab-pane" id="audit" role="tabpanel">
                                    <div class="card">
	                                    <div class="card-body">
			                                <form class="row" action="Add_audit_info" method="post" enctype="multipart/form-data">
                                                 <div class="form-group col-md-4 m-t-10">
			                                        <label>Auditor Name</label>
			                                        <input type="text" name="holder_name" value="<?php if(!empty($auditinfo->holder_name)) echo $auditinfo->holder_name  ?>" class="form-control form-control-line" placeholder=""  required> 
			                                    </div>
                                            <div class="form-group col-md-4 m-t-10">
			                                        <label>Auditor Address</label>
			                                        <input type="text" name="name_ref" value="<?php if(!empty($auditinfo->name_ref)) echo $auditinfo->name_ref  ?>" class="form-control form-control-line" placeholder="" > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Approved Credit Limt</label>
			                                        <input type="text" name="branch_name" value="<?php if(!empty($auditinfo->branch_name)) echo $auditinfo->branch_name  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Approved Credit Period</label>
			                                        <input type="text" name="account_number" value="<?php if(!empty($auditinfo->account_number)) echo $auditinfo->account_number ?>" class="form-control form-control-line"  > 
			                                    </div>
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Terms of Payment</label>
			                                        <input type="text" name="ll_ref1" value="<?php if(!empty($auditinfo->ll_ref1)) echo $auditinfo->ll_ref1  ?>" class="form-control form-control-line" placeholder=""> 
			                                    </div>
                                               
			                                    <div class="form-group col-md-4 m-t-10">
			                                        <label>Reviewed By</label>
			                                        <input type="text" name="ll_ref2" value="<?php if(!empty($auditinfo->ll_ref2)) echo $auditinfo->ll_ref2 ?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>Approved By</label>
			                                        <input type="text" name="e_mail1" value="<?php if(!empty($auditinfo->e_mail1)) echo $auditinfo->e_mail1?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>Final Approved By</label>
			                                        <input type="text" name="final_app" value="<?php if(!empty($auditinfo->final_app)) echo $auditinfo->final_app?>" class="form-control form-control-line"  > 
			                                    </div>
                                                <div class="form-group col-md-4 m-t-10">
			                                        <label>Next Review Date</label>
			                                        <input type="date" name="next_review" value="<?php if(!empty($auditinfo->next_review)) echo $auditinfo->next_review?>" class="form-control form-control-line"  > 
			                                    </div>
                                               
			                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
                                                    <input type="hidden" name="id" value="<?php if(!empty($auditinfo->id)) echo $auditinfo->id  ?>">
			                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
			                                    </div>
			                                </form>

                                            
					                    </div>
                                    </div>
                                </div>
                                
                                <!-- Contact Tab End-->

                                <!-- Content Tab Start-->
                                <div class="tab-pane" id="document" role="tabpanel">
                                    <div class="card-body">
                    <div class="table-responsive ">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Certificate Name</th>
                                    <th>Certificate Expiry</th>
                                    <th>Certificate</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID </th>
                                    <th>File Title</th>
                                    <th>File </th>
                                </tr>
                            </tfoot> -->
                            <tbody>
                               <?php foreach($fileinfo as $value): ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo $value->file_title ?></td>
                                    <td><?php echo $value->exp_date ?></td>
                                    <td><a href="<?php echo base_url(); ?>assets/images/users/<?php echo $value->file_url ?>" target="_blank"><?php echo $value->file_url ?></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>                                    
                                    <div class="card-body">
                                        <form class="row" action="Add_File" method="post" enctype="multipart/form-data">
                                            <div class="form-group col-md-6 m-t-5">
                                                <label class="">Certificate Name</label>
                                                <select name="file_title" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select" aria-invalid="false" value="<?php if(!empty($value->file_title)) echo $value->file_title ?>" >
                                                            <option selected>Choose...</option>
                                                            <option value="Company Registration">Company Registration</option>
                                                            <option value="Establishment Card">Establishment Card</option>
                                                            <option value="Tax Card">Tax Card</option>
                                                            <option value="Trade License">Trade License</option>
                                                            <option value="Chamber of Commerce Certificate">Chamber of Commerce Certificate</option>
                                                            <option value="Passport of Owner as per CR">Passport of Owner as per CR</option>
                                                            <option value="QID Copy of Authorized Signatories">QID Copy of Authorized Signatories </option>
                                                            <option value="Passport Copy of Authorized Signatories">Passport Copy of Authorized Signatories</option>
                                                            <option value="Undated / Postdated Cheque">Undated / Postdated Cheque</option>
                                                            <option value="Audited Fiancial Statement">Audited Fiancial Statement</option>
                                                            <option value="Quality Certificate">Quality Certificate</option>
                                                            <option value="HSE Certificate">HSE Certificate</option>
                                                            <option value="ICV Certificate">ICV Certificate</option>
                                                    </select>
                                           
                                           
                                            </div>
                                            <div class="form-group col-md-6 m-t-5">
                                                <label class="">Certificate</label>
                                                <input type="file" name="file_url" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control" required="" aria-invalid="false" required>
                                            </div>
                                            <div class="form-group col-md-6 m-t-5">
                                                <label class="">Certificate Expiry Date</label>
                                                <input type="date" name="exp_date" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control" required="" aria-invalid="false" required>
                                            </div>
                                            <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="em_id" value="<?php echo $basic->em_id; ?>">                                                   
                                                    <button type="submit" class="btn btn-success">Add File</button>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="leave" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
			                        <div class="card">
			                            <div class="card-body">
			                                <h4 class="card-title"> Leave</h4>
                                            <form action="Assign_leave" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                <label class="">Leave Type</label>                                 
                                                 <select name="typeid" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="select2 form-control custom-select" style="width: 100%" id="" required>
                                                  <option value="">Select Here...</option>
                                                   <?php foreach($leavetypes as $value): ?>
                                                    <option value="<?php echo $value->type_id ?>"><?php echo $value->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>          
                                                </div>
			                                 <div class="form-group">
			                                    	<label>Day</label>
			                                    	<input type="number" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> name="noday" class="form-control form-control-line noday" placeholder="Leave Day" required> 
			                                 </div>

                                                <div class="form-group">
                                                <label class="">Year</label>  
                                                <select name="year" class="select2 form-control custom-select" style="width: 100%" id="" required>
                                                 <option value="">Select Here...</option>
                                                  <?php 
                                                   for ($x = 2016; $x < 3000; $x++){
                                                    echo '<option value='.$x.'>'.$x.'</option>';            
                                                   }
                                                    ?>
                                                </select>          
                                                </div>
                                                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>                 
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="em_id" value="<?php echo $basic->em_id; ?>">                                                   
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>                                                                     <?php } ?>         
                                            </form>
			                            </div>
			                        </div>                                          
                                    </div>
                                    <div class="col-md-6">
			                        <div class="card">
			                            <div class="card-body">
			                                <h4 class="card-title"> Leave/<?php echo date('Y') ?></h4>
                                            <table class="display nowrap table table-hover table-striped table-bordered" width="50%">
                                                <thead>
                                                   <tr class="m-t-50">
                                                    <th>Type</th>
                                                    <th>Dayout/Day</th>       
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php foreach($Leaveinfo as $value): ?>
                                                    <tr>
                                                        <td><?php echo $value->name; ?></td>
                                                        <td><?php echo $value->total_day; ?>/<?php echo $value->day; ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
			                            </div>
			                        </div>                                     
                                    </div>
                                  
                                </div>
                                </div>
                                <div class="tab-pane" id="password1" role="tabpanel">
                                    <div class="card-body">
				                                <form class="row" action="Reset_Password_Hr" method="post" enctype="multipart/form-data">
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Password</label>
				                                        <input type="text" class="form-control" name="new1" value="" required minlength="6"> 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Confirm Password</label>
				                                        <input type="text" id="" name="new2" class="form-control " required minlength="6"> 
				                                    </div>
				                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
				                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">                                                   
				                                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Save</button>
				                                    </div>
				                                    <?php } ?>
				                                </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="social" role="tabpanel">
                                    <div class="card-body">
				                                <form class="row" action="Save_Social" method="post" enctype="multipart/form-data">
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Facebook</label>
				                                        <input type="url" class="form-control" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> name="facebook" value="<?php if(!empty($socialmedia->facebook)) echo $socialmedia->facebook ?>" placeholder="www.facebook.com"> 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Twitter</label>
				                                        <input type="text" class="form-control" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> name="twitter" value="<?php if(!empty($socialmedia->twitter)) echo $socialmedia->twitter ?>" > 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Google +</label>
				                                        <input type="text" id="" name="google" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control " value="<?php if(!empty($socialmedia->google_plus)) echo $socialmedia->google_plus ?>"> 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Skype</label>
				                                        <input type="text" id="" name="skype" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control " value="<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->skype_id ?>"> 
				                                    </div>
				                                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
				                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">                                                   
                                                    <input type="hidden" name="id" value="<?php if(!empty($socialmedia->id)) echo $socialmedia->id ?>">                                                   
				                                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Save</button>
				                                    </div>
				                                    <?php } ?>
				                                </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="password" role="tabpanel">
                                    <div class="card-body">
				                                <form class="row" action="Reset_Password" method="post" enctype="multipart/form-data">
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Old Password</label>
				                                        <input type="text" class="form-control" name="old" value="" placeholder="old password" required minlength="6"> 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Password</label>
				                                        <input type="text" class="form-control" name="new1" value="" required minlength="6"> 
				                                    </div>
				                                    <div class="form-group col-md-6 m-t-20">
				                                        <label>Confirm Password</label>
				                                        <input type="text" id="" name="new2" class="form-control " required minlength="6"> 
				                                    </div>
				                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">                                                   
				                                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Save</button>
				                                    </div>
				                                </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="salary" role="tabpanel">
                                    <div class="card">
				                        <div class="card-body">
			                        		<h3 class="card-title">Basic Salary</h3>
			                                <form action="Add_Salary" method="post" enctype="multipart/form-data">
                                           <div class="row">
                                            <div class="form-group col-md-6 m-t-5">
                                                <label class="control-label">Salary Type</label>
                                                <select class="form-control <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> custom-select" data-placeholder="Choose a Category" tabindex="1" name="typeid" required>
                                                <!-- <option selected>Choose Type...</option> -->
                                                   <?php if(empty($salaryvalue->salary_type)){ ?>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $salaryvalue->id; ?>"><?php echo $salaryvalue->salary_type; ?></option>                         <?php } ?>                                      
                                                   <?php foreach($typevalue as $value): ?>
                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->salary_type; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> 
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Total Salary</label>
			                                        <input type="text" name="total" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line total" placeholder="Total Salary" value="<?php if(!empty($salaryvalue->total)) echo $salaryvalue->total ?>" minlength="3" required> 
			                                    </div>
                                                </div>
                                                 
			                                    <h3 class="card-title">Addition</h3>
			                                    <div class="row">
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Basic</label>
			                                        <input type="text" name="basic" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line basic" placeholder="Basic..." value="<?php if(!empty($salaryvalue->basic)) echo $salaryvalue->basic ?>" > 
			                                    </div> 
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>House Rent</label>
			                                        <input type="text" name="houserent" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line houserent" placeholder="House Rent..." value="<?php if(!empty($salaryvalue->house_rent)) echo $salaryvalue->house_rent ?>" > 
			                                    </div> 
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Medical</label>
			                                        <input type="text" name="medical" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line medical" placeholder="Medical..." value="<?php if(!empty($salaryvalue->medical)) echo $salaryvalue->medical ?>" > 
			                                    </div> 
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Conveyance</label>
			                                        <input type="text" name="conveyance" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line conveyance" placeholder="Conveyance..." value="<?php if(!empty($salaryvalue->conveyance)) echo $salaryvalue->conveyance ?>" > 
			                                    </div>
                                                </div>
                                                
			                                    <h3 class="card-title">Deduction</h3>
			                                    <div class="row">
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Insurance</label>
			                                        <input type="text" name="bima" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="Insurance" value="<?php if(!empty($salaryvalue->bima)) echo $salaryvalue->bima ?>"> 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Tax</label>
			                                        <input type="text" name="tax" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="Tax" value="<?php if(!empty($salaryvalue->tax)) echo $salaryvalue->tax ?>" > 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Provident Fund</label>
			                                        <input type="text" name="provident" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="Provident..." value="<?php if(!empty($salaryvalue->provident_fund)) echo $salaryvalue->provident_fund ?>"> 
			                                    </div>
			                                    <div class="form-group col-md-6 m-t-5">
			                                        <label>Others</label>
			                                        <input type="text" name="others" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="others..." value="<?php if(!empty($salaryvalue->others)) echo $salaryvalue->others ?>"> 
			                                    </div>
                                                </div>
                                                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    <?php } else { ?>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>"> 
                                                    <?php if(!empty($salaryvalue->salary_id)){ ?>    
                                                    <input type="hidden" name="sid" value="<?php echo $salaryvalue->salary_id; ?>">                                               <?php } ?> 
                                                    <?php if(!empty($salaryvalue->addi_id)){ ?>    
                                                    <input type="hidden" name="aid" value="<?php echo $salaryvalue->addi_id; ?>">                                                  <?php } ?> 
                                                    <?php if(!empty($salaryvalue->de_id)){ ?>
                                                    <input type="hidden" name="did" value="<?php echo $salaryvalue->de_id; ?>">
                                                    <?php } ?>                                                   
                                                    <button <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> disabled <?php } ?> type="submit" style="float: right" class="btn btn-success">Add Salary</button>
                                                </div>
                                                <?php } ?>
                                            </div>                                                		                                    
			                                    </form>
				                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
          <script type="text/javascript">
          $('.total').on('input',function() {
            var amount = parseInt($('.total').val());
            $('.basic').val((amount * .50 ? amount * .50 : 0).toFixed(2));
            $('.houserent').val((amount * .40 ? amount * .40 : 0).toFixed(2));
            $('.medical').val((amount * .05 ? amount * .05 : 0).toFixed(2));
            $('.conveyance').val((amount * .05 ? amount * .05 : 0).toFixed(2));
          });
          </script>
<?php $this->load->view('backend/em_modal'); ?>                
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".education").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#educationmodal').trigger("reset");
                                                $('#EduModal').modal('show');
                                                $.ajax({
                                                    url: 'educationbyib?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    // Populate the form fields with the data returned from server
													$('#educationmodal').find('[name="id"]').val(response.educationvalue.id).end();
                                                    $('#educationmodal').find('[name="name"]').val(response.educationvalue.edu_type).end();
                                                    $('#educationmodal').find('[name="institute"]').val(response.educationvalue.institute).end();
                                                    $('#educationmodal').find('[name="result"]').val(response.educationvalue.result).end();
                                                    $('#educationmodal').find('[name="year"]').val(response.educationvalue.year).end();
                                                    $('#educationmodal').find('[name="emid"]').val(response.educationvalue.emp_id).end();
												});
                                            });
                                        });
</script>                
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".experience").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#experiencemodal').trigger("reset");
                                                $('#ExpModal').modal('show');
                                                $.ajax({
                                                    url: 'experiencebyib?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    // Populate the form fields with the data returned from server
													$('#experiencemodal').find('[name="id"]').val(response.expvalue.id).end();
                                                    $('#experiencemodal').find('[name="company_name"]').val(response.expvalue.exp_company).end();
                                                    $('#experiencemodal').find('[name="position_name"]').val(response.expvalue.exp_com_position).end();
                                                    $('#experiencemodal').find('[name="address"]').val(response.expvalue.exp_com_address).end();
                                                    $('#experiencemodal').find('[name="work_duration"]').val(response.expvalue.exp_workduration).end();
                                                    $('#experiencemodal').find('[name="emid"]').val(response.expvalue.emp_id).end();
												});
                                            });
                                        });
</script>                
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".deletexp").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EXPvalueDelet?id=' + iid,
                                                    method: 'GET',
                                                    data: 'data',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                                                    window.setTimeout(function(){location.reload()},2000)
                                                    // Populate the form fields with the data returned from server
												});
                                            });
                                        });
</script>                 
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".edudelet").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EduvalueDelet?id=' + iid,
                                                    method: 'GET',
                                                    data: 'data',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                                                    window.setTimeout(function(){location.reload()},2000)
                                                    // Populate the form fields with the data returned from server
												});
                                            });
                                        });
</script>                

<?php $this->load->view('backend/footer'); ?>