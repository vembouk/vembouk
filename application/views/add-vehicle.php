<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i>Vehicles</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Vehicles</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
  
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>vehicle/Vehicles" class="text-white"><i class="" aria-hidden="true"></i>  Vehicles List</a></button>
                    </div>
                </div>
               <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Add New Vehical<span class="pull-right " ></span></h4>
                            </div>
                            <?php echo validation_errors(); ?>
                               <?php echo $this->upload->display_errors(); ?>
                               
                               <?php echo $this->session->flashdata('formdata'); ?>
                               <?php echo $this->session->flashdata('feedback'); ?>
                            <div class="card-body">

                                <form class="row" method="post" action="Save" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Name Of The Vehicle</label>
                                        <input type="text" name="fname" class="form-control form-control-line" placeholder="Vehicle Name" > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Vehicle Number</label>
                                        <input type="text" id="" name="lname" class="form-control form-control-line" value="" placeholder="Vehicle Number" > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Istimara Expiry</label>
                                        <input type="text" id="" name="is_expiry" class="form-control mydatetimepickerFull" value="" placeholder="Istimara Expiry" > 
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Insurance Expiry</label>
                                        <input type="text" id="" name="in_expiry" class="form-control mydatetimepickerFull" value="" placeholder="Insurance Expiry" > 
                                    </div>
                                    
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Year Of Model</label>
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