<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('customer_model');
        $this->load->model('company_model');
        $this->load->model('login_model');
        $this->load->model('payroll_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
  
    }
    
	public function index()
	{
		if ($this->session->userdata('user_login_access') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('user_login_access') == 1)
          $data= array();
        redirect('company/Companys');
	}
    public function Companys(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['company'] = $this->company_model->emselect();
        $this->load->view('backend/companys',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_company(){
        if($this->session->userdata('user_login_access') != False) { 
        $this->load->view('backend/add-company');
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
	public function Save(){ 
    if($this->session->userdata('user_login_access') != False) {     
    $eid = $this->input->post('eid');    
    $id = $this->input->post('emid');    
	$fname = $this->input->post('fname');
	$lname = $this->input->post('lname');
    $emrand = substr($lname,0,3).rand(1000,2000);    
    $est_no = $this->input->post('est_no');
    $est_year = $this->input->post('est_year');
    $cr_no = $this->input->post('cr_no');
    $ccr_no = $this->input->post('ccr_no');
    $startdate = $this->input->post('startdate');
    $enddate = $this->input->post('enddate');
    $bussiness_nature = $this->input->post('bussiness_nature');
    $name_ass = $this->input->post('name_ass');
	$dept = $this->input->post('dept');
	$deg = $this->input->post('deg');
	//$role = $this->input->post('role');
	$gender = $this->input->post('gender');
	$contact = $this->input->post('contact');
	$dob = $this->input->post('dob');	
	$joindate = $this->input->post('joindate');	
	$leavedate = $this->input->post('leavedate');	
	//$username = $this->input->post('username');	
	$email = $this->input->post('email');
    $address = $this->input->post('address');	
	$password = sha1($contact);	
	$confirm = $this->input->post('confirm');	
	$nid = $this->input->post('nid');		
	$blood = $this->input->post('blood');		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        // Validating Name Field
        $this->form_validation->set_rules('contact', 'contact', 'trim|required|min_length[10]|max_length[15]|xss_clean');
        /*validating email field*/
        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			} else {
            if($this->company_model->Does_email_exists($email) && $password != $confirm){
                $this->session->set_flashdata('formdata','Email is already Exist or Check your password');
                echo "Email is already Exist or Check your password";
            } else {
            if($_FILES['image_url']['name']){
            $file_name = $_FILES['image_url']['name'];
			$fileSize = $_FILES["image_url"]["size"]/1024;
			$fileType = $_FILES["image_url"]["type"];
			$new_file_name='';
            $new_file_name .= $emrand;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "800",
                'max_width' => "800"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('image_url')) {
                echo $this->upload->display_errors();
			}
   
			else {
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_id' => $emrand,
                    'em_code' => $eid,
                    'des_id' => $deg,
                    'dep_id' => $dept,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_no' => $est_no,
                    'est_year' => $est_year,
                    'cr_no' => $cr_no,
                    'ccr_no' => $ccr_no,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'bussiness_nature' => $bussiness_nature,
                    'name_ass' => $name_ass,
					'em_email' => $email,
                    'address' => $address,
					'em_password'=>$password,
					//'em_role'=>$role,
					'em_gender'=>$gender,
                    'status'=>'ACTIVE',
                    'em_phone'=>$contact,
                    'em_birthday'=>$dob,
                    'em_joining_date'=>$joindate,
                    'em_contact_end'=>$leavedate,
                    'em_image'=>$img_url,
                    'em_nid'=>$nid,
                    'em_blood_group'=> $blood
                );
                if($id){
            $success = $this->company_model->Update($data,$id); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";
                } else {
            $success = $this->company_model->Add($data);
            #$this->confirm_mail_send($email,$pass_hash);        
            #$this->session->set_flashdata('feedback','Successfully Created');
            echo "Successfully Added";                     
                }
			}
        } else {
                $data = array();
                $data = array(
                    'em_id' => $emrand,
                    'em_code' => $eid,
                    'des_id' => $deg,
                    'dep_id' => $dept,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_no' => $est_no,
                    'est_year' => $est_year,
                    'cr_no' => $cr_no,
                    'ccr_no' => $ccr_no,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'bussiness_nature' => $bussiness_nature,
                    'name_ass' => $name_ass,
					'em_email' => $email,
                    'address' => $address,
					'em_password'=>$password,
					//'em_role'=>$role,
                    'status'=>'ACTIVE',
                    'em_phone'=>$contact,
                    'em_address'=>$address
                );
                if($id){
            $success = $this->company_model->Update($data,$id); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";        
            #redirect('company/Add_company'); 
                } else {
            $success = $this->company_model->Add($data);
            #$this->confirm_mail_send($email,$pass_hash);        
            echo "Successfully Added";
            #redirect('company/Add_company');                     
                }
            }
            }
        }
        }
    else{
		redirect(base_url() , 'refresh');
	       }        
		}
	public function Update(){
    if($this->session->userdata('user_login_access') != False) {    
    $eid = $this->input->post('eid');    
    $id = $this->input->post('emid');    
	$fname = $this->input->post('fname');
	$lname = $this->input->post('lname');
    $est_no = $this->input->post('est_no');
    $est_year = $this->input->post('est_year');
    $cr_no = $this->input->post('cr_no');
    $ccr_no = $this->input->post('ccr_no');
    $startdate= $this->input->post('startdate');
    $enddate = $this->input->post('enddate');
    $bussiness_nature = $this->input->post('bussiness_nature');
    $name_ass = $this->input->post('name_ass');
	$dept = $this->input->post('dept');
	$deg = $this->input->post('deg');
	//$role = $this->input->post('role');
	$contact = $this->input->post('contact');
	//$username = $this->input->post('username');	
	$email = $this->input->post('email');	
    $address = $this->input->post('address');
	$password = $this->input->post('password');	
	$confirm = $this->input->post('confirm');	
	$address = $this->input->post('address');		
	$status = $this->input->post('status');		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('contact', 'contact', 'trim|required|min_length[10]|max_length[15]|xss_clean');

        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("company/view?I=" .base64_encode($eid));
			} else {
            if($_FILES['image_url']['name']){
            $file_name = $_FILES['image_url']['name'];
			$fileSize = $_FILES["image_url"]["size"]/1024;
			$fileType = $_FILES["image_url"]["type"];
			$new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('image_url')) {
                echo $this->upload->display_errors();
                #redirect("company/view?I=" .base64_encode($eid));
			}
   
			else {
            $employee = $this->company_model->GetBasic($id);
            $checkimage = "./assets/images/users/$employee->em_image";                 
                if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_code' => $eid,
                    'des_id' => $deg,
                    'dep_id' => $dept,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_no' => $est_no,
                    'est_year' => $est_year,
                    'cr_no' => $cr_no,
                    'ccr_no' => $ccr_no,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'bussiness_nature' => $bussiness_nature,
                    'name_ass' => $name_ass,
					'em_email' => $email,
                    'address' => $address,
					//'em_role'=>$role,
                    'status'=>$status,
                    'em_phone'=>$contact,
                    'em_image'=>$img_url,
                    'em_address'=>$address
                );
                if($id){
            $success = $this->company_model->Update($data,$id); 
            $this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";
                }
			}
        } else {
                $data = array();
                $data = array(
                    'em_code' => $eid,
                    'des_id' => $deg,
                    'dep_id' => $dept,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_no' => $est_no,
                    'est_year' => $est_year,
                    'cr_no' => $cr_no,
                    'ccr_no' => $ccr_no,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'bussiness_nature' => $bussiness_nature,
                    'name_ass' => $name_ass,
					'em_email' => $email,
                    'address' => $address,
					//'em_role'=>$role,
                    'status'=>$status,
                    'em_phone'=>$contact,
                    'em_address'=>$address
                );
                if($id){
            $success = $this->company_model->Update($data,$id); 
            $this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";
                }
            }
        }
        }
    else{
		redirect(base_url() , 'refresh');
	       }        
		}
    public function view(){
        if($this->session->userdata('user_login_access') != False) {
        $id = base64_decode($this->input->get('I'));
        $data['basic'] = $this->company_model->GetBasic($id);
        $data['permanent'] = $this->company_model->GetperAddress($id);
        $data['present'] = $this->company_model->GetpreAddress($id);
        $data['education'] = $this->company_model->GetEducation($id);
        //$data['experience'] = $this->company_model->GetExperience($id);
        $data['bankinfo'] = $this->company_model->GetBankInfo($id);
        $data['tradeinfo'] = $this->company_model->GetTradeInfo($id);
        $data['auditinfo'] = $this->company_model->GetAuditInfo($id);
        $data['fileinfo'] = $this->company_model->GetFileInfo($id);
        $data['fileinfo1'] = $this->company_model->GetFileInfo1($id);
        $data['typevalue'] = $this->payroll_model->GetsalaryType();
        $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();    
        $data['salaryvalue'] = $this->company_model->GetsalaryValue($id);
        $data['socialmedia'] = $this->company_model->GetSocialValue($id);
            $year = date('Y');
        $data['Leaveinfo'] = $this->company_model->GetLeaveiNfo($id,$year);
        $this->load->view('backend/company_view',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}         
    }
    
    
    public function Parmanent_Address(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');

        $paraddress = $this->input->post('paraddress');
        $parcity = $this->input->post('parcity');
        $parcountry = $this->input->post('parcountry');
        //$per1_name = $this->input->post('per1_name');
        $per1_mob1 = $this->input->post('per1_mob1');
        $per1_mob2 = $this->input->post('per1_mob2');
        $per1_lan1 = $this->input->post('per1_lan1');
        $per1_lan2 = $this->input->post('per1_lan2');
        $per1_other = $this->input->post('per1_other');
        $per1_email = $this->input->post('per1_email');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('paraddress', 'address', 'trim|required|min_length[5]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'city' => $parcity,
                    'country' => $parcountry,
                    'address' => $paraddress,
                    //'per1_name' => $per1_name,
                    'per1_mob1' => $per1_mob1,
                    'per1_mob2' => $per1_mob2,
                    'per1_lan1' => $per1_lan1,
                    'per1_lan2' => $per1_lan2,
                    'per1_other' => $per1_other,
                    'per1_email' => $per1_email,
                    'type' => 'Permanent'
                );
            if(!empty($id)){
                $success = $this->company_model->UpdateParmanent_Address($id,$data);
                $this->session->set_flashdata('feedback','Successfully Updated');
                echo "Successfully Updated";                
            } else {
                $success = $this->company_model->AddParmanent_Address($data);
                $this->session->set_flashdata('feedback','Successfully Added');
                echo "Successfully Added";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}             
    }
    public function Present_Address(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $presaddress = $this->input->post('presaddress');
        $prescity = $this->input->post('prescity');
        $prescountry = $this->input->post('prescountry');
        $per1_mob1 = $this->input->post('per1_mob1');
        $per1_mob2 = $this->input->post('per1_mob2');
        $per1_lan1 = $this->input->post('per1_lan1');
        $per1_lan2 = $this->input->post('per1_lan2');
        $per1_other = $this->input->post('per1_other');
        $per1_email = $this->input->post('per1_email');
       // $name = $this->input->post('name');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('presaddress', 'address', 'trim|required|min_length[5]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'city' => $prescity,
                    'country' => $prescountry,
                    'address' => $presaddress,
                    //'per1_name' => $per1_name,
                    'per1_mob1' => $per1_mob1,
                    'per1_mob2' => $per1_mob2,
                    'per1_lan1' => $per1_lan1,
                    'per1_lan2' => $per1_lan2,
                    'per1_other' => $per1_other,
                    'per1_email' => $per1_email,
                    //'name' => $name,
                    'type' => 'Present'
                );
            if(empty($id)){
                $success = $this->company_model->AddParmanent_Address($data);
                $this->session->set_flashdata('feedback','Successfully Added');
                echo "Successfully Updated";
            } else {
                $success = $this->company_model->UpdateParmanent_Address($id,$data);
                $this->session->set_flashdata('feedback','Successfully Updated');
                echo "Successfully Added";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_Education(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $certificate = $this->input->post('name');
        $institute = $this->input->post('institute');
        $eduresult = $this->input->post('result');
        $eduyear = $this->input->post('year');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('institute', 'institute', 'trim|required|min_length[5]|max_length[250]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'edu_type' => $certificate,
                    'institute' => $institute,
                    'result' => $eduresult,
                    'year' => $eduyear
                );
            if(empty($id)){
                $success = $this->company_model->Add_education($data);
                $this->session->set_flashdata('feedback','Successfully Added');
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_Education($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Save_Social(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $google = $this->input->post('google');
        $skype = $this->input->post('skype');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('facebook', 'company_name', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'facebook' => $facebook,
                    'twitter' => $twitter,
                    'google_plus' => $google,
                    'skype_id' => $skype
                );
            if(empty($id)){
                $success = $this->company_model->Insert_Media($data);
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_Media($id,$data);
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_Experience(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $company = $this->input->post('company_name');
        $position = $this->input->post('position_name');
        $address = $this->input->post('address');
        $start = $this->input->post('work_duration');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('company_name', 'company_name', 'trim|required|min_length[5]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('position_name', 'position_name', 'trim|required|min_length[5]|max_length[250]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'exp_company' => $company,
                    'exp_com_position' => $position,
                    'exp_com_address' => $address,
                    'exp_workduration' => $start
                );
            if(empty($id)){
                $success = $this->company_model->Add_Experience($data);
                $this->session->set_flashdata('feedback','Successfully Added');
                echo "Successfully Updated";
            } else {
                $success = $this->company_model->Update_Experience($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Disciplinary(){
        if($this->session->userdata('user_login_access') != False) {
        $data['desciplinary'] = $this->company_model->desciplinaryfetch();
        $this->load->view('backend/disciplinary',$data); 
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function add_Desciplinary(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $warning = $this->input->post('warning');
        $title = $this->input->post('title');
        $details = $this->input->post('details');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('title', 'title', 'trim|required|min_length[2]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('details', 'details', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect('Disciplinary');
			} else {
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'action' => $warning,
                    'title' => $title,
                    'description' => $details
                );
            if(empty($id)){
                $success = $this->company_model->Add_Desciplinary($data);
                $this->session->set_flashdata('feedback','Successfully Added');
                #redirect('company/Disciplinary');
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_Desciplinary($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("companyview?I=" .base64_encode($em_id));
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_bank_info(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $holder = $this->input->post('holder_name');
        $bank = $this->input->post('bank_name');
        $branch = $this->input->post('branch_name');
        $number = $this->input->post('account_number');
        $account = $this->input->post('account_type');
        $name_customer = $this->input->post('name_customer');
        $designation_payment = $this->input->post('designation_payment');
        $qid_payment = $this->input->post('qid_payment');
        $mobile_number1 = $this->input->post('mobile_number1');
        $mobile_number2 = $this->input->post('mobile_number2');
        $mobile_number3 = $this->input->post('mobile_number3');
        $mobile_number4 = $this->input->post('mobile_number4');
        $e_mailpayment = $this->input->post('e_mailpayment');
        $credit_amount = $this->input->post('credit_amount');
        $credit_days = $this->input->post('credit_days');
        $paymentsecurity = $this->input->post('paymentsecurity');
        //$name_manager = $this->input->post('name_manager');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('holder_name', 'holder name', 'trim|required|min_length[5]|max_length[120]|xss_clean');
        $this->form_validation->set_rules('account_number', 'account name', 'trim|required|min_length[5]|max_length[120]|xss_clean');
        $this->form_validation->set_rules('branch_name', 'branch name', 'trim|required|min_length[5]|max_length[120]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'holder_name' => $holder,
                    'bank_name' => $bank,
                    'branch_name' => $branch,
                    'account_number' => $number,
                    'account_type' => $account,
                    'name_customer' => $name_customer,
                    'designation_payment' => $designation_payment,
                    'qid_payment' => $qid_payment,
                    'mobile_number1' => $mobile_number1,
                    'mobile_number2' => $mobile_number2,
                    'mobile_number3' => $mobile_number3,
                    'mobile_number4' => $mobile_number4,
                    'e_mailpayment' => $e_mailpayment,
                    'credit_amount' => $credit_amount,
                    'credit_days' => $credit_days,
                    'paymentsecurity' => $paymentsecurity,
                   // 'name_manager' => $name_manager
                );
            if(empty($id)){
                $success = $this->company_model->Add_BankInfo($data);
                #$this->session->set_flashdata('feedback','Successfully Added');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_BankInfo($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Add_trade_info(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $holder = $this->input->post('holder_name');
        $branch = $this->input->post('branch_name');
        $number = $this->input->post('account_number');
        $name_ref = $this->input->post('name_ref');
        $ll_ref1 = $this->input->post('ll_ref1');
        $ll_ref2 = $this->input->post('ll_ref2');
        $e_mail1 = $this->input->post('e_mail1');
        $holder1 = $this->input->post('holder_name1');
        $branch1 = $this->input->post('branch_name1');
        $number1 = $this->input->post('account_number1');
        $name_ref1= $this->input->post('name_ref1');
        $ll_ref11 = $this->input->post('ll_ref11');
        $ll_ref21 = $this->input->post('ll_ref21');
        $e_mail11 = $this->input->post('e_mail11');

        $holder11 = $this->input->post('holder_name11');
        $branch11 = $this->input->post('branch_name11');
        $number11 = $this->input->post('account_number11');
        $name_ref11= $this->input->post('name_ref11');
        $ll_ref111 = $this->input->post('ll_ref111');
        $ll_ref211 = $this->input->post('ll_ref211');
        $e_mail111 = $this->input->post('e_mail111');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('holder_name', 'holder name', 'trim|required|min_length[5]|max_length[120]|xss_clean');
        //$this->form_validation->set_rules('holder_name1', 'holder name1', 'trim|required|min_length[5]|max_length[120]|xss_clean');
     //$this->form_validation->set_rules('account_number', 'account_number', 'trim|required|min_length[5]|max_length[120]|xss_clean');
     //$this->form_validation->set_rules('branch_name', 'branch name', 'trim|required|min_length[5]|max_length[120]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			redirect("company/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'holder_name' => $holder,
                    'branch_name' => $branch,
                    'account_number' => $number,
                    'name_ref' => $name_ref,
                    'll_ref1' => $ll_ref1,
                    'll_ref2' => $ll_ref2,
                    'e_mail1' => $e_mail1,
                    'holder_name1' => $holder1,
                    'branch_name1' => $branch1,
                    'account_number1' => $number1,
                    'name_ref1' => $name_ref1,
                    'll_ref11' => $ll_ref11,
                    'll_ref21' => $ll_ref21,
                    'e_mail11' => $e_mail11,
                    'holder_name11' => $holder11,
                    'branch_name11' => $branch11,
                    'account_number11' => $number11,
                    'name_ref11' => $name_ref11,
                    'll_ref111' => $ll_ref111,
                    'll_ref211' => $ll_ref211,
                    'e_mail111' => $e_mail111         
                                    
                   
                );
            if(empty($id)){
                $success = $this->company_model->Add_TradeInfo($data);
                #$this->session->set_flashdata('feedback','Successfully Added');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_TradeInfo($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Add_audit_info(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $holder = $this->input->post('holder_name');
        $branch = $this->input->post('branch_name');
        $number = $this->input->post('account_number');
        $name_ref = $this->input->post('name_ref');
        $ll_ref1 = $this->input->post('ll_ref1');
        $ll_ref2 = $this->input->post('ll_ref2');
        $e_mail1 = $this->input->post('e_mail1');
        $final_app = $this->input->post('final_app');
        $next_review = $this->input->post('next_review');
            
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('holder_name', 'holder name', 'trim|required|min_length[5]|max_length[120]|xss_clean');
        //$this->form_validation->set_rules('holder_name1', 'holder name1', 'trim|required|min_length[5]|max_length[120]|xss_clean');
     //$this->form_validation->set_rules('account_number', 'account_number', 'trim|required|min_length[5]|max_length[120]|xss_clean');
     //$this->form_validation->set_rules('branch_name', 'branch name', 'trim|required|min_length[5]|max_length[120]|xss_clean');
    
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            redirect("company/view?I=" .base64_encode($em_id));
            } else {
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'holder_name' => $holder,
                    'branch_name' => $branch,
                    'account_number' => $number,
                    'name_ref' => $name_ref,
                    'll_ref1' => $ll_ref1,
                    'll_ref2' => $ll_ref2,
                    'e_mail1' => $e_mail1,
                    'final_app' => $final_app,
                    'next_review' => $next_review
                         
                                    
                   
                );
            if(empty($id)){
                $success = $this->company_model->Add_AuditInfo($data);
                #$this->session->set_flashdata('feedback','Successfully Added');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Added";
            } else {
                $success = $this->company_model->Update_AuditInfo($id,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Updated";
            }
                       
        }
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
    public function Reset_Password_Hr(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('emid');
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep)
                );
        $success = $this->company_model->Reset_Password($id,$data);
        #$this->session->set_flashdata('feedback','Successfully Updated');
        #redirect("company/view?I=" .base64_encode($id));
                echo "Successfully Updated";
            } else {
        $this->session->set_flashdata('feedback','Please enter valid password');
        #redirect("company/view?I=" .base64_encode($id)); 
                echo "Please enter valid password";
            }

        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Reset_Password(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('emid');
        $oldp = sha1($this->input->post('old'));
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
        $pass = $this->employee_model->GetCompanyId($id);
        if($pass->em_password == $oldp){
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep)
                );
        $success = $this->employee_model->Reset_Password($id,$data);
        $this->session->set_flashdata('feedback','Successfully Updated');
        #redirect("employee/view?I=" .base64_encode($id));
                echo "Successfully Updated";
            } else {
        $this->session->set_flashdata('feedback','Please enter valid password');
        #redirect("employee/view?I=" .base64_encode($id));
                echo "Please enter valid password";
            }
        } else {
            $this->session->set_flashdata('feedback','Please enter valid password');
            #redirect("employee/view?I=" .base64_encode($id));
            echo "Please enter valid password";
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Department(){
        if($this->session->userdata('user_login_access') != False) {
        $data['department'] = $this->company_model->depselect();
        $this->load->view('backend/department',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Save_dep(){
        if($this->session->userdata('user_login_access') != False) {
       $dep = $this->input->post('department');
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters();
       $this->form_validation->set_rules('department','department','trim|required|xss_clean');

       if ($this->form_validation->run() == FALSE) {
           echo validation_errors();
           redirect('company/Department');
       }else{
        $data = array();
        $data = array('dep_name' => $dep);
        $success = $this->company_model->Add_Department($data);
        #$this->session->set_flashdata('feedback','Successfully Added');
        #redirect('companyDepartment');
       }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Designation(){
        if($this->session->userdata('user_login_access') != False) {
        $data['designation'] = $this->employee_model->desselect();
        $this->load->view('backend/designation',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Des_Save(){
        if($this->session->userdata('user_login_access') != False) {
        $des = $this->input->post('designation');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('designation','designation','trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            redirect('employee/Designation');
        }else{
            $data = array();
            $data = array('des_name' => $des);
            $success = $this->employee_model->Add_Designation($data);
            $this->session->set_flashdata('feedback','Successfully Added');
            redirect('employee/Designation');
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}
    }
    public function Assign_leave(){
        if($this->session->userdata('user_login_access') != False) {
        $emid = $this->input->post('em_id');
        $type = $this->input->post('typeid');
        $day = $this->input->post('noday');
        $year = $this->input->post('year');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('typeid','typeid','trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            #redirect('employee/Designation');
        }else{
            $data = array();
            $data = array(
                'emp_id' => $emid,
                'type_id' => $type,
                'day' => $day,
                'total_day' => '0',
                'year' => $year
            );
            $success = $this->employee_model->Add_Assign_Leave($data);
            echo "Successfully Added";
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}
    }
    public function Add_File(){
    if($this->session->userdata('user_login_access') != False) { 
    $em_id = $this->input->post('em_id');    		
    $file_title = $this->input->post('file_title');  
    $exp_date = $this->input->post('exp_date'); 
    $cer_no = $this->input->post('cer_no'); 		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('file_title', 'file_title', 'trim|required|min_length[2]|max_length[120]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			
			} else {
            if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
			$fileSize = $_FILES["file_url"]["size"]/1024;
			$fileType = $_FILES["file_url"]["type"];
			$new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xml|text|txt",
                'overwrite' => False,
                'max_size' => "40480000"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file_url')) {
                echo $this->upload->display_errors();
                #redirect("company/view?I=" .base64_encode($em_id));
			}
   
			else {
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'file_title' => $file_title,
                    'exp_date' => $exp_date,
                    'cer_no' => $cer_no,
                    'file_url' => $img_url
                );
            $success = $this->company_model->File_Upload($data); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            #redirect("company/view?I=" .base64_encode($em_id));
                echo "Successfully Updated";
			}
        }
            
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_File1(){
        if($this->session->userdata('user_login_access') != False) { 
        $em_id = $this->input->post('em_id');    		
        $file_title = $this->input->post('file_title');  
        $exp_date = $this->input->post('exp_date'); 
        $cer_no = $this->input->post('cer_no'); 
        $veh_name = $this->input->post('veh_name');	
        $next_date = $this->input->post('next_date');	
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('file_title', 'file_title', 'trim|required|min_length[2]|max_length[120]|xss_clean');
    
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                
                } else {
                if($_FILES['file_url']['name']){
                $file_name = $_FILES['file_url']['name'];
                $fileSize = $_FILES["file_url"]["size"]/1024;
                $fileType = $_FILES["file_url"]["type"];
                $new_file_name='';
                $new_file_name .= $file_name;
    
                $config = array(
                    'file_name' => $new_file_name,
                    'upload_path' => "./assets/images/users",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx|xml|text|txt",
                    'overwrite' => False,
                    'max_size' => "40480000"
                );
        
                $this->load->library('Upload', $config);
                $this->upload->initialize($config);                
                if (!$this->upload->do_upload('file_url')) {
                    echo $this->upload->display_errors();
                    #redirect("company/view?I=" .base64_encode($em_id));
                }
       
                else {
                    $path = $this->upload->data();
                    $img_url = $path['file_name'];
                    $data = array();
                    $data = array(
                        'em_id' => $em_id,
                        'file_title' => $file_title,
                        'exp_date' => $exp_date,
                        'cer_no' => $cer_no,
                        'veh_name' => $veh_name,
                        'next_date' => $next_date,
                        'file_url' => $img_url
                    );
                $success = $this->company_model->File_Upload1($data); 
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("company/view?I=" .base64_encode($em_id));
                    echo "Successfully Updated";
                }
            }
                
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
        }
    public function educationbyib(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$data['educationvalue'] = $this->employee_model->GetEduValue($id);
		echo json_encode($data);
        }
    else{
		redirect(base_url() , 'refresh');
	} 
        
    }
    public function experiencebyib(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$data['expvalue'] = $this->employee_model->GetExpValue($id);
		echo json_encode($data);
        }
    else{
		redirect(base_url() , 'refresh');
	} 
        
    }
    public function DisiplinaryByID(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$data['desipplinary'] = $this->employee_model->GetDesValue($id);
		echo json_encode($data);
        }
    else{
		redirect(base_url() , 'refresh');
	} 
        
    }
    public function EduvalueDelet(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$success = $this->employee_model->DeletEdu($id);
		echo "Successfully Deletd";
        }
    else{
		redirect(base_url() , 'refresh');
	} 
    }
    public function EXPvalueDelet(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$success = $this->employee_model->DeletEXP($id);
		echo "Successfully Deletd";
        }
    else{
		redirect(base_url() , 'refresh');
	} 
    }
    public function DeletDisiplinary(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('D');
		$success = $this->employee_model->DeletDisiplinary($id);
		#echo "Successfully Deletd";
            redirect('employee/Disciplinary');
        }
    else{
		redirect(base_url() , 'refresh');
	} 
    }
    public function Add_Salary(){
        if($this->session->userdata('user_login_access') != False) { 
        $sid = $this->input->post('sid');
        $aid = $this->input->post('aid');
        $did = $this->input->post('did');
        $em_id = $this->input->post('emid');
        $type = $this->input->post('typeid');
        $total = $this->input->post('total');
        $basic = $this->input->post('basic');
        $medical = $this->input->post('medical');
        $houserent = $this->input->post('houserent');
        $conveyance = $this->input->post('conveyance');
        $provident = $this->input->post('provident');
        $bima = $this->input->post('bima');
        $tax = $this->input->post('tax');
        $others = $this->input->post('others');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('total', 'total', 'trim|required|min_length[3]|max_length[10]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("employee/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'type_id' => $type,
                    'total' => $total
                );
            if(!empty($sid)){
                $success = $this->employee_model->Update_Salary($sid,$data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #echo "Successfully Updated";
                #$success = $this->employee_model->Add_Salary($data);
                #$insertId = $this->db->insert_id();
                #$this->session->set_flashdata('feedback','Successfully Added');
                #echo "Successfully Added";
                if(!empty($aid)){
                $data1 = array();
                $data1 = array(
                    'salary_id' => $sid,
                    'basic' => $basic,
                    'medical' => $medical,
                    'house_rent' => $houserent,
                    'conveyance' => $conveyance
                );
                $success = $this->employee_model->Update_Addition($aid,$data1);                    
                }
                if(!empty($did)){
                 $data2 = array();
                $data2 = array(
                    'salary_id' => $sid,
                    'provident_fund' => $provident,
                    'bima' => $bima,
                    'tax' => $tax,
                    'others' => $others
                );
                $success = $this->employee_model->Update_Deduction($did,$data2);                    
                }

                echo "Successfully Updated";                
            } else {
                $success = $this->employee_model->Add_Salary($data);
                $insertId = $this->db->insert_id();
                #$this->session->set_flashdata('feedback','Successfully Added');
                #echo "Successfully Added";
                $data1 = array();
                $data1 = array(
                    'salary_id' => $insertId,
                    'basic' => $basic,
                    'medical' => $medical,
                    'house_rent' => $houserent,
                    'conveyance' => $conveyance
                );
                $success = $this->employee_model->Add_Addition($data1);
                $data2 = array();
                $data2 = array(
                    'salary_id' => $insertId,
                    'provident_fund' => $provident,
                    'bima' => $bima,
                    'tax' => $tax,
                    'others' => $others
                );
                $success = $this->employee_model->Add_Deduction($data2); 
                echo "Successfully Added";
            }           
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
	public function confirm_mail_send($email,$pass_hash){
		$config = Array( 
		'protocol' => 'smtp', 
		'smtp_host' => 'ssl://smtp.googlemail.com', 
		'smtp_port' => 465, 
		'smtp_user' => 'mail.imojenpay.com', 
		'smtp_pass' => ''
		); 		  
         $from_email = "imojenpay@imojenpay.com"; 
         $to_email = $email; 
   
         //Load email library 
         $this->load->library('email',$config); 
   
         $this->email->from($from_email, 'Dotdev'); 
         $this->email->to($to_email);
         $this->email->subject('Hr Syatem'); 
		 $message	 =	"Your Login Email:"."$email";
		 $message	.=	"Your Password :"."$pass_hash"; 
         $this->email->message($message); 
   
         //Send mail 
         if($this->email->send()){ 
         	$this->session->set_flashdata('feedback','Kindly check your email To reset your password');
		 }
         else {
         $this->session->set_flashdata("feedback","Error in sending Email."); 
		 }			
	}
    public function Inactive_Company(){
        $data['invalidem'] = $this->company_model->getInvalidUser();
        $this->load->view('backend/invalid_company',$data);
    }
}