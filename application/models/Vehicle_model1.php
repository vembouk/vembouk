<?php

	class Vehicle_model1 extends CI_Model {


	function __consturct(){
	parent::__construct();
	
	}
    public function Add_HolidayInfo($data){
        $this->db->insert('holiday',$data);
    }

    // Add the application of leave with ID no ID
    public function Application_Apply($data){
        $this->db->insert('emp_leave1',$data);
    }

    // Add Earn leave with ID no ID
    public function Add_Earn_Leave($data){
        $this->db->insert('earned_vehicle',$data);
    }

    // Update application with employee ID
    public function Application_Apply_Update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('emp_leave1', $data);         
    }

    public function Add_leave_Info($data){
        $this->db->insert('vehicle_types',$data);
    }
    public function Application_Apply_Approve($data){
        $this->db->insert('assign_vehicle', $data);
    }
    public function GetAllHoliInfo(){
        $sql = "SELECT * FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetAllHoliInfoForCalendar(){
        $sql = "SELECT holiday_name AS `title`, from_date AS `start` FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return json_encode($result);
    }
    public function GetLeaveValue($id){
        $sql = "SELECT * FROM `holiday` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarneBalanceByEmCode($id){
        $sql = "SELECT `earned_vehicle`.*,
        `employee`.`em_id`,CONCAT(`first_name`, ' ', `last_name`) AS emname
        FROM `earned_vehicle`
        LEFT JOIN `employee` ON `earned_vehicle`.`em_id`=`employee`.`em_id`
        WHERE `earned_vehicle`.`em_id`='$id'";        
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveType($id){
        $sql = "SELECT * FROM `vehicle_types` WHERE `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetleavetypeInfo(){
        $sql = "SELECT * FROM `vehicle_types` WHERE `status`='1' ORDER BY `type_id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetleavetypeInfoid($id){
        $sql = "SELECT * FROM `vehicle_types` WHERE `status`='1' AND `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemassignLeaveType($emid,$id){
        $sql = "SELECT `hour` FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `type_id`='$id' ";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function GetTotalDay($type){
        $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemLeaveType($id,$year){
        $sql = "SELECT `assign_vehicle`.*,
        `vehicle_types`.`name`
        FROM `assign_vehicle`
        LEFT JOIN `vehicle_types` ON `assign_vehicle`.`type_id`=`vehicle_types`.`type_id`
        WHERE `assign_vehicle`.`emp_id`='$id' AND `dateyear`='$year'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetEmLEaveReport($emid, $day, $year){

        if($emid == "all") {
        $sql = "SELECT `emp_leave`.*,
                (SELECT SUM(`leave_duration`) 
                    FROM emp_leave
                    WHERE  MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
                    `employee`.`first_name`,`last_name`,`em_code`,
                    `vehicle_types`.`name`
                FROM `emp_leave`
                    LEFT JOIN `vehicle_types` ON `emp_leave`.`typeid`=`vehicle_types`.`type_id`
                    LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
                WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";
    } else {

        $sql = "SELECT `emp_leave`.*, (SELECT SUM(`leave_duration`) 
       FROM emp_leave
       WHERE  `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `vehicle_types`.`name`
        FROM `emp_leave`
        LEFT JOIN `vehicle_types` ON `emp_leave`.`typeid`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";

/*public function GetEmLEaveReport($emid, $date){

        if($emid == "all") {
            $sql = "SELECT `assign_vehicle`.*,
        `employee`.`first_name`,`last_name`,
        `vehicle_types`.`name`
        FROM `assign_vehicle`
        LEFT JOIN `vehicle_types` ON `assign_vehicle`.`type_id`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `assign_vehicle`.`emp_id`=`employee`.`em_id`
        WHERE `dateyear`='$date'
        ";
    } else {

        $sql = "SELECT `assign_vehicle`.*,
        `employee`.`first_name`,`last_name`,
        `vehicle_types`.`name`
        FROM `assign_vehicle`
        LEFT JOIN `vehicle_types` ON `assign_vehicle`.`type_id`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `assign_vehicle`.`emp_id`=`employee`.`em_id`
        WHERE `assign_vehicle`.`emp_id`='$emid' AND `dateyear`='$date'
        ";
    }

*/
        
    }
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result; 
}
    public function GetLeaveToday($date){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `apply_date`='$date'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function GetLeaveApply($id){
        $sql = "SELECT `emp_leave1`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `emp_leave1`
      LEFT JOIN `employee` ON `emp_leave1`.`em_id`=`employee`.`em_id` 
      WHERE `emp_leave1`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarnedleaveBalance(){
        $sql = "SELECT `earned_vehicle`.*, `employee`.`first_name`,`last_name`,`em_code` FROM `earned_vehicle` LEFT JOIN `employee` ON `earned_vehicle`.`em_id`=`employee`.`em_id` WHERE `earned_vehicle`.`hour` > 0 AND `employee`.`status`='ACTIVE'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function emEarnselectByLeave($emid){
        $sql = "SELECT * FROM `earned_vehicle` WHERE `em_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetallApplication($emid){
    $sql = "SELECT `emp_leave1`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `vehicle_types`.`type_id`,`name`
      FROM `emp_leave1`
      LEFT JOIN `employee` ON `emp_leave1`.`em_id`=`employee`.`em_id`
      LEFT JOIN `vehicle_types` ON `emp_leave1`.`typeid`=`vehicle_types`.`type_id`
      WHERE `emp_leave1`.`em_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function AllLeaveAPPlication(){
    $sql = "SELECT `emp_leave1`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `vehicle_types`.`type_id`,`name`
      FROM `emp_leave1`
      LEFT JOIN `employee` ON `emp_leave1`.`em_id`=`employee`.`em_id`
      LEFT JOIN `vehicle_types` ON `emp_leave1`.`typeid`=`vehicle_types`.`type_id`
      WHERE `emp_leave1`.`leave_status`='Not Approve'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function EmLeavesheet($emid){
    $sql = "SELECT `assign_vehicle`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `vehicle_types`.`type_id`,`name`
      FROM `assign_vehicle`
      LEFT JOIN `employee` ON `assign_vehicle`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `vehicle_types` ON `assign_vehicle`.`type_id`=`vehicle_types`.`type_id`
      WHERE `assign_vehicle`.`emp_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function Update_HolidayInfo($id,$data){
		$this->db->where('id', $id);
		$this->db->update('holiday',$data);         
    }

    public function Update_leave_Info($id,$data){
		$this->db->where('type_id', $id);
		$this->db->update('vehicle_types',$data);         
    }
    public function Assign_Duration_Update($type,$data){
        $this->db->where('type_id', $type);
        $this->db->update('assign_vehicle', $data);         
    }
    public function DeletHoliday($id){
        $this->db->delete('holiday',array('id'=> $id));        
    }
    public function DeletType($id){
        $this->db->delete('vehicle_types',array('type_id'=> $id));        
    }
    public function DeletApply($id){
        $this->db->delete('emp_leave',array('id'=> $id));        
    }




    public function updateAplicationAsResolved($id, $data){
        $this->db->where('id', $id);
        $this->db->update('emp_leave', $data);         
    }  

    public function getLeaveTypeTotal($emid, $type){
        $sql = "SELECT SUM(`hour`) AS 'totalTaken' FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function updateLeaveAssignedInfo($employeeID, $type, $data){
        
        $this->db->where('type_id', $type);
        $this->db->where('emp_id', $employeeID);
        $this->db->update('assign_vehicle', $data);         
    }

    public function UpdteEarnValue($emid,$data){
        $this->db->where('em_id', $emid);
        $this->db->update('earned_vehicle', $data);         
    }


    public function insertLeaveAssignedInfo($data){
        $this->db->insert('assign_vehicle', $data);
    }

    public function determineIfNewLeaveAssign($employeeId, $type){
         $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id` = '$employeeId' AND `assign_vehicle`.`type_id` = '$type'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_holiday_between_dates($day) {
        $sql = "SELECT * FROM `holiday` WHERE ('$day' = `holiday`.`from_date`) OR ('$day' BETWEEN `holiday`.`from_date` AND `holiday`.`to_date`)";
        $query = $this->db->query($sql);
        return $query->row();
    }



    public function emselect(){
        $sql = "SELECT * FROM `vehicle` WHERE `status`='ACTIVE'";
        $query=$this->db->query($sql);
          $result = $query->result();
          return $result;
        }
    }
?>    