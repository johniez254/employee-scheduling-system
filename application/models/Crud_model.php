<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
		
	public function settings_post($settingsId='1'){
		if($settingsId){
			$update_data = array(
				'systemname' => $this->input->post('sname'),
				'abbr' => $this->input->post('abr'),
				'email' => $this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
			);
				$this->db->where('id', $settingsId);
				$status = $this->db->update('settings', $update_data);		
				return ($status == true ? true : false);
		}
	}
		
	public function profile_post($userId=null){
		if($userId){
			$update_data = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
			);
				$this->db->where('id', $userId);
				$status = $this->db->update('login', $update_data);		
				return ($status == true ? true : false);
		}
	}
		
	public function user_profile_post($userId=null){
		if($userId){
			
			$update_user = array(
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'fullnames' => $this->input->post('name'),
			);
			
				$this->db->where('login_id', $userId);
				$status = $this->db->update('users', $update_user);
				
			$update_data = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
			);
				$this->db->where('id', $userId);
				$status = $this->db->update('login', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	
	public function password_post($userId=null){
		if($userId){
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);			
				$data=array(
				'password'=>$newpass,
				);
				$this->db->where('id',$userId);
				$status=$this->db->update('login',$data);
				return ($status == true ? true : false);
			}
	}
	
	public function password_validate($password = null)
	{
		if($password) {
			$oldpass=$this->input->post('oldpass');
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);
			$username=$this->input->post('username');
			
			$query=$this->db->get_where('login', array('username' => $username))->result_array();
			foreach($query as $row):
				$fetched_pass=$row['password'];
			endforeach;
			
			if(password_verify($oldpass,$fetched_pass)){
				
				$this->db->where('username', $username);
				$this->db->where('password', $fetched_pass);
				$query=$this->db->get('login');
				
				return ($query->num_rows() === 1 ? true : false);
			}
		}	
		else {
			return false;
		}
	} // /validate password function
		
	public function station_add(){
			$add_data = array(
				'station_name' => $this->input->post('station'),
				'date_added' => strtotime($this->input->post('d')),
			);
				$status = $this->db->insert('station', $add_data);		
				return ($status == true ? true : false);
	}
	
	public function station_update($stationId=null){
		if($stationId){
			$update_data = array(
				'station_name' => $this->input->post('s'),
			);
				$this->db->where('station_id',$stationId);
				$status = $this->db->update('station', $update_data);		
				return ($status == true ? true : false);
		}
	}
	public function employee_post(){
			$password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
			$data_login=array(
				'username' => $this->input->post('username'),
				'password' => $password,
				'role' => 'user',
			);
			$this->db->insert('login', $data_login);
			$userId = $this->db->insert_id();
		 	
			//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');	
			
			$data = array(
				'fullnames' => $this->input->post('fullnames'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'date_reg'=>$this->input->post('datereg'),
				'address'=>$this->input->post('address'),
				'idno'=>$this->input->post('idno'),
				'login_id'=>$userId,
				'date_reg'=>strtotime($this->input->post('d')),
			);
				$status = $this->db->insert('users', $data);		
				return ($status == true ? true : false);
	}
	public function employee_update($employeeId=null){
		if($employeeId){
			$update_data = array(
				'fullnames' => $this->input->post('u_fullnames'),
				'phone' => $this->input->post('u_phone'),
				'address' => $this->input->post('u_address'),
			);
				$this->db->where('id',$employeeId);
				$status = $this->db->update('users', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	public function shifts($p1='',$p2='',$p3=''){
		if($p1=="add_shift"){
			
			//get today date
			$now_date=date('m/d/Y');
			//convert today date to strtotime
			//$str_now_date=strtotime($now_date);
			
			//posted shift start/end times
			$from=$this->input->post('from');
			$to=$this->input->post('to');
			
			//change posted time to strtotime format
			$str_from=strtotime($from);
			$str_to=strtotime($to);
									
			//get pm/am only formats from the strtotime format
			$from_pm_am=date('a',$str_from);
			$to_pm_am=date('a',$str_to);
			
			if($from_pm_am=="am" && $to_pm_am=="am" or $from_pm_am=="am" && $to_pm_am=="pm" or $from_pm_am=="pm" && $to_pm_am=="pm"){
				
				$start=new DateTime($from);
				$end=new DateTime($to);
				$interval=$start->diff($end);
					
				//get hours difference between the two times
				$hours_difference=$interval->format('%h');
				//echo $output;
				
				$add_data = array(
				'station_id' => $this->input->post('station'),
				'shift_name' => $this->input->post('shift'),
				'start_time' => $str_from,
				'end_time' => $str_to,
				'hours_worked'=>$hours_difference,
			);
				$status = $this->db->insert('shifts', $add_data);		
				return ($status == true ? true : false);
			}else{//time format is pm to am (gone to the next day)
				
				//Add one day from today
				$tomorrow=strtotime("+1 days",strtotime($now_date));
				$str_tomorrow=date('m/d/Y',$tomorrow);
			
				$start=new DateTime($now_date. $from);
				$end=new DateTime($str_tomorrow. $to);
				$interval=$start->diff($end);
					
				//get hours difference between the two times
				$hours_difference=$interval->format('%h');
				//echo $output;
				
				//post data to be inserted to shifts table in db in form of array
				$add_data = array(
					'station_id' => $this->input->post('station'),
					'shift_name' => $this->input->post('shift'),
					'start_time' => $str_from,
					'end_time' => $str_to,
					'hours_worked'=>$hours_difference,
				);
				$status = $this->db->insert('shifts', $add_data);		
				return ($status == true ? true : false);
				
			}//end else statement
			
			
		}
		
		//update shift
		if($p1=="update_shift"){
			
			//get today date
			$now_date=date('m/d/Y');
			//convert today date to strtotime
			//$str_now_date=strtotime($now_date);
			
			//posted shift start/end times
			$from=$this->input->post('u_from');
			$to=$this->input->post('u_to');
			
			//change posted time to strtotime format
			$str_from=strtotime($from);
			$str_to=strtotime($to);
									
			//get pm/am only formats from the strtotime format
			$from_pm_am=date('a',$str_from);
			$to_pm_am=date('a',$str_to);
			
			if($from_pm_am=="am" && $to_pm_am=="am" or $from_pm_am=="am" && $to_pm_am=="pm" or $from_pm_am=="pm" && $to_pm_am=="pm"){
				
				$start=new DateTime($from);
				$end=new DateTime($to);
				$interval=$start->diff($end);
					
				//get hours difference between the two times
				$hours_difference=$interval->format('%h');
				//echo $output;
				
				$update_data = array(
				'station_id' => $this->input->post('u_station'),
				'shift_name' => $this->input->post('u_shift'),
				'start_time' => $str_from,
				'end_time' => $str_to,
				'hours_worked'=>$hours_difference,
			);
				$this->db->where('shift_id',$p2);
				$status = $this->db->update('shifts', $update_data);		
				return ($status == true ? true : false);
			}else{//time format is pm to am (gone to the next day)
				
				//Add one day from today
				$tomorrow=strtotime("+1 days",strtotime($now_date));
				$str_tomorrow=date('m/d/Y',$tomorrow);
			
				$start=new DateTime($now_date. $from);
				$end=new DateTime($str_tomorrow. $to);
				$interval=$start->diff($end);
					
				//get hours difference between the two times
				$hours_difference=$interval->format('%h');
				//echo $output;
				
				//post data to be inserted to shifts table in db in form of array
				$update_data = array(
					'station_id' => $this->input->post('u_station'),
					'shift_name' => $this->input->post('u_shift'),
					'start_time' => $str_from,
					'end_time' => $str_to,
					'hours_worked'=>$hours_difference,
				);
				$this->db->where('shift_id',$p2);
				$status = $this->db->update('shifts', $update_data);		
				return ($status == true ? true : false);
				
			}//end else statement
			
			
		}
		if($p1=="validate"){
			$sql = "SELECT * FROM shifts WHERE shift_name = ? AND station_id = ?";
			$query = $this->db->query($sql, array($p2, $p3));
			$result = $query->row_array();
			if($query->num_rows() === 1){
					return true;
				}else{
					return false;
				}
		}
	}
	
	//schedules
	public function schedules($p1='',$p2="",$p3=""){
		if($p1=="add"){
			
			//split dutration dates
			$duration_start=substr($this->input->post('date_range'),0,10);
			$duration_end=substr($this->input->post('date_range'),13);
			
			//determine days assigned to the shift
			$start=new DateTime($duration_start);
			$end=new DateTime($duration_end);
			$interval=$start->diff($end);
					
			//get output of number of days
			$days_assigned=$interval->format('%d');
			
			$add_data = array(
				'employee_id' => $this->input->post('employee'),
				'shift_id' => $this->input->post('shift'),
				'station_id' => $this->input->post('station'),
				'days_assigned'=>$days_assigned,
				'duration_from' =>strtotime($duration_start),
				'duration_to'=>strtotime($duration_end),
				'date_scheduled'=>strtotime($this->input->post('date_scheduled')),
				's_count'=>1,
			);
			
			$login_id      =	$this->db->get_where('users' , array('id'=>$p2))->row()->login_id;
			$sql = "SELECT * FROM family WHERE login_id = ?";
			$query = $this->db->query($sql, array($login_id));
			$result = $query->row_array();
			
			if($query->num_rows() == 1){
				$e = $this->db->get_where('shifts' , array('shift_id' => $p3))->result_array();
				foreach ($e as $row) {
					$shift_name=$row['shift_name'];
				}
				if($shift_name=="MORNING" or $shift_name=="EVENING"){
					$status = $this->db->insert('schedules', $add_data);		
					return ($status == true ? true : false);
				}else{
					return false;
				}
			}
				else{
					$status = $this->db->insert('schedules', $add_data);		
					return ($status == true ? true : false);
				}
		}
		if($p1=="update"){
			return true;
		}
	}
	
	//family
	public function family($p1="",$p2=""){
		if($p1=="add"){
			$add_data = array(
				'marital_status' => $this->input->post('marital_status'),
				'spouse_name' => $this->input->post('spouse'),
				'spouse_phone' => $this->input->post('s_phone'),
				'kids' => $this->input->post('kids'),
				'login_id' =>$p2,
			);
				$status = $this->db->insert('family', $add_data);		
				return ($status == true ? true : false);
		}
		if($p1=="update"){
			$update_data = array(
				'marital_status' => $this->input->post('u_marital_status'),
				'spouse_name' => $this->input->post('spouse'),
				'spouse_phone' => $this->input->post('s_phone'),
				'kids' => $this->input->post('kids'),
			);
				$this->db->where('login_id',$p2);
				$status = $this->db->update('family', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	public function employee_schedule_status_update($p1=""){
			//fetch date and time of this day
			date_default_timezone_set('Africa/Nairobi');
			$str_date=strtotime(date("m/d/Y"));
			
			$where="duration_to>=".$str_date." AND employee_id=".$p1." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//$employee = $this->db->get_where('schedules' , array('station_id' => $p2))->result_array();
			//echo $count;
			if($count!="0"){
			//fetch date and time of this day
			$today_date=date('m/d/Y h:i a');
			
				
            $where="duration_to>=".$str_date." AND employee_id=".$p1." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			//$this->db->order_by('schedule_id','desc');
			//$this->db->join('users', 'users.id = schedules.employee_id');
			$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
			//$this->db->join('station', 'station.station_id = schedules.station_id');
			$desc	=	$this->db->get()->result_array();
			foreach($desc as $row){
				
											$shift_id=$row['shift_id'];
											$duration_to=$row['duration_to'];
											$shift_time_end=$row['end_time'];
					
					//get time when the shift ends
					//$shift_time_end=$this->db->get_where('shifts' , array('shift_id'=>$shift_id))->row()->end_time;
					
					//change end time from strtotime
					$converted_time=date("h:i a",$shift_time_end);
					
					//trim duration end date
					$dat_end_duration=date("m/d/Y",$duration_to);
					
					//get date difference
					$start=new DateTime($today_date);
					$end=new DateTime($dat_end_duration. $converted_time);
					$interval=$start->diff($end);
					
					//get output
					$output=$interval->format('%R');
					//echo $output;
					if($output=="+"){
						return false;
					}
					
				}
				//endforeach;
			}else{
				return true;
			}
	}
	
	public function get_shift_status($p1=""){
		
			//fetch date and time of this day
			date_default_timezone_set('Africa/Nairobi');
			$str_date=strtotime(date("m/d/Y"));
			
			$where="duration_to>=".$str_date." AND shift_id=".$p1." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//$employee = $this->db->get_where('schedules' , array('station_id' => $p2))->result_array();
			//echo $count;
			if($count=="1"){
			return false;
			}else{
				return true;
			}
	}
	
	public function option_crud($p1='',$p2=''){
		if($p1=="add"){
			$add_data= array(
				"option_code"=>$this->input->post('option_code'),
				"option_name"=>$this->input->post('option_name'),
			);
			
		$status=$this->db->insert('time_off_options',$add_data);
		return ($status == true ? true : false);
		}
		if($p1=="update"){
			$update_data= array(
				"option_code"=>$this->input->post('option_code'),
				"option_name"=>$this->input->post('option_name'),
			);
		
		$this->db->where('option_id',$p2);
		$status=$this->db->update('time_off_options',$update_data);
		return ($status == true ? true : false);
		}
	}
	
	//time off requests
	public function requests($p1='',$p2=''){
		if($p1=="add_time_off"){
			$employee_id=$this->input->post('employee_id');
			$option_id=$this->input->post('reason');
			$other_reason=$this->input->post('other_reason');
			$duration_start=substr($this->input->post('date_range'),0,10);
			$duration_end=substr($this->input->post('date_range'),13);
			$d_requested=strtotime($this->input->post('d_requested'));
			
			//convert dates to strtotime formats
			$d_start=strtotime($duration_start);
			$d_end=strtotime($duration_end);
			//time off data to be posted to db in form of array
				$add_data=array(
						"start_from"=>$d_start,
						"end_time"=>$d_end,
						"employee_id"=>$employee_id,
						"time_off_options_id"=>$option_id,
						"d_requested"=>	$d_requested,
						"reason"=>"null",
					);
				$add_other=array(
						"start_from"=>$d_start,
						"end_time"=>$d_end,
						"employee_id"=>$employee_id,
						"d_requested"=>	$d_requested,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
			//count all schedules where id=?
			$where="employee_id=".$employee_id." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			//if count == 1
			if($count=="1"){
				$where="employee_id=".$employee_id." AND schedule_status=0";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc1	=	$this->db->get()->result_array();
				foreach($desc1 as $row){
					
												//$fetch schedule
												$duration_to=$row['duration_to'];
						
						//get duration end date
						$schedule_end_duration=date("m/d/Y",$duration_to);
						
						//get date difference
						$start=new DateTime($duration_start);
						$end=new DateTime($schedule_end_duration);
						$interval=$start->diff($end);
						
						//get output
						$output=$interval->format('%R');
						//echo $output;
						if($output=="+"){
							return false;
						}else{
							if($option_id=="other"){
								$status = $this->db->insert('time_off',$add_other);
							return ($status == true ? true : false);
							}else{
								$status = $this->db->insert('time_off',$add_data);
							return ($status == true ? true : false);
							}
						}
				}
			
			}else{
				if($option_id=="other"){
					$status = $this->db->insert('time_off',$add_other);
				return ($status == true ? true : false);
				}else{
					$status = $this->db->insert('time_off',$add_data);
				return ($status == true ? true : false);
				}
			}
			
		}
		
		if($p1=="update_time_off"){
			$employee_id=$this->input->post('employee_id');
			$option_id=$this->input->post('reason');
			$other_reason=$this->input->post('other_reason');
			$duration_start=substr($this->input->post('date_range'),0,10);
			$duration_end=substr($this->input->post('date_range'),13);
			
			//covert date to strtotime format
			$d_start=strtotime($duration_start);
			$d_end=strtotime($duration_end);
			
				$add_data=array(
						"start_from"=>$d_start,
						"end_time"=>$d_end,
						"employee_id"=>$employee_id,
						"time_off_options_id"=>$option_id,
						"reason"=>"null",
					);
				$add_other=array(
						"start_from"=>$d_start,
						"end_time"=>$d_end,
						"employee_id"=>$employee_id,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
			
			$where="employee_id=".$employee_id." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			if($count=="1"){
				$where="employee_id=".$employee_id." AND schedule_status=0";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				//$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
				$desc1	=	$this->db->get()->result_array();
				foreach($desc1 as $row){
					
												//$fetch schedule
												$duration_to=$row['duration_to'];
						
						//get duration end date
						$schedule_end_duration=date("m/d/Y",$duration_to);
						
						//get date difference
						$start=new DateTime($duration_start);
						$end=new DateTime($schedule_end_duration);
						$interval=$start->diff($end);
						
						//get output
						$output=$interval->format('%R');
						//echo $output;
						if($output=="+"){
							return false;
						}else{
							if($option_id=="other"){
								$this->db->where('time_off_id',$p2);
								$status = $this->db->update('time_off',$add_other);
							return ($status == true ? true : false);
							}else{
								$this->db->where('time_off_id',$p2);
								$status = $this->db->update('time_off',$add_data);
							return ($status == true ? true : false);
							}
						}
				}
			
			}else{
				if($option_id=="other"){
					$this->db->where('time_off_id',$p2);
					$status = $this->db->update('time_off',$add_other);
				return ($status == true ? true : false);
				}else{
					$this->db->where('time_off_id',$p2);
					$status = $this->db->update('time_off',$add_data);
				}
			}
		}
		
		
		if($p1=="add_swap"){
			$schedule_id=$this->input->post('schedule_id');
			$employee_to=$this->input->post('employee');
			$employee_id=$this->input->post('employee_id');
			$option_id=$this->input->post('reason');
			$other_reason=$this->input->post('other_reason');
			$date_requested=strtotime($this->input->post('date_requested'));
			$start_date=  strtotime($this->input->post('start_date')); 
		
				$where="schedule_id=".$schedule_id."";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc	=	$this->db->get()->result_array();
				foreach($desc as $row):
				$duration_to=$row['duration_to'];
				endforeach;                                                                    
						
				$add_data=array(
						"schedule_id"=>$schedule_id,
						"employee_to"=>$employee_to,
						"employee_from"=>$employee_id,
						"date_requested"=>$date_requested,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>$option_id,
						"reason"=>"null",
					);
				$add_other=array(
						"schedule_id"=>$schedule_id,
						"employee_to"=>$employee_to,
						"employee_from"=>$employee_id,
						"date_requested"=>$date_requested,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
					
				if($option_id=="other"){
					$status = $this->db->insert('swap',$add_other);
					return ($status == true ? true : false);
				}else{
					$status = $this->db->insert('swap',$add_data);
				return ($status == true ? true : false);
				}
				
		}
		
		if($p1=="manager_add_swap"){
			//$schedule_id=$this->input->post('schedule_id');
			$employee_to=$this->input->post('employee');
			$employee_id=$this->input->post('employee_c');
			$option_id=$this->input->post('reason');
			$other_reason=$this->input->post('other_reason');
			$date_requested=strtotime($this->input->post('date_requested'));
			$start_date=  strtotime($this->input->post('start_date')); 
			
			
			
				$where="employee_id=".$employee_id." AND schedule_status='0'";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc	=	$this->db->get()->result_array();
				foreach($desc as $row):
				$schedule_id=$row['schedule_id'];
				$duration_to=$row['duration_to'];
				endforeach; 
				
				$A=date("m/d/Y",$duration_to);
				$B=date("m/d/Y",$start_date);
				
				$start=new DateTime($A);
				$end=new DateTime($B);
				$interval=$start->diff($end);
				$output=$interval->format('%R');
				
				if($output=="-"){                                                                   
						
				$add_data=array(
						"schedule_id"=>$schedule_id,
						"employee_to"=>$employee_to,
						"employee_from"=>$employee_id,
						"date_requested"=>$date_requested,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>$option_id,
						"reason"=>"null",
					);
				$add_other=array(
						"schedule_id"=>$schedule_id,
						"employee_to"=>$employee_to,
						"employee_from"=>$employee_id,
						"date_requested"=>$date_requested,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
					
				if($option_id=="other"){
					$status = $this->db->insert('swap',$add_other);
					return ($status == true ? true : false);
				}else{
					$status = $this->db->insert('swap',$add_data);
				return ($status == true ? true : false);
				}
				
				}else{
					return false;
				}
				
		}
		
		//approve swap
		if($p1=="swap_approve"){
			$swap_id = $this->db->get_where('swap' , array('swap_id' => $p2))->result_array();
				foreach ($swap_id as $row) {
					$schedule_id=$row['schedule_id'];
					$employee_from=$row['employee_from'];
					$employee_to=$row['employee_to'];
					$s_start_date=$row['s_start_date'];
					$s_end_date=$row['s_end_date'];
					$schedule_id=$row['schedule_id'];
					$s_status=$row['s_status'];
					$shift_id=$this->db->get_where('schedules' , array('schedule_id'=>$schedule_id))->row()->shift_id;
					$station_id=$this->db->get_where('schedules' , array('schedule_id'=>$schedule_id))->row()->station_id;
					
					//convert db date back to string
					$t1=date('m/d/Y',$s_start_date);
					$t2=date('m/d/Y',$s_end_date);
					
					//determine days assigned to the swapped shift
					$start=new DateTime($t1);
					$end=new DateTime($t2);
					$interval=$start->diff($end);
							
					//get output of number of days
					$days_assigned=$interval->format('%d');
					
					//define date when swap was scheduled:: today
					$date_scheduled=date('m/d/Y'); 
					
					//add new schedule data
					$add_new_shift_data=array(
							"employee_id"=>$employee_to,
							"shift_id"=>$shift_id,
							"station_id"=>$station_id,
							"duration_from"=>$s_start_date,
							"duration_to"=>$s_end_date,
							"days_assigned"=>$days_assigned,
							"date_scheduled"=>strtotime($date_scheduled),
							"swap_status"=>2,
							"s_count"=>1,
						);
						
					$str_date=date("m/d/Y",$s_start_date);	
					$previous_day=strtotime("-1 days",strtotime($str_date));
					
					$pd=date('m/d/Y',$previous_day);
					
					//determine days assigned to the swapped shift
					$start=new DateTime($pd);
					$end=new DateTime($t2);
					$interval=$start->diff($end);
							
					//get output of number of days
					$days_assigned_2=$interval->format('%d');
					
   						//schedules table update data
					$update_current_schedules=array(
							"duration_to"=>$previous_day,
							"days_assigned"=>$days_assigned_2,
							"swap_status"=>1,
							"s_count"=>1,
						);
						
						
					//get date of today
					$date_approved=date('m/d/Y');
					
					//swap table update data
					$update_swaps=array(
							"date_requested"=>strtotime($date_approved),
							"s_status"=>1,
					 	);
						
					//insert a schedule to schedules table
					$new_shedule_insert=$this->db->insert('schedules',$add_new_shift_data);
					
					//update schedules table for the employee swapped from
					$this->db->where('schedule_id',$schedule_id);
					$update_schedule=$this->db->update('schedules',$update_current_schedules);
					
					//update swap by setting flag of approval
					$this->db->where('swap_id',$p2);
					$update_current_swap=$this->db->update('swap',$update_swaps);
					
					//if posting is true
					if($new_shedule_insert && $update_schedule && $update_current_swap){
						return true;
					}else{
						return false;
					}
					
				}
		}
		
		if($p1=="update_swap"){
			$schedule_id=$this->input->post('schedule_id');
			$employee_to=$this->input->post('employee');
			//$employee_id=$this->input->post('employee_id');
			$option_id=$this->input->post('reason');
			$other_reason=$this->input->post('other_reason');
			//$date_requested=$this->input->post('date_requested');
			$start_date=  strtotime($this->input->post('start_date')); 
		
				$where="schedule_id=".$schedule_id."";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc	=	$this->db->get()->result_array();
				foreach($desc as $row):
				$duration_to=$row['duration_to'];
				endforeach;                                                                    
						
				$add_data=array(
						"employee_to"=>$employee_to,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>$option_id,
						"reason"=>"null",
					);
				$add_other=array(
						"employee_to"=>$employee_to,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
					
				if($option_id=="other"){
					$this->db->where('swap_id',$p2);
					$status = $this->db->update('swap',$add_other);
					return ($status == true ? true : false);
				}else{
					$this->db->where('swap_id',$p2);
					$status = $this->db->update('swap',$add_data);
					return ($status == true ? true : false);
				}
		}
		
		if($p1=="m_update_swap"){
			$schedule_id=$this->input->post('schedule_id');
			$employee_to=$this->input->post('u_employee');
			//$employee_id=$this->input->post('employee_id');
			$option_id=$this->input->post('u_reason');
			$other_reason=$this->input->post('other_reason');
			//$date_requested=$this->input->post('date_requested');
			$start_date=  strtotime($this->input->post('u_start_date')); 
		
				$where="schedule_id=".$schedule_id."";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc	=	$this->db->get()->result_array();
				foreach($desc as $row):
				$duration_to=$row['duration_to'];
				endforeach;                                                                    
						
				$add_data=array(
						"employee_to"=>$employee_to,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>$option_id,
						"reason"=>"null",
					);
				$add_other=array(
						"employee_to"=>$employee_to,
						"s_start_date"=>$start_date,
						"s_end_date"=>$duration_to,
						"time_off_options_id"=>"0",
						"reason"=>$other_reason,
					);
					
				if($option_id=="other"){
					$this->db->where('swap_id',$p2);
					$status = $this->db->update('swap',$add_other);
					return ($status == true ? true : false);
				}else{
					$this->db->where('swap_id',$p2);
					$status = $this->db->update('swap',$add_data);
					return ($status == true ? true : false);
				}
		}
		
	}//end requests
	
	//validate start date
	public function validate_start_date($p1='',$p2=''){
		
				$where="schedule_id=".$p1."";
				$this->db->select('*');
				$this->db->from('schedules');
				$this->db->where($where);
				$desc	=	$this->db->get()->result_array();
				foreach($desc as $row):
				$duration_to=$row['duration_to'];
				endforeach;
				
				$db_date=date('m/d/Y',$duration_to);
				
				//gate date difference
				$start=new DateTime($db_date);
				$end=new DateTime($p2);
				$interval=$start->diff($end);
				$output=$interval->format('%R');
				
				if($output=="-"){
					return true;
				}else{
					return false;
				}
		
	}
	
	public function recheck_swap_status($p1){
		
			$where="employee_to=".$p1." AND s_status=0";
			$this->db->select('*');
			$this->db->from('swap');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="1"){
				return false;
			}else{
				return true;
			}
	}
	
	public function check_current_employee_swap_status($p1=''){
		//fetch date and time of this day
			//date_default_timezone_set('Africa/Nairobi');
			//$str_date=strtotime(date("m/d/Y"));
			
			$where="employee_from=".$p1." AND s_status=0";
			$this->db->select('*');
			$this->db->from('swap');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//$employee = $this->db->get_where('schedules' , array('station_id' => $p2))->result_array();
			//echo $count;
			if($count=="1"){
				return false;
			}else{
				return true;
			}
	}
	
public function employee_time_off_status($p1=''){
		//fetch date and time of this day
			//date_default_timezone_set('Africa/Nairobi');
			//$str_date=strtotime(date("m/d/Y"));
			
			$where="employee_id=".$p1." AND time_off_status=0";
			$this->db->select('*');
			$this->db->from('time_off');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//$employee = $this->db->get_where('schedules' , array('station_id' => $p2))->result_array();
			//echo $count;
			if($count=="1"){
				return false;
			}else{
				return true;
			}
	}
	//validate time off
	public function _validate_timeoff($p1='',$p2=''){
			$duration_end=substr($p1,13);
			
				$where="employee_id=".$p2." AND time_off_status='0'";
				$this->db->select('*');
				$this->db->from('time_off');
				$this->db->where($where);
				//$desc	=	$this->db->get()->result_array();
				$count=$this->db->count_all_results();
				
				if($count=='1'){
					$where="employee_id=".$p2." AND time_off_status=0";
					$this->db->select('*');
					$this->db->from('time_off');
					$this->db->where($where);
					$desc	=	$this->db->get()->result_array();
					foreach($desc as $row):
					$duration_to=$row['end_time'];
					$str_duration_to=date('m/d/Y',$duration_to);
					//get date difference
						$start=new DateTime($duration_end);
						$end=new DateTime($str_duration_to);
						$interval=$start->diff($end);
						
						//get output
						$output=$interval->format('%R');
						
						if($output=="+"){
							return false;
						}else{
							return true;
						}
					
					endforeach;
				}else{
					return true;
				}
	}
	
	
	//validate
	public function _validate_selected_date($p1=''){
		$posted_date=substr($p1,0,10);
		$today_date=date('m/d/Y');
		
			//get date difference
			$start=new DateTime($posted_date);
			$end=new DateTime($today_date);
			$interval=$start->diff($end);
						
			//get output
			$output=$interval->format('%R');
			$days_output=$interval->format('%d');
			
				if($output=="+" && $days_output>0){
					return false;
				}else{
					return true;
				}
		
	}
	
 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
		if($type=='user'){
		//check whether file exists
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else//if not, replace with a temporary message
            $image_url = base_url() . 'uploads/temp.jpg';

        return $image_url;
		}
		
		//checking logo image
		if($type=='logo'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/temp_logo.png';

        return $image_url;
		}
    }
	
	/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
	
	function create_backup($param2)

	{

		$this->load->dbutil();
		

		$options = array(

                'format'      => 'txt',             // gzip, zip, txt

                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file

                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file

                'newline'     => "\n"               // Newline character used in backup file

              );

		

		 

		if($param2 == 'all')

		{

			$tables = array('');

			$file_name	=	'system_backup';

		}

		else 

		{

			$tables = array('tables'	=>	array($param2));

			$file_name	=	'backup_'.$param2;

		}

		$backup =& $this->dbutil->backup(array_merge($options , $tables)); 


		//$this->load->helper('download');

		force_download($file_name.'.sql', $backup);

	}
	
	/*
	*-----------------------------------------
	* fetch station data
	*----------------------------------------
	*/
	public function fetchStationData($stationId = null)
	{
		if($stationId) {
			$sql = "SELECT * FROM station WHERE station_id = ?";
			$query = $this->db->query($sql, array($stationId));
			return $query->row_array();
		} 
		else {
			$sql = "SELECT * FROM station";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}
	
	
	//end
}