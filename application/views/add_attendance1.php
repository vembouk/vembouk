<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!--Breadcum START-->
            <?php 
                //$breadcum=(null!==(adminBreadcum()) && adminBreadcum()!='' ? explode(',',adminBreadcum()) : '');
                if(isset($breadcum) && !empty($breadcum)){
            ?>
                <div class="col-sm-6">
                    <h1><?php echo $breadcum[0];?></h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <?php for($i=count($breadcum)-1;$i>=0;$i--){?>
                        <?php if($i==0){?>
                            <li class="breadcrumb-item active"><?php echo $breadcum[$i];?></li>
                        <?php }else{?>
                            <li class="breadcrumb-item"><a href="#"><?php echo $breadcum[$i];?></a></li>
                        <?php }?>
                    <?php }?>
                </ol>
            <?php }?>
        <!--Breadcum START-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php echo form_open(site_url('payroll/action/attendance/add'),array('class'=>'ajax-form','data-form-validate'=>'true','novalidate'=>'novalidate'));?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ajax-message"></div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('getSuccess'); ?>
                            </div>
                        </div>
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Employee List</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mb-3">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sl No</th>
                                            <th width="30%">Employee No & Name</th>
                                            <th width="15%">Department</th>
                                            <th width="15%">Project</th>
                                            <th width="15%">Status</th>
                                            <th width="15%">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $hasEmp=false;if(isset($employee) && !empty($employee)){$ecount=1;?>
                                            <?php 
                                                if(!empty($self)){
                                                    array_push($employee,$self);
                                                }
                                            ?>
                                            <?php foreach($employee as $emp){?>
                                                <?php if($emp->attid==''){?>
                                                    <?php $hasEmp=true;?>
                                                    <input type="hidden" name="data[attendance][empid][]" value="<?php echo $emp->ipy_id;?>"/>
                                                    <tr>
                                                        <td><?php echo $ecount++;?></td>
                                                        <td><?php echo getEmployeeNo($emp->ipy_id).' - '.$emp->ipy_fname.' '.$emp->ipy_sname.' '.$emp->ipy_tname.' '.$emp->ipy_lname;?></td>
                                                        <td><?php echo (isset($emp->dept_name) && $emp->dept_name!='' ? $emp->dept_name : '-');?></td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control" name="data[attendance][project][]">
                                                                    <option value="">Select</option>
                                                                    <option value="0">Backend (For office employee)</option>
                                                                    <?php if(isset($projects) && !empty($projects)){?>
                                                                        <?php foreach($projects as $pro){?>
                                                                            <option value="<?php echo $pro->ipy_id;?>"><?php echo $pro->ipy_name;?></option>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control attendance-present-status" name="data[attendance][status][]">
                                                                    <option value="">Select Status</option>
                                                                    <option value="Present">Present</option>
                                                                    <option value="Absent" selected="selected">Absent</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-lg-6 pr-0 forpresent" style="display:none;">
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="data[attendance][ottype][]">
                                                                            <option value="">-</option>
                                                                            <option value="1">OT1</option>
                                                                            <option value="2">OT2</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 forpresent" style="display:none;">
                                                                    <div class="form-group">
                                                                        <input type="number" min="0" class="form-control" name="data[attendance][ottime][]" placeholder="Hrs"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 forleave" style="display:none;">
                                                                    <div class="form-group">
                                                                        <select class="form-control required" name="data[attendance][leavetype][]">
                                                                            <option value="">Select</option>
                                                                            <?php if(isset($leaves) && !empty($leaves)){?>
                                                                                <?php foreach($leaves as $leave){?>
                                                                                    <option value="<?php echo $leave->ipy_id;?>"><?php echo $leave->ipy_name;?></option>
                                                                                <?php }?>
                                                                            <?php }?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                            <?php }?>
                                        <?php }?>
                                        <?php if(!$hasEmp){?>
                                            <tr>
                                                <td colspan="6">No employee found</td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Remarks (If any): <span>*</span></label>
                                            <textarea name="data[description]" class="form-control" id="editor2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <button type="submit" name="publish" class="btn btn-md btn-block btn-primary ajax-submit-btn" <?php if(!$hasEmp){echo 'disabled="disabled"';}?>>PUBLISH</button>
                            </div>
                        </div>
                        <div class="card card-default card-outline">
                            <div class="card-body">
                                <input type="text" name="data[atdate]" class="form-control" readonly="readonly" value="<?php echo (isset($_GET['date']) && $_GET['date']!='' ? date('d-m-Y',strtotime($_GET['date'])) : date('d-m-Y'));?>"/>
                            </div>
                        </div>


                        <?php if(in_array($roleSlug,array('admin','hr'))){?>
                            <div class="card card-default card-outline">
                                <div class="card-body">
                                    <label>Supervisor <span>*</span></label>
                                    <select class="form-control" name="data[supervisor]">
                                        <option value="">Select Suprvisor</option>
                                        <?php if(isset($supervisor) && !empty($supervisor)){?>
                                            <?php foreach($supervisor as $suplist){?>
                                                <option value="<?php echo $suplist->ipy_id;?>"><?php echo $suplist->ipy_fname.' '.$suplist->ipy_sname.' '.$suplist->ipy_tname.' '.$suplist->ipy_lname .' - '.$suplist->desg_name;?></option>
                                            <?php }?>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        <?php }else{?>
                            <input type="hidden" name="data[supervisor]" value="<?php echo getAdminAuth('getEmpID');?>"/>
                        <?php }?>



                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
