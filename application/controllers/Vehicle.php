<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

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
        $this->load->model('vehicle_model');
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
        redirect('vehicle/Vehicles');
	}
    public function Vehicles(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['vehicle'] = $this->vehicle_model->emselect();
        $this->load->view('backend/vehicles',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_vehicle(){
        if($this->session->userdata('user_login_access') != False) { 
        $this->load->view('backend/add-vehicle');
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
    $est_year = $this->input->post('est_year');
    $is_expiry = $this->input->post('is_expiry');
    $in_expiry = $this->input->post('in_expiry');
    
    $email  = $this->input->post('email');
	//$username = $this->input->post('username');	
       $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters();
        // Validating Name Field
        $this->form_validation->set_rules('lname', 'lname', 'trim|required|xss_clean');
        /*validating email field*/
        //$this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			} else {
            if($this->vehicle_model->Does_email_exists($email) && $password != $confirm){
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
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_year' => $est_year,
                    'is_expiry' => $is_expiry,
                    'in_expiry' => $in_expiry,
                    'status'=>'ACTIVE',
                    'em_image'=>$img_url,
                );
                if($id){
            $success = $this->vehicle_model->Update($data,$id); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";
                } else {
            $success = $this->vehicle_model->Add($data);
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
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_year' => $est_year,
                    'is_expiry' => $is_expiry,
                    'in_expiry' => $in_expiry,
                    'status'=>'ACTIVE',
                );
                if($id){
            $success = $this->vehicle_model->Update($data,$id); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";        
            #redirect('vehicle/Add_vehicle'); 
                } else {
            $success = $this->vehicle_model->Add($data);
            #$this->confirm_mail_send($email,$pass_hash);        
            echo "Successfully Added";
            #redirect('vehicle/Add_vehicle');                     
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
    $est_year = $this->input->post('est_year');
    $is_expiry = $this->input->post('is_expiry');
    $in_expiry = $this->input->post('in_expiry');
	$status = $this->input->post('status');		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('lname', 'lname', 'trim|required|xss_clean');

        //$this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("vehicle/view?I=" .base64_encode($eid));
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
                #redirect("vehicle/view?I=" .base64_encode($eid));
			}
   
			else {
            $employee = $this->vehicle_model->GetBasic($id);
            $checkimage = "./assets/images/users/$employee->em_image";                 
                if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_code' => $eid,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_year' => $est_year,
                    'status'=>$status,
                    'is_expiry' =>$is_expiry,
                    'in_expiry' =>$in_expiry,
                    'em_image'=>$img_url,
                );
                if($id){
            $success = $this->vehicle_model->Update($data,$id); 
            $this->session->set_flashdata('feedback','Successfully Updated');
            echo "Successfully Updated";
                }
			}
        } else {
                $data = array();
                $data = array(
                    'em_code' => $eid,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'est_year' => $est_year,
                    'is_expiry' => $is_expiry,
                    'in_expiry' => $in_expiry,
                    'status'=>$status,
                );
                if($id){
            $success = $this->vehicle_model->Update($data,$id); 
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
        $data['basic'] = $this->vehicle_model->GetBasic($id);
        $data['permanent'] = $this->vehicle_model->GetperAddress($id);
        $data['present'] = $this->vehicle_model->GetpreAddress($id);
        $data['education'] = $this->vehicle_model->GetEducation($id);
        //$data['experience'] = $this->vehicle_model->GetExperience($id);
        $data['bankinfo'] = $this->vehicle_model->GetBankInfo($id);
        $data['tradeinfo'] = $this->vehicle_model->GetTradeInfo($id);
        $data['auditinfo'] = $this->vehicle_model->GetAuditInfo($id);
        $data['fileinfo'] = $this->vehicle_model->GetFileInfo($id);
        $data['fileinfo1'] = $this->vehicle_model->GetFileInfo1($id);
        $data['typevalue'] = $this->payroll_model->GetsalaryType();
        $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();    
        $data['salaryvalue'] = $this->vehicle_model->GetsalaryValue($id);
        $data['socialmedia'] = $this->vehicle_model->GetSocialValue($id);
            $year = date('Y');
        $data['Leaveinfo'] = $this->vehicle_model->GetLeaveiNfo($id,$year);
        $this->load->view('backend/vehicle_view',$data);
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
        $success = $this->vehicle_model->Reset_Password($id,$data);
        #$this->session->set_flashdata('feedback','Successfully Updated');
        #redirect("vehicle/view?I=" .base64_encode($id));
                echo "Successfully Updated";
            } else {
        $this->session->set_flashdata('feedback','Please enter valid password');
        #redirect("vehicle/view?I=" .base64_encode($id)); 
                echo "Please enter valid password";
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
                #redirect("vehicle/view?I=" .base64_encode($em_id));
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
            $success = $this->vehicle_model->File_Upload($data); 
            #$this->session->set_flashdata('feedback','Successfully Updated');
            #redirect("vehicle/view?I=" .base64_encode($em_id));
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
                    #redirect("vehicle/view?I=" .base64_encode($em_id));
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
                $success = $this->vehicle_model->File_Upload1($data); 
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("vehicle/view?I=" .base64_encode($em_id));
                    echo "Successfully Updated";
                }
            }
                
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
        }
    
        public function Application()
        {
            if ($this->session->userdata('user_login_access') != False) {
                $data['employee']    = $this->employee_model->emselect(); // gets active employee details
                $data['leavetypes']  = $this->leave_model->GetleavetypeInfo();
                $data['application'] = $this->leave_model->AllLeaveAPPlication();
                $this->load->view('backend/vehicle_approve', $data);
            } else {
                redirect(base_url(), 'refresh');
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
         $from_email = "kvembou@gmail.com"; 
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
    public function Inactive_Vehicle(){
        $data['invalidem'] = $this->vehicle_model->getInvalidUser();
        $this->load->view('backend/invalid_vehicle',$data);
    }

}