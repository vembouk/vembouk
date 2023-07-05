<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Application</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Vehicle Application</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <?php // if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                <div class="col-12">
                    <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Application </a></button>
                    <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Holidays" class="text-white"><i class="" aria-hidden="true"></i> Holiday List</a></button>
                    <button type="button" class="btn btn-primary"><i class="fa fa-print"></i><a href="<?php echo base_url(); ?>leave/view2" class="text-white"><i class="" aria-hidden="true"></i> Leave Application</a></button>-->
                   <!-- <a href="<?php echo base_url(); ?>leave/view1" title="Print" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-print"></i></a>-->

                </div>                       
            <?php // } ?> 
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Application List           
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Staff Name</th>
                                        <!--<th>Staff Number</th>-->
                                        <th>Vehicle Name</th>
                                        <th>vehicle No</th>
                                        <th>Vehicle Type</th>
                                        <th>Issue Raise Date</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <!--<th>Duration</th>-->
                                        <th>Issue Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!--<tfoot>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>PIN</th>
                                        <th>Leave Type</th>
                                        <th>Apply Date</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Leave Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>-->
                                <tbody>
                                    <?php foreach($application as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->veh_name; ?></td>
                                        <td><?php echo $value->vehid; ?></td>
                                        <!--<td><?php echo $value->em_code; ?></td>-->
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo date('jS \of F Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php echo $value->start_date; ?></td>
                                        <td><?php echo $value->end_date; ?></td>
                                        
                                        <td>
                                            <!-- Duration filtering -->
                                            <?php
                                                if($value->leave_duration > 8) {
                                                    $originalDays = $value->leave_duration;
                                                    $days = $originalDays / 8;
                                                    $hour = 0;
                                                    // 120 / 8 = 15 // 15 day
                                                    // 13 - (1*8) = 5 hour
                                                    if(is_float($days)) {
                                                        $days = floor($days); // 1
                                                        $hour = $value->leave_duration - ($days * 8); // 5
                                                    }
                                                } else {
                                                    $days = 0;
                                                    $hour = $value->leave_duration;
                                                }
                                                $daysDenom = ($days == 1) ? " day " : " days ";
                                                $hourDenom = ($hour == 1) ? " hour " : " hours ";
                                                if($days > 0) {
                                                    echo $days . $daysDenom;
                                                } else {
                                                    echo $hour . $hourDenom;
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value->leave_status; ?></td>
                                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                                         <?php } else { ?> 
                                        <td class="jsgrid-align-center">
                                           <?php if($value->leave_status =='Approve'){ ?>
                                             <?php } elseif($value->leave_status =='Not Approve'){ ?>
                                            <a href="" title="Edit" class="btn btn-sm btn-success waves-effect waves-light Status" data-employeeId=<?php echo $value->em_id; ?>  data-id="<?php echo $value->id; ?>" data-value="Approve" data-duration="<?php echo $value->leave_duration; ?>" data-type="<?php echo $value->typeid; ?>">Approve</a>       
                                            <a href="" title="Edit" class="btn btn-sm btn-danger waves-effect waves-light  Status" data-id = "<?php echo $value->id; ?>" data-value="Rejected" >Reject</a>
                                            <br> 
                                            <?php } elseif($value->leave_status =='Rejected'){ ?>
                                            <?php } ?>
                                            <a href="" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light leaveapp" data-id="<?php echo $value->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                            <!--<a href="<?php echo base_url(); ?>leave/view1?I=<?php echo base64_encode($value->id); ?>" title="Print" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-print"></i></a>-->

                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Vehicle Application</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="post" action="Add_Applications1" id="leaveapply" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Staff Number</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" required>
                                        <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Staff Name</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="em_name" required>
                                        <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->first_name.' '.$value->last_name?>"><?php echo $value->first_name.' '.$value->last_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
				                                        <label>Working At</label>
				                                        <select name="work_comp" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select">
				                                            <option >Choose...</option>
                                                            <option value="AL DANA TECHNICAL SERVICES AND ENGINEERING, WLL">AL DANA TECHNICAL SERVICES AND ENGINEERING, WLL</option>
				                                            <option value="MOUNT EVEREST, LLC">MOUNT EVEREST, LLC</option>
				                                        </select>
				                                    </div>
                                                       <!-- <?php $depvalue = $this->employee_model->getdepartment(); ?>			                                    
				                                    <div class="form-group">
				                                        <label>Department</label>
				                                        <select name="dep_name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select">
				                                            <option>Choose</option>
                                            <?Php foreach($depvalue as $value): ?>
                                             <option value="<?php echo $value->dep_name ?>"><?php echo $value->dep_name ?></option>
                                            <?php endforeach; ?>
				                                        </select>
				                                    </div>
				                              
                                                    
                                                    <div class="form-group">
				                                        <label>Date Of Joining</label>
				                                        <input type="text" name="em_joining_date" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control mydatetimepickerFull">
				                                    </div>-->


                                                    <?php $depvalue2 = $this->leave_model->emselect(); ?>
                                <div class="form-group">
                                    <label>Vehicle Name</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="veh_name" required>
                                        <?php foreach($depvalue2 as $value): ?>
                                            <option value="<?php echo $value->first_name?>"><?php echo $value->first_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php $depvalue2 = $this->leave_model->emselect(); ?>
                                <div class="form-group">
                                    <label>Vehicle Number</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="vehid" required>
                                    <?php foreach($depvalue2 as $value): ?>
                                        <option value="<?php echo $value->last_name ?>"><?php echo $value->last_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                                         

                                <div class="form-group">
                                    <label>Vehicle Type</label>
                                    <select class="form-control custom-select assignleave"  tabindex="1" name="typeid" id="leavetype" required>
                                        <option value="">Select Here..</option>
                                        <?php foreach($vehicletypes2 as $value): ?>

                                        <option value="<?php echo $value->type_id ?>"><?php echo $value->name ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!--<div class="form-group">
                                    <span style="color:red" id="total"></span>
                                    <div class="span pull-right">
                                        <button class="btn btn-info fetchLeaveTotal">Total Leave Balance You Have</button>
                                    </div>
                                    <br>
                                </div>-->
                                <div class="form-group">
                                    <label class="control-label">Service / Maintenance Duration</label><br>
                                    <input name="type" type="radio" id="radio_1" data-value="Half" class="duration" value="Half Day" checked="">
                                    <label for="radio_1">Hourly</label>
                                    <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day">
                                    <label for="radio_2">Full Day</label>
                                    <input name="type" type="radio" class="with-gap duration" id="radio_3" data-value="More" value="More than One day">
                                    <label for="radio_3">More Than a Day</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" id="hourlyFix">Date</label>
                                    <input type="text" name="startdate" class="form-control mydatetimepickerFull" id="recipient-name1" required>
                                </div>
                                <div class="form-group" id="enddate" style="display:none">
                                    <label class="control-label">End Date</label>
                                    <input type="text" name="enddate" class="form-control mydatetimepickerFull" id="recipient-name1">
                                </div>

                                <div class="form-group" id="hourAmount">
                                    <label>How Long</label>
                                    <select  id="hourAmountVal" class=" form-control custom-select"  tabindex="1" name="hourAmount" required>
                                        <option value="">Select Hour</option>
                                        <option value="1">One hour</option>
                                        <option value="2">Two hour</option>
                                        <option value="3">Three hour</option>
                                        <option value="4">Four hour</option>
                                        <option value="5">Five hour</option>
                                        <option value="6">Six hour</option>
                                        <option value="7">Seven hour</option>
                                        <option value="8">Eight hour</option>
                                    </select>
                                </div>

                               <!--  <div class="form-group" >
                                    <label class="control-label">Duration</label>
                                    <input type="number" name="duration" class="form-control" id="leaveDuration">
                                </div> --> 
                                <div class="form-group">
                                    <label class="control-label">Detail description of Repair / Maintenance needed</label>
                                    <textarea class="form-control" name="reason" id="message-text1"></textarea>                                                
                                </div>

                                
                                
                                 
                                                                               
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#leaveapply input').on('change', function(e) {
                                        e.preventDefault(e);

                                        // Get the record's ID via attribute  
                                        var duration = $('input[name=type]:checked', '#leaveapply').attr('data-value');
                                        console.log(duration);

                                        if(duration =='Half'){
                                            $('#enddate').hide();
                                            $('#hourlyFix').text('Date');
                                            $('#hourAmount').show();
                                        }
                                        else if(duration =='Full'){
                                            $('#enddate').hide();  
                                            $('#hourAmount').hide();  
                                            $('#hourlyFix').text('Date');  
                                        }
                                        else if(duration =='More'){
                                            $('#enddate').show();
                                            $('#hourAmount').hide();
                                        }
                                    });
                                    $('#appmodel').on('hidden.bs.modal', function () {
                                        location.reload();
                                    });
                                });                                                          
                            </script>
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="form-control" id="recipient-name1" required> 
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>



<script>
    $(document).ready(function () {

        $('.fetchLeaveTotal').on('click', function (e) {
            e.preventDefault();
            var selectedEmployeeID = $('.selectedEmployeeID').val();
            var leaveTypeID = $('.assignleave').val();
            //console.log(selectedEmployeeID, leaveTypeID);
            $.ajax({
                url: 'LeaveAssign1?leaveID=' + leaveTypeID + '&employeeID=' +selectedEmployeeID,
                method: 'GET',
                data: '',
            }).done(function (response) {
                //console.log(response);
                $("#total").html(response);
            });
        });
    });
</script>
        <script>
        /*DATETIME PICKER*/
          $("#bbbSubmit").on("click", function(event){
              event.preventDefault();
              var typeid = $('.typeid').val();
              var datetime = $('.mydatetimepicker').val();
              var emid = $('.emid').val();
              //console.log(datetime);
              $.ajax({
                  url: "GetemployeeGmLeave1?year="+datetime+"&typeid="+typeid+"&emid="+emid,
                  type:"GET",
                  dataType:'',
                  data:'data',          
                  success: function(response) {
                      // console.log(response);
                      $('.leaveval').html(response);             
                  },
                  error: function(response) {
                    // console.log(response);
                  }
              });
          });			
        </script>  


        <script type="text/javascript">
        /*PARSE DURATION DATA*/
        $('.duration').on('input',function() {
            var day = parseInt($('.duration').val());
            var hour = 8;
            $('.totalhour').val((day * hour ? day * hour : 0).toFixed(2));
        });
        </script>
<script>
  $(".Status").on("click", function(event){
      event.preventDefault();
      // console.log($(this).attr('data-value'));
      $.ajax({
          url: "approveLeaveStatus1",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value'),
              'duration': $(this).attr('data-duration'),
              'type': $(this).attr('data-type')
          },
          success: function(response) {
            // console.log(response);
            $(".message").fadeIn('fast').delay(30000).fadeOut('fast').html(response);
            window.setTimeout(function(){location.reload()}, 30000);
          },
          error: function(response) {
            //console.error();
          }
      });
  });           
</script>

<script type="text/javascript">
            $(document).ready(function() {
                $(".leaveapp").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $('#leaveapply').trigger("reset");
                    $('#appmodel').modal('show');
                    $.ajax({
                        url: 'LeaveAppbyid1?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        // console.log(response);
                        // Populate the form fields with the data returned from server
                        $('#leaveapply').find('[name="id"]').val(response.leaveapplyvalue.id).end();
                        $('#leaveapply').find('[name="emid"]').val(response.leaveapplyvalue.em_id).end();
                        $('#leaveapply').find('[name="applydate"]').val(response.leaveapplyvalue.apply_date).end();
                        $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                        $('#leaveapply').find('[name="em_name"]').val(response.leaveapplyvalue.em_name).end();
                        $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                        $('#leaveapply').find('[name="em_joining_date"]').val(response.leaveapplyvalue.em_joining_date).end();
                        $('#leaveapply').find('[name="dep_name"]').val(response.leaveapplyvalue.dep_name).end();
                        $('#leaveapply').find('[name="work_comp"]').val(response.leaveapplyvalue.work_comp).end();
                        $('#leaveapply').find('[name="startdate"]').val(response.leaveapplyvalue.start_date).end();
                        $('#leaveapply').find('[name="enddate"]').val(response.leaveapplyvalue.end_date).end();
                        $('#leaveapply').find('[name="reason"]').val(response.leaveapplyvalue.reason).end();
                        $('#leaveapply').find('[name="contact_name"]').val(response.leaveapplyvalue.contact_name).end();
                        $('#leaveapply').find('[name="relationship"]').val(response.leaveapplyvalue.relationship).end();
                        $('#leaveapply').find('[name="contact_no"]').val(response.leaveapplyvalue.contact_no).end();
                        $('#leaveapply').find('[name="contact_no2"]').val(response.leaveapplyvalue.contact_no2).end();
                        //$('#leaveapply').find('[name="contact_no2"]').val(response.leaveapplyvalue.contact_no2).end();
                        $('#leaveapply').find('[name="con_add"]').val(response.leaveapplyvalue.con_add).end();
                        $('#leaveapply').find('[name="emname1"]').val(response.leaveapplyvalue.emname1).end();
                        $('#leaveapply').find('[name="dep_name1"]').val(response.leaveapplyvalue.dep_name1).end();
                        $('#leaveapply').find('[name="contact_no3"]').val(response.leaveapplyvalue.contact_no3).end();
                        $('#leaveapply').find('[name="from_des"]').val(response.leaveapplyvalue.from_des).end();
                        $('#leaveapply').find('[name="to_des"]').val(response.leaveapplyvalue.to_des).end();
                        $('#leaveapply').find('[name="paid_by"]').val(response.leaveapplyvalue.paid_by).end();
                        $('#leaveapply').find('[name="date1"]').val(response.leaveapplyvalue.date1).end();
                        $('#leaveapply').find('[name="remarks1"]').val(response.leaveapplyvalue.remarks1).end();
                        $('#leaveapply').find('[name="from_des2"]').val(response.leaveapplyvalue.from_des2).end();
                        $('#leaveapply').find('[name="to_des2"]').val(response.leaveapplyvalue.to_des2).end();
                        $('#leaveapply').find('[name="paid_by2"]').val(response.leaveapplyvalue.paid_by2).end();
                        $('#leaveapply').find('[name="date2"]').val(response.leaveapplyvalue.date2).end();
                        $('#leaveapply').find('[name="remarks2"]').val(response.leaveapplyvalue.remarks2).end();
                        $('#leaveapply').find('[name="status"]').val(response.leaveapplyvalue.leave_status).end();

                        if(response.leaveapplyvalue.leave_type == 'Half day') {
                            $('#appmodel').find(':radio[name=type][value="Half Day"]').prop('checked', true).end();
                            $('#hourAmount').show().end();
                            $('#enddate').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'Full Day') {
                            $('#appmodel').find(':radio[name=type][value="Full Day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'More than One day'){
                            $('#appmodel').find(':radio[name=type][value="More than One day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                            $('#enddate').show().end();
                        }

                        $('#hourAmountVal').val(response.leaveapplyvalue.leave_duration).show().end();
                    });
                });
            });
        </script>                     
<?php $this->load->view('backend/footer'); ?>