<?php

	class Leave_model extends CI_Model {


	function __consturct(){
	parent::__construct();
	
	}
// get the vehicle list from the vehicles we add already
    public function getvehicle(){
        $query = $this->db->get('vehicle');
        $result = $query->result();
        return $result;
      }
      public function emselect(){
        $sql = "SELECT * FROM `vehicle` WHERE `status`='ACTIVE'";
        $query=$this->db->query($sql);
          $result = $query->result();
          return $result;
        }
        // end vehicle get function
        
    public function Add_HolidayInfo($data){
        $this->db->insert('holiday',$data);
    }

    // Add the application of leave with ID no ID
    public function Application_Apply($data){
        $this->db->insert('emp_leave',$data);
    }

    // Add Earn leave with ID no ID
    public function Add_Earn_Leave($data){
        $this->db->insert('earned_leave',$data);
    }

    // Update application with employee ID
    public function Application_Apply_Update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('emp_leave', $data);         
    }

    public function Add_leave_Info($data){
        $this->db->insert('leave_types',$data);
    }
    public function Application_Apply_Approve($data){
        $this->db->insert('assign_leave', $data);
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
        $sql = "SELECT `earned_leave`.*,
        `employee`.`em_id`,CONCAT(`first_name`, ' ', `last_name`) AS emname
        FROM `earned_leave`
        LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id`
        WHERE `earned_leave`.`em_id`='$id'";        
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveType($id){
        $sql = "SELECT * FROM `leave_types` WHERE `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetleavetypeInfo(){
        $sql = "SELECT * FROM `leave_types` WHERE `status`='1' ORDER BY `type_id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetleavetypeInfoid($id){
        $sql = "SELECT * FROM `leave_types` WHERE `status`='1' AND `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemassignLeaveType($emid,$id,$year){
        $sql = "SELECT `hour` FROM `assign_leave` WHERE `assign_leave`.`emp_id`='$emid' AND `type_id`='$id' AND `dateyear`='$year'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function GetTotalDay($type){
        $sql = "SELECT * FROM `assign_leave` WHERE `assign_leave`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemLeaveType($id,$year){
        $sql = "SELECT `assign_leave`.*,
        `leave_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
        WHERE `assign_leave`.`emp_id`='$id' AND `dateyear`='$year'
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
                    `leave_types`.`name`
                FROM `emp_leave`
                    LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
                    LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
                WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";
    } else {

        $sql = "SELECT `emp_leave`.*, (SELECT SUM(`leave_duration`) 
       FROM emp_leave
       WHERE  `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `leave_types`.`name`
        FROM `emp_leave`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";

/*public function GetEmLEaveReport($emid, $date){

        if($emid == "all") {
            $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `leave_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `dateyear`='$date'
        ";
    } else {

        $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `leave_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `assign_leave`.`emp_id`='$emid' AND `dateyear`='$date'
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
        $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id` 
      WHERE `emp_leave`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarnedleaveBalance(){
        $sql = "SELECT `earned_leave`.*, `employee`.`first_name`,`last_name`,`em_code` FROM `earned_leave` LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id` WHERE `earned_leave`.`hour` > 0 AND `employee`.`status`='ACTIVE'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function emEarnselectByLeave($emid){
        $sql = "SELECT * FROM `earned_leave` WHERE `em_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetallApplication($emid){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      WHERE `emp_leave`.`em_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function AllLeaveAPPlication(){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      WHERE `emp_leave`.`leave_status`='Not Approve'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function EmLeavesheet($emid){
    $sql = "SELECT `assign_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`
      FROM `assign_leave`
      LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
      WHERE `assign_leave`.`emp_id`='$emid'";
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
		$this->db->update('leave_types',$data);         
    }
    public function Assign_Duration_Update($type,$data){
        $this->db->where('type_id', $type);
        $this->db->update('assign_leave', $data);         
    }
    public function DeletHoliday($id){
        $this->db->delete('holiday',array('id'=> $id));        
    }
    public function DeletType($id){
        $this->db->delete('leave_types',array('type_id'=> $id));        
    }
    public function DeletApply($id){
        $this->db->delete('emp_leave',array('id'=> $id));        
    }




    public function updateAplicationAsResolved($id, $data){
        $this->db->where('id', $id);
        $this->db->update('emp_leave', $data);         
    }  

    public function getLeaveTypeTotal($emid, $type){
        $sql = "SELECT SUM(`hour`) AS 'totalTaken' FROM `assign_leave` WHERE `assign_leave`.`emp_id`='$emid' AND `assign_leave`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function updateLeaveAssignedInfo($employeeID, $type, $data){
        
        $this->db->where('type_id', $type);
        $this->db->where('emp_id', $employeeID);
        $this->db->update('assign_leave', $data);         
    }

    public function UpdteEarnValue($emid,$data){
        $this->db->where('em_id', $emid);
        $this->db->update('earned_leave', $data);         
    }


    public function insertLeaveAssignedInfo($data){
        $this->db->insert('assign_leave', $data);
    }

    public function determineIfNewLeaveAssign($employeeId, $type){
         $sql = "SELECT * FROM `assign_leave` WHERE `assign_leave`.`emp_id` = '$employeeId' AND `assign_leave`.`type_id` = '$type'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_holiday_between_dates($day) {
        $sql = "SELECT * FROM `holiday` WHERE ('$day' = `holiday`.`from_date`) OR ('$day' BETWEEN `holiday`.`from_date` AND `holiday`.`to_date`)";
        $query = $this->db->query($sql);
        return $query->row();
    }







// Vehicle model start


   /* public function Add_HolidayInfo($data){
        $this->db->insert('holiday',$data);
    }
*/
    // Add the application of leave with ID no ID
    public function Application_Apply1($data){
        $this->db->insert('vehicle_application',$data);
    }

    // Add Earn leave with ID no ID
    public function Add_Earn_Leave1($data){
        $this->db->insert('earned_vehicle',$data);
    }

    // Update application with employee ID
    public function Application_Apply_Update1($id, $data){
        $this->db->where('id', $id);
        $this->db->update('vehicle_application', $data);         
    }

    public function Add_leave_Info1($data){
        $this->db->insert('vehicle_types',$data);
    }
    public function Application_Apply_Approve1($data){
        $this->db->insert('assign_vehicle', $data);
    }
    public function GetAllHoliInfo1(){
        $sql = "SELECT * FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetAllHoliInfoForCalendar1(){
        $sql = "SELECT holiday_name AS `title`, from_date AS `start` FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return json_encode($result);
    }
    public function GetLeaveValue1($id){
        $sql = "SELECT * FROM `holiday` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarneBalanceByEmCode1($id){
        $sql = "SELECT `earned_leave`.*,
        `employee`.`em_id`,CONCAT(`first_name`, ' ', `last_name`) AS emname
        FROM `earned_leave`
        LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id`
        WHERE `earned_leave`.`em_id`='$id'";        
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveType1($id){
        $sql = "SELECT * FROM `vehicle_types` WHERE `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetleavetypeInfo1(){
        $sql = "SELECT * FROM `vehicle_types` WHERE `status`='1' ORDER BY `type_id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetleavetypeInfoid1($id){
        $sql = "SELECT * FROM `vehicle_types` WHERE `status`='1' AND `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemassignLeaveType1($emid,$id,$year){
        $sql = "SELECT `hour` FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `type_id`='$id' AND `dateyear`='$year'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function GetTotalDay1($type){
        $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemLeaveType1($id,$year){
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
    public function GetEmLEaveReport1($emid, $day, $year){

        if($emid == "all") {
        $sql = "SELECT `vehicle_application`.*,
                (SELECT SUM(`leave_duration`) 
                    FROM vehicle_application
                    WHERE  MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
                    `employee`.`first_name`,`last_name`,`em_code`,
                    `vehicle_types`.`name`
                FROM `vehicle_application`
                    LEFT JOIN `vehicle_types` ON `vehicle_application`.`typeid`=`vehicle_types`.`type_id`
                    LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id`
                WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";
    } else {

        $sql = "SELECT `vehicle_application`.*, (SELECT SUM(`leave_duration`) 
       FROM vehicle_application
       WHERE  `vehicle_application`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `vehicle_types`.`name`
        FROM `vehicle_application`
        LEFT JOIN `vehicle_types` ON `vehicle_application`.`typeid`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id`
        WHERE `vehicle_application`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";

/*public function GetEmLEaveReport($emid, $date){

        if($emid == "all") {
            $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `vehicle_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `vehicle_types` ON `assign_leave`.`type_id`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `dateyear`='$date'
        ";
    } else {

        $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `vehicle_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `vehicle_types` ON `assign_leave`.`type_id`=`vehicle_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `assign_leave`.`emp_id`='$emid' AND `dateyear`='$date'
        ";
    }

*/
        
    }
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result; 
}
    public function GetLeaveToday1($date){
    $sql = "SELECT `vehicle_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `vehicle_application`
      LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id`
        WHERE `apply_date`='$date'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function GetLeaveApply1($id){
        $sql = "SELECT `vehicle_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `vehicle_application`
      LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id` 
      WHERE `vehicle_application`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarnedleaveBalance1(){
        $sql = "SELECT `earned_leave`.*, `employee`.`first_name`,`last_name`,`em_code` FROM `earned_leave` LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id` WHERE `earned_leave`.`hour` > 0 AND `employee`.`status`='ACTIVE'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function emEarnselectByLeave1($emid){
        $sql = "SELECT * FROM `earned_leave` WHERE `em_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetallApplication1($emid){
    $sql = "SELECT `vehicle_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `vehicle_types`.`type_id`,`name`
      FROM `vehicle_application`
      LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id`
      LEFT JOIN `vehicle_types` ON `vehicle_application`.`typeid`=`vehicle_types`.`type_id`
      WHERE `vehicle_application`.`em_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function AllLeaveAPPlication1(){
    $sql = "SELECT `vehicle_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `vehicle_types`.`type_id`,`name`
      FROM `vehicle_application`
      LEFT JOIN `employee` ON `vehicle_application`.`em_id`=`employee`.`em_id`
      LEFT JOIN `vehicle_types` ON `vehicle_application`.`typeid`=`vehicle_types`.`type_id`
      WHERE `vehicle_application`.`leave_status`='Not Approve'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function EmLeavesheet1($emid){
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
    public function Update_HolidayInfo1($id,$data){
		$this->db->where('id', $id);
		$this->db->update('holiday',$data);         
    }

    public function Update_leave_Info1($id,$data){
		$this->db->where('type_id', $id);
		$this->db->update('vehicle_types',$data);         
    }
    public function Assign_Duration_Update1($type,$data){
        $this->db->where('type_id', $type);
        $this->db->update('assign_vehicle', $data);         
    }
    public function DeletHoliday1($id){
        $this->db->delete('holiday',array('id'=> $id));        
    }
    public function DeletType1($id){
        $this->db->delete('vehicle_types',array('type_id'=> $id));        
    }
    public function DeletApply1($id){
        $this->db->delete('vehicle_application',array('id'=> $id));        
    }




    public function updateAplicationAsResolved1($id, $data){
        $this->db->where('id', $id);
        $this->db->update('vehicle_application', $data);         
    }  

    public function getLeaveTypeTotal1($emid, $type){
        $sql = "SELECT SUM(`hour`) AS 'totalTaken' FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function updateLeaveAssignedInfo1($employeeID, $type, $data){
        
        $this->db->where('type_id', $type);
        $this->db->where('emp_id', $employeeID);
        $this->db->update('assign_vehicle', $data);         
    }

    public function UpdteEarnValue1($emid,$data){
        $this->db->where('em_id', $emid);
        $this->db->update('earned_leave', $data);         
    }


    public function insertLeaveAssignedInfo1($data){
        $this->db->insert('assign_vehicle', $data);
    }

    public function determineIfNewLeaveAssign1($employeeId, $type){
         $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id` = '$employeeId' AND `assign_vehicle`.`type_id` = '$type'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_holiday_between_dates1($day) {
        $sql = "SELECT * FROM `holiday` WHERE ('$day' = `holiday`.`from_date`) OR ('$day' BETWEEN `holiday`.`from_date` AND `holiday`.`to_date`)";
        $query = $this->db->query($sql);
        return $query->row();
    }







    // Qhse model start


   /* public function Add_HolidayInfo($data){
        $this->db->insert('holiday',$data);
    }
*/
    // Add the application of leave with ID no ID
    public function Application_Apply2($data){
        $this->db->insert('qhse_application',$data);
    }

    // Add Earn leave with ID no ID
    public function Add_Earn_Leave2($data){
        $this->db->insert('earned_vehicle',$data);
    }

    // Update application with employee ID
    public function Application_Apply_Update2($id, $data){
        $this->db->where('id', $id);
        $this->db->update('qhse_application', $data);         
    }

    public function Add_leave_Info2($data){
        $this->db->insert('qhse_types',$data);
    }
    public function Application_Apply_Approve2($data){
        $this->db->insert('assign_vehicle', $data);
    }
    public function GetAllHoliInfo2(){
        $sql = "SELECT * FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetAllHoliInfoForCalendar2(){
        $sql = "SELECT holiday_name AS `title`, from_date AS `start` FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return json_encode($result);
    }
    public function GetLeaveValue2($id){
        $sql = "SELECT * FROM `holiday` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarneBalanceByEmCode2($id){
        $sql = "SELECT `earned_leave`.*,
        `employee`.`em_id`,CONCAT(`first_name`, ' ', `last_name`) AS emname
        FROM `earned_leave`
        LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id`
        WHERE `earned_leave`.`em_id`='$id'";        
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveType2($id){
        $sql = "SELECT * FROM `qhse_types` WHERE `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetleavetypeInfo2(){
        $sql = "SELECT * FROM `qhse_types` WHERE `status`='1' ORDER BY `type_id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetleavetypeInfoid2($id){
        $sql = "SELECT * FROM `qhse_types` WHERE `status`='1' AND `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemassignLeaveType2($emid,$id,$year){
        $sql = "SELECT `hour` FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `type_id`='$id' AND `dateyear`='$year'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function GetTotalDay2($type){
        $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemLeaveType2($id,$year){
        $sql = "SELECT `assign_vehicle`.*,
        `qhse_types`.`name`
        FROM `assign_vehicle`
        LEFT JOIN `qhse_types` ON `assign_vehicle`.`type_id`=`qhse_types`.`type_id`
        WHERE `assign_vehicle`.`emp_id`='$id' AND `dateyear`='$year'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetEmLEaveReport2($emid, $day, $year){

        if($emid == "all") {
        $sql = "SELECT `qhse_application`.*,
                (SELECT SUM(`leave_duration`) 
                    FROM qhse_application
                    WHERE  MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
                    `employee`.`first_name`,`last_name`,`em_code`,
                    `qhse_types`.`name`
                FROM `qhse_application`
                    LEFT JOIN `qhse_types` ON `qhse_application`.`typeid`=`qhse_types`.`type_id`
                    LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id`
                WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";
    } else {

        $sql = "SELECT `qhse_application`.*, (SELECT SUM(`leave_duration`) 
       FROM qhse_application
       WHERE  `qhse_application`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `qhse_types`.`name`
        FROM `qhse_application`
        LEFT JOIN `qhse_types` ON `qhse_application`.`typeid`=`qhse_types`.`type_id`
        LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id`
        WHERE `qhse_application`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year'";

/*public function GetEmLEaveReport($emid, $date){

        if($emid == "all") {
            $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `qhse_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `qhse_types` ON `assign_leave`.`type_id`=`qhse_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `dateyear`='$date'
        ";
    } else {

        $sql = "SELECT `assign_leave`.*,
        `employee`.`first_name`,`last_name`,
        `qhse_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `qhse_types` ON `assign_leave`.`type_id`=`qhse_types`.`type_id`
        LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
        WHERE `assign_leave`.`emp_id`='$emid' AND `dateyear`='$date'
        ";
    }

*/
        
    }
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result; 
}
    public function GetLeaveToday2($date){
    $sql = "SELECT `qhse_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `qhse_application`
      LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id`
        WHERE `apply_date`='$date'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function GetLeaveApply2($id){
        $sql = "SELECT `qhse_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `qhse_application`
      LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id` 
      WHERE `qhse_application`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarnedleaveBalance2(){
        $sql = "SELECT `earned_leave`.*, `employee`.`first_name`,`last_name`,`em_code` FROM `earned_leave` LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id` WHERE `earned_leave`.`hour` > 0 AND `employee`.`status`='ACTIVE'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function emEarnselectByLeave2($emid){
        $sql = "SELECT * FROM `earned_leave` WHERE `em_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetallApplication2($emid){
    $sql = "SELECT `qhse_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `qhse_types`.`type_id`,`name`
      FROM `qhse_application`
      LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id`
      LEFT JOIN `qhse_types` ON `qhse_application`.`typeid`=`qhse_types`.`type_id`
      WHERE `qhse_application`.`em_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function AllLeaveAPPlication2(){
    $sql = "SELECT `qhse_application`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `qhse_types`.`type_id`,`name`
      FROM `qhse_application`
      LEFT JOIN `employee` ON `qhse_application`.`em_id`=`employee`.`em_id`
      LEFT JOIN `qhse_types` ON `qhse_application`.`typeid`=`qhse_types`.`type_id`
      WHERE `qhse_application`.`leave_status`='Not Approve'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function EmLeavesheet2($emid){
    $sql = "SELECT `assign_vehicle`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `qhse_types`.`type_id`,`name`
      FROM `assign_vehicle`
      LEFT JOIN `employee` ON `assign_vehicle`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `qhse_types` ON `assign_vehicle`.`type_id`=`qhse_types`.`type_id`
      WHERE `assign_vehicle`.`emp_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function Update_HolidayInfo2($id,$data){
		$this->db->where('id', $id);
		$this->db->update('holiday',$data);         
    }

    public function Update_leave_Info2($id,$data){
		$this->db->where('type_id', $id);
		$this->db->update('qhse_types',$data);         
    }
    public function Assign_Duration_Update2($type,$data){
        $this->db->where('type_id', $type);
        $this->db->update('assign_vehicle', $data);         
    }
    public function DeletHoliday2($id){
        $this->db->delete('holiday',array('id'=> $id));        
    }
    public function DeletType2($id){
        $this->db->delete('qhse_types',array('type_id'=> $id));        
    }
    public function DeletApply2($id){
        $this->db->delete('qhse_application',array('id'=> $id));        
    }




    public function updateAplicationAsResolved2($id, $data){
        $this->db->where('id', $id);
        $this->db->update('qhse_application', $data);         
    }  

    public function getLeaveTypeTotal2($emid, $type){
        $sql = "SELECT SUM(`hour`) AS 'totalTaken' FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id`='$emid' AND `assign_vehicle`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function updateLeaveAssignedInfo2($employeeID, $type, $data){
        
        $this->db->where('type_id', $type);
        $this->db->where('emp_id', $employeeID);
        $this->db->update('assign_vehicle', $data);         
    }

    public function UpdteEarnValue2($emid,$data){
        $this->db->where('em_id', $emid);
        $this->db->update('earned_leave', $data);         
    }


    public function insertLeaveAssignedInfo2($data){
        $this->db->insert('assign_vehicle', $data);
    }

    public function determineIfNewLeaveAssign2($employeeId, $type){
         $sql = "SELECT * FROM `assign_vehicle` WHERE `assign_vehicle`.`emp_id` = '$employeeId' AND `assign_vehicle`.`type_id` = '$type'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_holiday_between_dates2($day) {
        $sql = "SELECT * FROM `holiday` WHERE ('$day' = `holiday`.`from_date`) OR ('$day' BETWEEN `holiday`.`from_date` AND `holiday`.`to_date`)";
        $query = $this->db->query($sql);
        return $query->row();
    }

    }
?>    