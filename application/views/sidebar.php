        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                        <?php 
                        $id = $this->session->userdata('user_login_id');
                        $basicinfo = $this->employee_model->GetBasic($id); 
                        ?>                
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                        <!-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                    </div>

                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?php echo $basicinfo->first_name.' '.$basicinfo->last_name; ?></h5>
                        <a href="<?php echo base_url(); ?>settings/Settings" class="dropdown-toggle u-dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="<?php echo base_url(); ?>login/logout" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        
                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">My Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                               <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1"> Vehicle Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi  mdi-human-male"></i><span class="hide-menu">QHSE </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication2"> QHSE Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Projects </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Field Visit</a></li>-->
                               
                            </ul>
                        </li>                                                                       
                        <?php }?>
                        <?php if($this->session->userdata('user_type')=='SUPER ADMIN'){ ?>
                            <li> <a href="<?php echo base_url(); ?>" ><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-sitemap"></i></i><span class="hide-menu">Organization </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url();?>organization/Department">Department </a></li>
                                <li><a href="<?php echo base_url();?>organization/Designation">Designation</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-globe"></i><span class="hide-menu">Company</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>company/Companys">Company</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>company/Inactive_Company">Inactive Company </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">HR </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>employee/Employees">Staffs </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary</a></li>-->
                                <li><a href="<?php echo base_url(); ?>employee/Inactive_Employee">Inactive Staffs</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">Customer Registration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>customer/Customers">Customer</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>customer/Inactive_Customer">Inactive Customer </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Finance</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>payment/EmApplication">Payment Application</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Vendor Registration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>payment/paymenttypes">Vendor Type</a></li>-->
                                <li><a href="<?php echo base_url(); ?>vendor/Vendors">Vendor</a></li>
                                <li><a href="<?php echo base_url(); ?>payment/Application">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>">Invoice </a></li>
                                <li><a href="<?php echo base_url(); ?>">Quotation</a></li>
                                <li><a href="<?php echo base_url(); ?>vendor/Inactive_Vendor">Inactive Vendor </a></li>
                            </ul>
                        </li>
                        <!--<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo base_url(); ?>vehicle1/leavetypes1"> Vehicle Type</a></li>
                                <li><a href="<?php echo base_url(); ?>vehicle/Vehicles">Vehicle</a></li>
                                <li><a href="<?php echo base_url(); ?>vehicle/EmApplication">Approved Applications List</a></li>
                                <li><a href="<?php echo base_url(); ?>vehicle1/Application">Vehicle Application</a></li>
                               <li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>
                                <li><a href="<?php echo base_url(); ?>vehicle/Inactive_Vehicle">Inactive Vehicle </a></li>
                            </ul>
                        </li>-->
                       <!-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Vendor Payment Request</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>payment/EmApplication">Application List</a></li>
                                <li><a href="<?php echo base_url(); ?>payment/Application">Application For Approval</a></li>
                            </ul>
                        </li>-->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/vehicletypes2"> Vehicle Type</a></li>-->
                                <li><a href="<?php echo base_url(); ?>vehicle/Vehicles">Add Vehicle</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1">Application List</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application1">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>-->
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-human-male"></i><span class="hide-menu">QHSE</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/qhsetypes"> QHSE Type</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>vehicle/Vehicles">Add QHSE</a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication2">QHSE List</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application2">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>-->
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Attendance </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance">Attendance List </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Save_Attendance">Add Attendance </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance_Report">Attendance Report </a></li>
                            </ul>
                        </li>
                   <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays">Holiday</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/leavetypes"> Leave Type</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application">Application For Approval</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Earnedleave">Earned Leave </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>
                            </ul>
                        </li>
                       
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Project </span></a>
                            <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo base_url();?>Projects/Category">Category</a></li>
                            <li><a href="<?php echo base_url();?>Projects/Category1">File Category</a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                               <!-- <li><a href="<?php echo base_url(); ?>Projects/Field_visit"> Field Visit</a></li>-->
                            </ul>
                        </li>
                            <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Procurement</span></a>
                                <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url();?>Projects/Category">Request</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Request Form</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Request List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url();?>Projects/Category1">Quotation</a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Bid Analysis</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Bid Analysis Form</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Bid Analysis List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks">Purchase Order</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Purchase Order Form</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Purchase Order List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks">Good Received</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Good Received Form</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Good Received List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks">Vendors</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Add Vendor</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Vendor List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks">Committees</a>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Create committee</a></ul>
                                <ul><a href="<?php echo base_url();?>Projects/Category">Committee List</a></ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks">Units</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>Projects/Field_visit"> Field Visit</a></li>-->
                                </ul>
                            </li>
                       
                       <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payroll </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_Type"> Payroll Type </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_List"> Payroll List </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Generate_salary"> Generate Payslip</a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"> Payslip Report</a></li>
                                <li><a href="<?php echo base_url(); ?>Advance/View"> Grant Advance </a></li>
                                <li><a href="<?php echo base_url(); ?>Advance/installment"> Advance Installment</a></li>
                            </ul>
                        </li>
                          <!--<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Loan/View"> Grant Loan </a></li>
                                <li><a href="<?php echo base_url(); ?>Loan/installment"> Loan Installment</a></li>
                            </ul>
                        </li>-->
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-grid"></i><span class="hide-menu">Assets </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li>
                               <!-- <li><a href="<?php #echo base_url(); ?>Logistice/View"> Logistic Support List </a></li>-->
                                <li><a href="<?php echo base_url(); ?>Logistice/logistic_support"> Logistic Support </a></li>
                            </ul>
                        </li>
                        
                        <!--<li> <a href="<?php echo base_url()?>notice/All_notice" ><i class="mdi mdi-clipboard"></i><span class="hide-menu">Notice <span class="hide-menu"></a></li>-->
                        <li> <a href="<?php echo base_url(); ?>settings/Settings" ><i class="mdi mdi-settings"></i><span class="hide-menu">Settings <span class="hide-menu"></a></li>
                        <?php } ?>
                        <?php if($this->session->userdata('user_type')=='PROJECT MANAGER'){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">My Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">Customer Registration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>customer/Customers">Customer</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>customer/Inactive_Customer">Inactive Customer </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Vendor Registration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>payment/paymenttypes">Vendor Type</a></li>-->
                                <li><a href="<?php echo base_url(); ?>vendor/Vendors">Vendor</a></li>
                                <li><a href="<?php echo base_url(); ?>payment/Application">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>">Invoice </a></li>
                                <li><a href="<?php echo base_url(); ?>">Quotation</a></li>
                                <li><a href="<?php echo base_url(); ?>vendor/Inactive_Vendor">Inactive Vendor </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                               <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1"> Vehicle Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi  mdi-human-male"></i><span class="hide-menu">QHSE </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication2"> QHSE Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Projects </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Field Visit</a></li>-->
                               
                            </ul>
                        </li>  
                      
                        <?php }  ?>
                        
                        <?php if($this->session->userdata('user_type')=='FINANCE'){ ?>
                            <li> <a href="<?php echo base_url(); ?>" ><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                        <li><a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">My Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">HR </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>employee/Employees">Staffs </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>employee/Inactive_Employee">Inactive Staffs </a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/vehicletypes2"> Vehicle Type</a></li>-->
                                <li><a href="<?php echo base_url(); ?>vehicle/Vehicles">Add Vehicle</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1">Application List</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application1">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>-->
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                               <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payroll </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_Type"> Payroll Type </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_List"> Payroll List </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Generate_salary"> Generate Payslip</a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"> Payslip Report</a></li>
                            </ul>
                        </li>
                       <!--   <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Loan/View"> Grant Loan </a></li>
                                <li><a href="<?php echo base_url(); ?>Loan/installment"> Loan Installment</a></li>
                            </ul>
                        </li>
                        -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-grid"></i><span class="hide-menu">Assets </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li>
                               <!-- <li><a href="<?php #echo base_url(); ?>Logistice/View"> Logistic Support List </a></li>-->
                                <li><a href="<?php echo base_url(); ?>Logistice/logistic_support"> Logistic Support </a></li>
                            </ul>
                        </li>
                        <?php }  ?>

                        <?php if($this->session->userdata('user_type')=='PROCUREMENT OFFICER'){ ?>
                        <li><a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">My Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">Customer Registration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>customer/Customers">Customer</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>customer/Inactive_Customer">Inactive Customer </a></li>
                            </ul>
                        </li>
                       
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/vehicletypes2"> Vehicle Type</a></li>-->
                                <li><a href="<?php echo base_url(); ?>vehicle/Vehicles">Add Vehicle</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1">Application List</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application1">Application For Approval</a></li>
                                <!--<li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li>-->
                                <!--<li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>-->
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                               <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Payroll </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_Type"> Payroll Type </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_List"> Payroll List </a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Generate_salary"> Generate Payslip</a></li>
                                <li><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"> Payslip Report</a></li>
                            </ul>
                        </li>
                       <!--   <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Loan/View"> Grant Loan </a></li>
                                <li><a href="<?php echo base_url(); ?>Loan/installment"> Loan Installment</a></li>
                            </ul>
                        </li>
                        -->
                       
                        <?php }  ?>



                        <?php if($this->session->userdata('user_type')=='HR EXECUTIVE'){ ?>
                        <li><a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">My Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">HR </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>employee/Employees">Staffs </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>-->
                                <li><a href="<?php echo base_url(); ?>employee/Inactive_Employee">Inactive Staffs </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                               <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-taxi"></i><span class="hide-menu">Fleet </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication1"> Vehicle Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi  mdi-human-male"></i><span class="hide-menu">QHSE </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>-->
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication2"> QHSE Application </a></li>
                               <!--<li><a href="<?php echo base_url(); ?>leave/EmLeavesheet1"> Leave Sheet </a></li>-->
                            </ul>
                        </li>
                      
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Projects </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                <!--<li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Field Visit</a></li>-->
                               
                            </ul>
                        </li>                                                 
                    
                       
                        <?php }  ?>


                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>