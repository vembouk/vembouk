<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Staffs</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
   <!-- <?php $degvalue = $this->customer_model->getdesignation(); ?>-->
    <!--<?php $depvalue = $this->customer_model->getdepartment(); ?>-->
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>customer/Customers" class="text-white"><i class="" aria-hidden="true"></i>  Customer List</a></button>
                        <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>customer/Disciplinary" class="text-white"><i class="" aria-hidden="true"></i>  Disciplinary List</a></button>-->
                    </div>
                </div>
               <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Add New Customer<span class="pull-right " ></span></h4>
                            </div>
                            <?php echo validation_errors(); ?>
                               <?php echo $this->upload->display_errors(); ?>
                               
                               <?php echo $this->session->flashdata('formdata'); ?>
                               <?php echo $this->session->flashdata('feedback'); ?>
                            <div class="card-body">

                                <form class="row" method="post" action="Save" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Name Of The Company</label>
                                        <input type="text" name="fname" class="form-control form-control-line" placeholder="Company Name" minlength="2"  > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Legal Status</label>
                                        <input type="text" id="" name="lname" class="form-control form-control-line" value="" placeholder="Company Legal Status" minlength="2" > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Registration Number</label>
                                        <input type="text" name="eid" class="form-control form-control-line" placeholder="Example:QARQAC820"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Establishment Number</label>
                                        <input type="text" name="est_no" class="form-control form-control-line" placeholder="Establishment Number"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Year Of Establishment</label>
                                        <?php
										$already_selected_value = 2050;
										$earliest_year = 1990;

										print '<select type="text" class="form-control" name="est_year">';
										foreach (range(date('Y'), $earliest_year) as $x) {
											print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
										}
										print '</select>';
										?>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>CR Number</label>
                                        <input type="text" name="cr_no" class="form-control form-control-line" placeholder="CR Number"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
									<label>Chamber of Commerce Reg No</label>
									<input type="text"   class="form-control form-control-line" placeholder="Enter CCR Number" name="ccr_no" >
									</div>
									<div class="form-group col-md-3 m-t-20">
									<label for="inputPassword4">CR Issue Date<b style="color:#990000">*</b></label>
									<input type="date"  class="form-control form-control-line" name="startdate" >
									</div>
									<div class="form-group col-md-3 m-t-20">
									<label for="inputPassword4">CR Expiry Date <b style="color:#990000">*</b></label>
									<input type="date"   class="form-control form-control-line" name="enddate" >
									</div>
									<div class="form-group col-md-3 m-t-20">
									<label for="inputPassword4">Nature Of Business</label>
									<input type="text" placeholder="Enter Bussiness Nature" class="form-control form-control-line" name="bussiness_nature" >
									</div>
									<div class="form-group col-md-3 m-t-20">
									<label for="inputPassword4">Name of Associated Company , if any</label>
									<input type="text" placeholder="Enter Company Name" class="form-control" name="name_ass"  >
									</div>
                                   <!-- <div class="form-group col-md-3 m-t-20">
                                        <label>Department</label>
                                        <select name="dept" value="" class="form-control custom-select" >
                                            <option>Select Department</option>
                                            <?Php foreach($depvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->dep_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>-->
                                    <!--<div class="form-group col-md-3 m-t-20">
                                        <label>Designation </label>
                                        <select name="deg" class="form-control custom-select" >
                                            <option>Select Designation</option>
                                            <?Php foreach($degvalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->des_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>-->
                                    <!--<div class="form-group col-md-3 m-t-20">
                                        <label>Role </label>
                                        <select name="role" class="form-control custom-select" >
                                            <option>Select Role</option>
                                            <option value="ADMIN">ADMIN</option>
                                            <option value="EMPLOYEE">Employee</option>
                                            <option value="SUPER ADMIN">Super Admin</option>
                                        </select>
                                    </div>-->
                                  <!--  <div class="form-group col-md-3 m-t-20">
                                        <label>Gender </label>
                                        <select name="gender" class="form-control custom-select" >
                                            <option>Select Gender</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Blood Group </label>
                                        <select name="blood" class="form-control custom-select">
                                            <option>Select Blood Group</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>QID</label>
                                        <input type="text" name="nid" class="form-control" value="" placeholder="(Max. 10)" minlength="10" > 
                                    </div>-->
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Contact Number </label>
                                        <input type="text" name="contact" class="form-control" value="" placeholder="1234567890" minlength="10" maxlength="15"> 
                                    </div>
                                    <!--<div class="form-group col-md-3 m-t-20">
                                        <label>Date Of Birth </label>
                                        <input type="date" name="dob" id="example-email2" name="example-email" class="form-control" placeholder="" > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Date Of Joining </label>
                                        <input type="date" name="joindate" id="example-email2" name="example-email" class="form-control" placeholder=""> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Contract End Date </label>
                                        <input type="date" name="leavedate" id="example-email2" name="example-email" class="form-control" placeholder=""> 
                                    </div>-->
                                   <!-- <div class="form-group col-md-3 m-t-20">
                                        <label>Username </label>
                                        <input type="text" name="username" class="form-control form-control-line" value="" placeholder="Username"> 
                                    </div>-->
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Email </label>
                                        <input type="email" id="example-email2" name="email" class="form-control" placeholder="email@mail.com" minlength="7"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Office Address</label>
                                        <input type="address"  name="address" class="form-control" placeholder="Enter office Address"> 
                                    </div>
                                    <!--
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Password </label>
                                        <input type="text" name="password" class="form-control" value="" placeholder="**********"> 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Confirm Password </label>
                                        <input type="text" name="confirm" class="form-control" value="" placeholder="**********"> 
                                    </div>-->
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Image </label>
                                        <input type="file" name="image_url" class="form-control" value=""> 
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>