<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function login($username = null, $password = null) 
	{
		if($username && $password) {
			
			$q=$this->db->get_where('login', array('username' => $username))->result_array();
				foreach($q as $row):
					$fetched_pass=$row['password'];
				endforeach;
			
			if(password_verify($password,$fetched_pass)){
				$sql = "SELECT * FROM login WHERE username = ?";
				$query = $this->db->query($sql, array($username));
				$result = $query->row_array();

			return ($query->num_rows() === 1 ? $result['id'] : false);
			}
			else {
				return false;
			}
		}
	}
	
	public function validate_username($username = null)
	{
		if($username) {			
			// die($username);
			$sql = "SELECT * FROM login WHERE username = ?";
			$query = $this->db->query($sql, array($username));
			$result = $query->row_array();
			
			return ($query->num_rows() === 1 ? true : false);			
		}	
		else {
			return false;
		}
	} // /validate username function
	
	public function register_post(){
			$password=password_hash($this->input->post('r_password'),PASSWORD_DEFAULT);
			$data_login=array(
				'username' => $this->input->post('r_username'),
				'password' => $password,
				'role' => 'user',
			);
			$this->db->insert('login', $data_login);
			$userId = $this->db->insert_id();	
			
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
	
	public function update_schedules(){
		
			//fetch date and time of this day
			//date_default_timezone_set('Africa/Nairobi');
			$str_date=strtotime(date("m/d/Y"));
			
			$where="duration_to<=".$str_date."";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//$employee = $this->db->get_where('schedules' , array('station_id' => $p2))->result_array();
			//echo $count;
			if($count!="0"){
			//fetch date and time of this day
			$today_date=date('m/d/Y h:i a');
			
				
            $where="duration_to<=".$str_date."";
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
						return true;
					}else{
						
						$update_array=array(
							'schedule_status'=>'1',
						);
						
						$update=array(
							'schedule_status'=>'1',
						);
						
						$pleasedwhere="duration_to<=".$str_date."";
						$this->db->where($pleasedwhere);
						$this->db->update('schedules',$update);
						return true;
						//else
					}
					
				}
				//endforeach;
			}else{
				return true;
			}
		
	}

//closing model	
}