<?php

	class Company_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}

	public function getdesignation(){
	$query = $this->db->get('designation');
	$result = $query->result();
	return $result;
	}
    public function getdepartment(){
	$query = $this->db->get('department');
	$result = $query->result();
	return $result;
	}
  public function getcompany(){
    $query = $this->db->get('company');
    $result = $query->result();
    return $result;
  }
  
    public function emselect(){
    $sql = "SELECT * FROM `company` WHERE `status`='ACTIVE'";
    $query=$this->db->query($sql);
  	$result = $query->result();
  	return $result;
	}
    public function emselectByID($emid){
    $sql = "SELECT * FROM `company`
      WHERE `em_id`='$emid'";
    $query=$this->db->query($sql);
	$result = $query->row();
	return $result;
	}
    public function emselectByCode($emid){
    $sql = "SELECT * FROM `company`
      WHERE `em_code`='$emid'";
    $query=$this->db->query($sql);
	$result = $query->row();
	return $result;
	}
    public function getInvalidUser(){
      $sql = "SELECT * FROM `company`
      WHERE `status`='INACTIVE'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;
	}
    public function Does_email_exists($email) {
		$user = $this->db->dbprefix('company');
        $sql = "SELECT `em_email` FROM $user
		WHERE `em_email`='$email'";
		$result=$this->db->query($sql);
        if ($result->row()) {
            return $result->row();
        } else {
            return false;
        }
    }
    public function Add($data){
        $this->db->insert('company',$data);
    }
    public function GetBasic($id){
      $sql = "SELECT `company`.*,
      `designation`.*,
      `department`.*
      FROM `company`
      LEFT JOIN `designation` ON `company`.`des_id`=`designation`.`id`
      LEFT JOIN `department` ON `company`.`dep_id`=`department`.`id`
      WHERE `em_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function Projectcompany($id){
      $sql = "SELECT `assign_task`.`assign_user`,
      `company`.`em_id`,`first_name`,`last_name`
      FROM `assign_task`
      LEFT JOIN `company` ON `assign_task`.`assign_user`=`company`.`em_id`
      WHERE `assign_task`.`project_id`='$id' AND `user_type`='Team Head'";
      $query=$this->db->query($sql);
      $result = $query->result();
      return $result;          
    }
    public function GetperAddress($id){
      $sql = "SELECT * FROM `cus_address`
      WHERE `emp_id`='$id' AND `type`='Permanent'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetpreAddress($id){
      $sql = "SELECT * FROM `cus_address`
      WHERE `emp_id`='$id' AND `type`='Present'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetEducation($id){
      $sql = "SELECT * FROM `education`
      WHERE `emp_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
   /* public function GetExperience($id){
      $sql = "SELECT * FROM `emp_experience`
      WHERE `emp_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }*/
    public function GetBankInfo($id){
      $sql = "SELECT * FROM `cus_bank_info`
      WHERE `em_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetTradeInfo($id){
      $sql = "SELECT * FROM `trade`
      WHERE `em_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetAuditInfo($id){
      $sql = "SELECT * FROM `audit`
      WHERE `em_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetAllcompany(){
      $sql = "SELECT * FROM `company`";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function desciplinaryfetch(){
      $sql = "SELECT `desciplinary`.*,
      `company`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `desciplinary`
      LEFT JOIN `company` ON `desciplinary`.`em_id`=`company`.`em_id`";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
    }
    public function GetLeaveiNfo($id,$year){
      $sql = "SELECT `assign_leave`.*,
      `leave_types`.`name`
      FROM `assign_leave`
      LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
      WHERE `assign_leave`.`emp_id`='$id' AND `dateyear`='$year'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
    }
    public function GetsalaryValue($id){
      $sql = "SELECT `emp_salary`.*,
      `addition`.*,
      `deduction`.*,
      `salary_type`.*
      FROM `emp_salary`
      LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
      LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
      LEFT JOIN `salary_type` ON `emp_salary`.`type_id`=`salary_type`.`id`
      WHERE `emp_salary`.`emp_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;        
    }
    public function Update($data,$id){
		$this->db->where('em_id', $id);
		$this->db->update('company',$data);        
    }
    public function Update_Education($id,$data){
		$this->db->where('id', $id);
		$this->db->update('education',$data);        
    }
    public function Update_BankInfo($id,$data){
		$this->db->where('id', $id);
		$this->db->update('cus_bank_info',$data);        
    }
    public function Update_TradeInfo($id,$data){
      $this->db->where('id', $id);
      $this->db->update('trade',$data);        
      }
      public function Update_AuditInfo($id,$data){
        $this->db->where('id', $id);
        $this->db->update('audit',$data);        
        }
    public function UpdateParmanent_Address($id,$data){
		$this->db->where('id', $id);
		$this->db->update('cus_address',$data);        
    }
    public function Reset_Password($id,$data){
		$this->db->where('em_id', $id);
		$this->db->update('company',$data);        
    }
    public function Update_Experience($id,$data){
		$this->db->where('id', $id);
		$this->db->update('emp_experience',$data);        
    }
    public function Update_Salary($sid,$data){
		$this->db->where('id', $sid);
		$this->db->update('emp_salary',$data);        
    }
    public function Update_Deduction($did,$data){
		$this->db->where('de_id', $did);
		$this->db->update('deduction',$data);        
    }
    public function Update_Addition($aid,$data){
		$this->db->where('addi_id', $aid);
		$this->db->update('addition',$data);        
    }
    public function Update_Desciplinary($id,$data){
		$this->db->where('id', $id);
		$this->db->update('desciplinary',$data);        
    }
    public function Update_Media($id,$data){
		$this->db->where('id', $id);
		$this->db->update('social_media',$data);        
    }
    public function AddParmanent_Address($data){
        $this->db->insert('cus_address',$data);
    } 
    public function Add_education($data){
        $this->db->insert('education',$data);
    }
    public function Add_Experience($data){
        $this->db->insert('emp_experience',$data);
    }
    public function Add_Desciplinary($data){
        $this->db->insert('desciplinary',$data);
    }
    public function Add_BankInfo($data){
        $this->db->insert('cus_bank_info',$data);
    }
    public function Add_TradeInfo($data){
      $this->db->insert('trade',$data);
  }
  public function Add_AuditInfo($data){
    $this->db->insert('audit',$data);
}
    public function GetcompanyId($id){
        $sql = "SELECT `em_password` FROM `company` WHERE `em_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetFileInfo($id){
        $sql = "SELECT * FROM `company_file` WHERE `em_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }

    public function GetFileInfo1($id){
        $sql = "SELECT * FROM `fleet_file` WHERE `em_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetSocialValue($id){
        $sql = "SELECT * FROM `social_media` WHERE `emp_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEduValue($id){
        $sql = "SELECT * FROM `education` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetExpValue($id){
        $sql = "SELECT * FROM `emp_experience` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetDesValue($id){
        $sql = "SELECT * FROM `desciplinary` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    } 
	public function depselect(){
  	$query = $this->db->get('department');
  	$result = $query->result();
  	return $result;
	}
    public function Add_Department($data){
    $this->db->insert('department',$data);
  }

    public function Add_Designation($data){
      $this->db->insert('designation',$data);
    }
    public function File_Upload($data){
    $this->db->insert('company_file',$data);
  }
  public function File_Upload1($data){
    $this->db->insert('fleet_file',$data);
  }
    public function Add_Salary($data){
    $this->db->insert('emp_salary',$data);
  }
    public function Add_Addition($data1){
    $this->db->insert('addition',$data1);
  }
    public function Add_Deduction($data2){
    $this->db->insert('deduction',$data2);
  }
    public function Add_Assign_Leave($data){
    $this->db->insert('assign_leave',$data);
  }
    public function Insert_Media($data){
    $this->db->insert('social_media',$data);
  }
    public function desselect(){
  	$query = $this->db->get('designation');
  	$result = $query->result();
  	return $result;
	}
    public function DeletEdu($id){
      $this->db->delete('education',array('id'=> $id));
  }
    public function DeletEXP($id){
      $this->db->delete('emp_experience',array('id'=> $id));
  }
    public function DeletDisiplinary($id){
      $this->db->delete('desciplinary',array('id'=> $id));
  }        
    }
?>