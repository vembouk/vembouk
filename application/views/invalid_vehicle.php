<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Inactive Vehicle</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Vehicle</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>vehicle/Add_vehicle" class="text-white"><i class="" aria-hidden="true"></i> Add company</a></button>
                        <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>company/Disciplinary" class="text-white"><i class="" aria-hidden="true"></i>  Disciplinary List</a></button>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i>Vehicle List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Company Name</th>
                                                <th>Registration No</th>
                                               
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
                                                <th>Action</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>
                                           <?php foreach($invalidem as $value): ?>
                                            <tr>
                                                
                                                <td><?php echo $value->first_name; ?></td>
                                                <td><?php echo $value->last_name; ?></td>
                                                
                                                <!--<td><?php echo $value->em_role; ?></td>-->
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url(); ?>vehical/view?I=<?php echo base64_encode($value->em_id); ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>