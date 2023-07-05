<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i>Company Registration</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>company/Add_company" class="text-white"><i class="" aria-hidden="true"></i> Add company</a></button>
                        <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>company/Disciplinary" class="text-white"><i class="" aria-hidden="true"></i>  Disciplinary List</a></button>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Company List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="companys123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Registration No</th>
                                                <th>CR No </th>
                                                <th>CR Issue </th>
                                                <th>CR Expiry </th>
                                                <!-- <th>Contact </th>
                                               <th>User Type</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                               <tr>
                                                <th>Company Name</th>
                                                <th>Registration No</th>
                                                <th>CR No </th>
                                                <th>CR Issue </th>
                                                <th>CR Expiry </th>
                                                <th>Contact </th>
                                                <th>User Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                           <?php foreach($company as $value): ?>
                                            <tr>
                                                <td title="<?php echo $value->first_name .' '.$value->last_name; ?>"><?php echo $value->first_name .' '.$value->last_name; ?></td>
                                                <td><?php echo $value->em_code; ?></td>
                                                <td><?php echo $value->cr_no; ?></td>
                                                <td><?php echo $value->startdate; ?></td>
                                                <td><?php echo $value->enddate; ?></td>
                                                <!-- <td><?php echo $value->em_phone; ?></td>
                                               <td><?php echo $value->em_role; ?></td>-->
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url(); ?>company/view?I=<?php echo base64_encode($value->em_id); ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                   <!-- <a href="<?php echo base_url(); ?>company/view1?I=<?php echo base64_encode($value->em_id); ?>" title="Print" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-print"></i></a>
                                           --><!--  <a onclick="return confirm('Are you sure to print this Company Registration Form?')" href="<?php echo base_url();?>company/view1?I=<?php echo base64_encode($value->id); ?>" title="Print" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-print"></i></a>-->
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>
<script>
    $('#companys123').DataTable({
        "aaSorting": [[1,'asc']],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>