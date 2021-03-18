<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Crud_model','crud');
		
		$this->check_session();//check session
		$this->runtime_schedules();//update schedules up to date
		$this->runtime_time_off();//update time off up to date
		$this->runtime_swaps();//update swaps up to date
		
		
	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE)
            redirect(base_url(), 'refresh');
	}
	
	//function for keeping running schedules up to date by updating wherever necessary
	function runtime_schedules(){
		
			//today date
			$str_date=strtotime(date("m/d/Y"));
			
			//count all from schedules where schedule date end is less than today date
			$where="duration_to<=".$str_date."";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			//if result of count is not equal tozero
			if($count!="0"){
			//fetch date and time of this day
			$today_date=date('m/d/Y h:i a');
			
			//select from schedules where date less than today date	
            $where="duration_to<=".$str_date."";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			//join the shifts table and get results according to query
			$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
			$desc	=	$this->db->get()->result_array();
			foreach($desc as $row){
				
											$shift_id=$row['shift_id'];
											$duration_to=$row['duration_to'];
											$shift_time_end=$row['end_time'];
					
					
					//change end time from strtotime
					$converted_time=date("h:i a",$shift_time_end);
					
					//convert from strtotime format
					$dat_end_duration=date("m/d/Y",$duration_to);
					
					//get date difference
					$start=new DateTime($today_date);
					$end=new DateTime($dat_end_duration. $converted_time);
					$interval=$start->diff($end);
					
					//get output (+ or -)
					$output=$interval->format('%R');
					//echo $output;
					if($output=="+"){
						return true;
					}else{
						
						
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
	
	//function for checking time off and make it to be up to date by updating wherever necessary
	function runtime_time_off(){
		
			//today date
			$today_date=date("m/d/Y");
			$str_today_date=strtotime($today_date);
			
			//count all from time_off where schedule date end is less than today date
			$where="end_time<=".$str_today_date."";
			$this->db->select('*');
			$this->db->from('time_off');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			 if($count!="0"){
				 $where="end_time<=".$str_today_date."";
				 $this->db->select('*');
				 $this->db->from('time_off');
				 $this->db->where($where);
				 $desc	=	$this->db->get()->result_array();
					 foreach($desc as $row):
					 //$id=$row['shift_id'];
					 $end_time=$row['end_time'];
					 
					 $fetched_date=date('m/d/Y',$end_time);
					 
					 $start=new DateTime($today_date);
					 $end=new DateTime($fetched_date);
					 $interval=$start->diff($end);
								
					 //get output +or -
					 $output=$interval->format('%R');
					 //$days_output=$interval->format('%d');
					//echo $output;
					if($output=="+"){
						return true;
					}else{
						$update=array(
							'time_off_status'=>'1',
							'request_status'=>1,
						);
						
						$runtimewhere="end_time<=".$str_today_date."";
						$this->db->where($runtimewhere);
						$this->db->update('time_off',$update);
						return true;
					}
					
					 endforeach;
			 }//end of count results no equal to 1
			 else{
				 return true;//do nothing 
			 }
	}
	
	//function of runtime running swaps
	function runtime_swaps(){
		
			//today date
			$today_date=date("m/d/Y");
			$str_today_date=strtotime($today_date);
			
			//count all from time_off where schedule date end is less than today date
			$where="s_end_date<=".$str_today_date."";
			$this->db->select('*');
			$this->db->from('swap');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			
			 if($count!="0"){
				 $where="s_end_date<=".$str_today_date."";
				 $this->db->select('*');
				 $this->db->from('swap');
				 $this->db->where($where);
				 $desc	=	$this->db->get()->result_array();
					 foreach($desc as $row):
					 //fetch s_end_date row in swap table
					 $end_time=$row['s_end_date'];
					 
					 $fetched_date=date('m/d/Y',$end_time);
					 
					 $start=new DateTime($today_date);
					 $end=new DateTime($fetched_date);
					 $interval=$start->diff($end);
								
					 //get output +or -
					 $output=$interval->format('%R');
					 //$days_output=$interval->format('%d');
					//echo $output;
					if($output=="+"){
						return true;
					}else{
						$update=array(
							's_status'=>'4',
						);
						
						$runtimewhere="s_end_date<=".$str_today_date."";
						$this->db->where($runtimewhere);
						$this->db->update('swap',$update);
						return true;
					}
					
					 endforeach;
			 }//end of count results no equal to 1
			 else{
				 return true;//do nothing 
			 }
	}//end runtime swaps
	
	//load index
	public function index()
	{
		$this->dashboard();//call dashboard function
	}
	
	//load dashboard page
	public function dashboard(){
        $page_data['page_name']  = 'dashboard';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'dashboard';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
	//load stations page
	public function stations(){
		
        $page_data['page_name']  = 'stations';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'stations';
        $this->load->view('index', $page_data);
	}
	
	public function reports(){
		
        $page_data['page_name']  = 'reports';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'reports';
        $this->load->view('index', $page_data);
	}
	
	
	
	
	/*
	*------------------------------------
	* retrieve class name 
	*------------------------------------
	*/
	public function fetchStationData($stationId = null)
	{
		if($stationId) {
			$stationData = $this->model_classes->fetchStationData($stationId);
			echo json_encode($stationData);
		}
		else {
			$stationData = $this->model_classes->fetchClassData();
			$result = array('data' => array());

			$x = 1;
			foreach ($stationData as $key => $value) {

				$button = '<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Action <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a type="button" data-toggle="modal" data-target="#editClassModal" onclick="editClass('.$value['class_id'].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
				    <li><a type="button" data-toggle="modal" data-target="#removeClassModal" onclick="removeClass('.$value['class_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>		    
				  </ul>
				</div>';

				$result['data'][$key] = array(
					$x,
					$value['class_name'],
					$value['numeric_name'],
					$button
				);
				$x++;
			} // /froeach

			echo json_encode($result);
		} // /else		
	}
	
	//station crud functions (edit/ pdate/delete)
	public function stations_crud($p1="",$p2=""){
		//if edit
		if($p1=='edit'){
			$data['station_id']=$this->db->get_where('station', array('station_id' => $p2));
			$this->load->view('backend/manager/modal_edit_station.php',$data);
		}
		if($p1=="add_shift"){
			$data['station_id']=$this->db->get_where('station', array('station_id' => $p2));
			$this->load->view('backend/manager/modal_add_shift.php',$data);
		}
		//if update
		if($p1=='update'){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 's',
				'label' => 'Station Name',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->station_update($p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Station Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting the data!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}
		
		//view station
		if($p1=="view_station"){
			
				
			//encrypt and decrypt url
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['station_id']=$this->db->get_where('station', array('station_id'=>$encrypt));
        	$page_data['page_name']  = 'view_station';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Stations';
			$page_data['function']  = 'stations';
			//$page_data['page_name_phrase']  = get_phrase('view_stock');
        	$page_data['page_title'] = 'View Station';
        	$this->load->view('index', $page_data);
			
		}
		//if delete
		if($p1=='delete'){
			$this->db->where('station_id',$p2);
			$this->db->delete('station');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Station Deleted Successfully!');
			redirect ('manager/stations','refresh');
		}
	}
	
	//load shifts page
	public function manage(){
		
        $page_data['page_name']  = 'manage_shifts';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'manage Shifts';;
        $this->load->view('index', $page_data);
	}
	
	//load schedules page
	public function schedule(){
		
        $page_data['page_name']  = 'manage_schedules';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'manage Schedules';;
        $this->load->view('index', $page_data);
	}
	
	//load employees page
	public function Employees(){
		
        $page_data['page_name']  = 'employees';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'employees';//Title of the page;
        $this->load->view('index', $page_data);//load index page in views
	}
	//load setting page
	public function Settings(){
		
        $page_data['page_name']  = 'settings';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'settings';
        $this->load->view('index', $page_data);
	}
	
	//load schedule swap page
	public function schedule_swap(){
		
        $page_data['page_name']  = 'schedule_swap';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'Schedule Swaps';
        $this->load->view('index', $page_data);
	}
	
	// validate form inputs in the settings page
	public function validate_setting(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'sname',
				'label' => 'System Name',
				'rules' => 'required'
			),
			array(
				'field' => 'abr',
				'label' => 'System Abbreviation',
				'rules' => 'required'
			),
			array(
				'field' => 'address',
				'label' => 'System Address',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'valid_email' => 'Please input a valid %s address',
				)
			),
			array(
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {//form inputs have passed all the validation test

			$posting = $this->crud->settings_post();//post data to model with function setting_post

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Settings Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	
	//load profile profile page
	public function profile(){
		
        $page_data['page_name']  = 'profile';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'profile';;
        $this->load->view('index', $page_data);
	}
	
	//validate profile form
	public function validate_profile(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			),
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			),
			array(
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->profile_post($userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Profile Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//validate passwords
	public function validate_password(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'oldpass',
				'label' => 'Old Password',
				'rules' => 'required|callback_validate_pass'
			),
			array(
				'field' => 'newpass',
				'label' => 'New Password',
				'rules' => 'required'
			),
			array(
				'field' => 'confpass',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[newpass]'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->password_post($userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Password Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting the data!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//compare db password with user inputted password and return either true/false
	public function validate_pass()
	{
		$validate = $this->crud->password_validate($this->input->post('oldpass'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_pass', 'This Old Password is incorrect!');
			return false;			
		} // /else
	} // /validate password function
	
	//update profile image
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Picture Updated Successfully!');
			redirect ('manager/profile','refresh');
	}
	
	public function validate_station(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'station',
				'label' => 'Station Name',
				'rules' => 'required|is_unique[station.station_name]',
				'errors' => array(
					'is_unique' => 'This station already exists!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->station_add();

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Station Added Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//validate user registration form inputs
	public function validate_register(){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|is_unique[login.username]',
				'errors' => array(
					'is_unique' => 'This %s is already taken!',
					)
			),
			array(
				'field' => 'fullnames',
				'label' => 'Full names',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => array(
					'valid_email' => 'Please input a valid %s address!',
					'is_unique' => 'This %s already exists!',
					)
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'required'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required|numeric'
			),
			array(
				'field' => 'idno',
				'label' => 'ID Number',
				'rules' => 'required|numeric'
			),
			array(
				'field' => 'cpassword',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[password]'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->employee_post();

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Employee Added successfully!";
			
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "<i class='ti-info-alt'></i> Data was not posted!";
			} // /else

		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	} // /validate function
	
	//employee crud functions(edit/ update/ delete)
	public function employees_crud($p1="",$p2=""){
		//if edit
		if($p1=='edit'){
			$data['id']=$this->db->get_where('users', array('id' => $p2));
			$this->load->view('backend/manager/modal_edit_employee.php',$data);
		}
		//if update
		if($p1=='update'){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_fullnames',
				'label' => 'Full names',
				'rules' => 'required'
			),
			array(
				'field' => 'u_address',
				'label' => 'Address',
				'rules' => 'required'
			),
			array(
				'field' => 'u_phone',
				'label' => 'Phone Number',
				'rules' => 'required|numeric|min_length[10]'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->employee_update($p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Employee Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting the data!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}
		
		//image update
		if($p1=='update_image'){
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $p2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Picture Updated Successfully!');
			redirect ('manager/employees','refresh');
		}
		
		//if delete
		if($p1=='delete'){
			$this->db->where('login_id', $p2);
            $this->db->delete('users');
			$this->db->where('id', $p2);
            $this->db->delete('login');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Employee Deleted Successfully!');
			redirect ('manager/employees','refresh');
		}
	}
	
	public function update_logo(){
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo_image/logo.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Logo Updated Successfully!');
			redirect ('manager/settings','refresh');
	}
	
	//Back up/restore data
	public function data_manager($p1="",$p2=""){
		if ($p1 == 'create') {
			$this->crud->create_backup($p2);
		}
	}
	
	//manage shifts functions
	public function shifts($p1='',$p2=''){
		//add shift
		if($p1=="add"){
			//validate shift add data
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'station',
					'label' => 'Station',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You have not selected any station!',
					)
				),
				array(
					'field' => 'shift',
					'label' => 'Shift Name',
					'rules' => 'required|callback__validate_shift',
				),
				array(
					'field' => 'from',
					'label' => 'From',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Select time when the shift starts!',
					)
				),
				array(
					'field' => 'to',
					'label' => 'To',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Select time when the shift ends!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->crud->shifts('add_shift');//post to crud model
	
				if($posting === true) {//if added to db, return true with a message
					$validator['success'] = true;
					$validator['messages'] = "Shift Added Successfully!";
				}	
				else {//not added + display error message
					$validator['success'] = false;
					$validator['messages'] = "There was an error while posting your data.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		if($p1=="edit"){
			$data['id']=$this->db->get_where('shifts', array('shift_id' => $p2));
			$this->load->view('backend/manager/modal_edit_shift.php',$data);
		}
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'u_station',
					'label' => 'Station',
					'rules' => 'required',
					'errors' => array(
						'required' => 'You have not selected any station!',
					)
				),
				array(
					'field' => 'u_shift',
					'label' => 'Shift Name',
					'rules' => 'required',
				),
				array(
					'field' => 'u_from',
					'label' => 'From',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Select time when the shift starts!',
					)
				),
				array(
					'field' => 'u_to',
					'label' => 'To',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Select time when the shift ends!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->crud->shifts('update_shift',$p2);
	
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Shift Updated Successfully!";
				}	
				else {
					$validator['success'] = false;
					$validator['messages'] = "There was an error while posting your data.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		if($p1=="delete"){
			$this->db->where('shift_id', $p2);
            $this->db->delete('shifts');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Shift Deleted Successfully!');
			redirect ('manager/manage','refresh');
		}
	}
	
	//validate shif function
	public function _validate_shift($p1="",$p2=""){
		$p1=$this->input->post('shift');
		$p2=$this->input->post('station');
		$validate = $this->crud->shifts('validate',$p1,$p2);

		if($validate === true) {
			$this->form_validation->set_message('_validate_shift', 'This %s already exists!');
			return false;
		} 
		else {
			return true;			
		} // /else
	}
	
	//time off crud functions
	public function time_crud($p1='',$p2=""){
		if($p1=="add"){
			$this->load->view('backend/manager/modal_addtime_off.php');
		}
		if($p1=="add_time_off"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'employee_id',
				'label' => 'Employee',
				'rules' => 'required|callback_employee_time_off_status'
			),
			array(
				'field' => 'reason',
				'label' => 'Reason',
				'rules' => 'required'
			),
			array(
				'field' => 'date_range',
				'label' => 'Date Range',
				'rules' => 'required|callback__validate_selected_date'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->requests("add_time_off");

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Time Off Added Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "You already have a scheduled shift on this period!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}
	}
	
	//schedules functions
	public function schedules_crud($p1='',$p2=''){
		if($p1=="get_shift"){
			$where="station_id=".$p2."";
			$this->db->select('*');
			$this->db->from('shifts');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '<option value="">No Shifts Available in this Station!</option>';
			}else{
				$shift = $this->db->get_where('shifts' , array('station_id' => $p2))->result_array();
				foreach ($shift as $row) {
				echo '<option value="' .$row['shift_id'] . '">' .$row['shift_name'] .'&nbsp;(' . date("h:i a",$row['start_time']) .'&nbsp-&nbsp;' . date("h:i a",$row['end_time']) .')</option>';
				}
			}
		}
		
		if($p1=="add"){
	
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'employee',
					'label' => 'Employee',
					'rules' => 'trim|required|callback_employee_schedule_status',
					'errors' => array(
						'required' => 'Select Employee!',
					)
				),
				array(
					'field' => 'station',
					'label' => 'Station',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'shift',
					'label' => 'Shift',
					'rules' => 'trim|required|callback_get_shift_status',
					'errors' => array(
						'required' => 'Select Shift to be assigned to employee!',
					)
				),
				array(
					'field' => 'date_range',
					'label' => 'Duration',
					'rules' => 'trim|required|callback__validate_selected_date|callback__validate_timeoff',
					'errors' => array(
						'required' => 'Select Shift Duration!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
				$employee_id=$this->input->post('employee');
				$shift_id=$this->input->post('shift');
	
				$posting = $this->crud->schedules('add',$employee_id,$shift_id);
				
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Employee Schedule Added Successfully!";
				}	
				else {
					$validator['success'] = false;
					$validator['messages'] = "The employee selected has a family and therefore cannot work on a <b>NIGHT</b> shift!.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		//if edit
		if($p1=='edit'){
			$data['schedule_id']=$this->db->get_where('schedules', array('schedule_id' => $p2));
			$this->load->view('backend/manager/modal_edit_schedule.php',$data);
		}
		
		//update
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'u_employee',
					'label' => 'Employee',
					'rules' => 'trim|required|callback_employee_schedule_status',
					'errors' => array(
						'required' => 'Select Employee!',
					)
				),
				array(
					'field' => 'u_station',
					'label' => 'Station',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'u_shift',
					'label' => 'Shift',
					'rules' => 'trim|required|callback_get_shift_status',
					'errors' => array(
						'required' => 'Select Shift to be assigned to employee!',
					)
				),
				array(
					'field' => 'u_date_range',
					'label' => 'Duration',
					'rules' => 'trim|required|callback__validate_selected_date|callback__validate_timeoff',
					'errors' => array(
						'required' => 'Select Shift Duration!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
				$employee_id=$this->input->post('u_employee');
				$shift_id=$this->input->post('u_shift');
	
				$posting = $this->crud->schedules('update',$employee_id,$shift_id);
				
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Employee Schedule Added Successfully!";
				}	
				else {
					$validator['success'] = false;
					$validator['messages'] = "The employee selected has a family and therefore cannot work on a <b>NIGHT</b> shift!.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		
		//delete schedule
		if($p1=="delete"){
			$this->db->where('schedule_id',$p2);
			$this->db->delete('schedules');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Schedule Deleted Successfully!');
			redirect ('manager/schedule','refresh');
		}
		
	}
	
	public function employee_schedule_status($p1=''){
		$validate = $this->crud->employee_schedule_status_update($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('employee_schedule_status', 'This User Already has an active Shift!');
			return false;			
		} // /else
	}
	
	//check station status
	public function get_shift_status($p1){
		$validate = $this->crud->get_shift_status($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('get_shift_status', 'This shift has already been assigned!');
			return false;			
		} // /else
	}	
	
	//load time_off page
	public function time_off(){
		
        $page_data['page_name']  = 'time_off';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'Time Off';;
        $this->load->view('index', $page_data);
	}
	
	//time_off crud
	public function option_crud($p1='', $p2=''){
		if($p1=="add"){
			$this->load->view('backend/manager/modal_edit_time_options.php');
		}
		if($p1=="edit"){
			$data['option_id']=$this->db->get_where('time_off_options', array('option_id' => $p2));
			$this->load->view('backend/manager/modal_update_time_options.php',$data);
		}
		if($p1=="add_option"){
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'option_code',
					'label' => 'Option Code',
					'rules' => 'trim|required|is_unique[time_off_options.option_code]',
					'errors' => array(
						'required' => 'Add %s!',
						'is_unique' => 'This %s already exists!',
					),
				),
				array(
					'field' => 'option_name',
					'label' => 'Option Name',
					'rules' => 'trim|required|is_unique[time_off_options.option_name]',
					'errors' => array(
						'required' => 'Add %s!',
						'is_unique' => 'This %s already exists!',
					),
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->crud->option_crud('add');
				
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Option Added Successfully!";
				}	
				else {
					$validator['success'] = false;
					$validator['messages'] = "There was an aerror while posting the data!.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		//update option input
		if($p1=="update_option"){
			$validator = array('success' => false, 'messages' => array());
	
			$validate_data = array(
				array(
					'field' => 'option_code',
					'label' => 'Option Code',
					'rules' => 'trim|required',
					'errors' => array(
						'required' => 'Add %s!',
					),
				),
				array(
					'field' => 'option_name',
					'label' => 'Option Name',
					'rules' => 'trim|required',
					'errors' => array(
						'required' => 'Add %s!',
					),
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->crud->option_crud('update',$p2);
				
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Option Updated Successfully!";
				}	
				else {
					$validator['success'] = false;
					$validator['messages'] = "There was an aerror while posting the data!.";
				} 
			}
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);			
				} // /else
			}
			echo json_encode($validator);
		}
		if($p1=="delete"){
			$this->db->where('option_id',$p2);
			$this->db->delete('time_off_options');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Option Deleted Successfully!');
			redirect ('manager/time_off','refresh');
		}
	}
	
	//function requests (approve or deny)
	public function requests($p1='',$p2=''){
		
		if($p1=="get_option"){
			if($p2=="other"){
				echo '<div class="form-group">
						<label>Add Other Reason:</label>
						 <textarea class="form-control" name="other_reason" required="required" id="other_reason" placeholder="Input the reason..."></textarea>
					</div>';
			}
		}
		if($p1=="get_duration"){
			//select from schedules where date less than today date	
            $where="employee_id=".$p2." AND schedule_status=0";
			$this->db->select('*');
			$this->db->from('schedules');
			$this->db->where($where);
			$this->db->join('users', 'users.id = schedules.employee_id');
			$desc	=	$this->db->get()->result_array();
			foreach($desc as $row){
				$employee_names=$row['fullnames'];
				$date_from=$row['duration_from'];
				$date_to=$row['duration_to'];
				
				echo'<div class="alert alert-info">
                     	<strong>'.$employee_names.'</strong> has a scheduled shift from <strong>'.date("m/d/Y",$date_from).'</strong> to <strong>'.date("m/d/Y",$date_to).'</strong>.
                     </div>';
			
			}
					
		}
		
		if($p1=="approve"){
			
			
			$update_data=array(
					"request_status"=>'2',
				);			
			$this->db->where('time_off_id',$p2);
			$this->db->update('time_off',$update_data);			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Time Off Approved Successfully!');
			redirect ('manager/time_off','refresh');
		}
		if($p1=="swap_approve"){
			
				$posting=$this->crud->requests('swap_approve',$p2);
				if($posting===true){			 
					$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Schedule Swap Approved Successfully!');
					redirect ('manager/schedule_swap','refresh');
				}
		}
		
		//view time off
		if($p1=="view_time_off"){
		
			
			//encrypt and decrypt url
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['time_off_id']=$this->db->get_where('time_off', array('time_off_id'=>$encrypt));
        	$page_data['page_name']  = 'view_time_off';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Time Off';
			$page_data['function']  = 'time_off';
			//$page_data['page_name_phrase']  = get_phrase('view_stock');
        	$page_data['page_title'] = 'View Time Off';
        	$this->load->view('index', $page_data);
			
		}
		
		if($p1=="view_swap"){
			
			
			//encrypt and decrypt url
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['swap_id']=$this->db->get_where('swap', array('swap_id'=>$encrypt));
        	$page_data['page_name']  = 'view_swaps';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Schedule Swap';
			$page_data['function']  = 'schedule_swap';
			//$page_data['page_name_phrase']  = get_phrase('view_stock');
        	$page_data['page_title'] = 'View Swaps';
        	$this->load->view('index', $page_data);
		}
		
		//decline swap
		if($p1=="swap_decline"){
			//get date of today
			$date_declined=date('m/d/Y');
						
				$decline_array=array(
					"date_requested"=>strtotime($date_declined),
					"s_status"=>3,
				);
				//flag the s_status field in swap table to 3(flag for decline)
				$this->db->where("swap_id",$p2);
				$this->db->update("swap",$decline_array);
							 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Schedule Swap Declined Successfully!');
			redirect ('manager/schedule_swap','refresh');
		}
		
		if($p1=="decline"){
			$update_data=array(
					"request_status"=>'3',
				);			
			$this->db->where('time_off_id',$p2);
			$this->db->update('time_off',$update_data);			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Time Off Declined Successfully!');
			redirect ('manager/time_off','refresh');
		}
		
		//add employee swap schedule
		if($p1=="swap_add"){
			//$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'employee_c',
				'label' => 'Current Employee',
				'rules' => 'required|callback_check_current_employee_swap_status'
			),
			array(
				'field' => 'reason',
				'label' => 'Swap reason',
				'rules' => 'required'
			),
			array(
				'field' => 'employee',
				'label' => 'Employee',
				'rules' => 'required|callback_employee_schedule_status|callback_recheck_swap_status'
			),
			array(
				'field' => 'start_date',
				'label' => 'Start Date',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->requests("manager_add_swap");

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Swap Added Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "The <strong>start date</strong> selected exceeds the scheduled date when the shift ends!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}
		
		//edit swap
		if($p1=="swap_edit"){
			$data['s_id']=$this->db->get_where('swap', array('swap_id' => $p2));
			$this->load->view('backend/manager/modal_edit_swap.php',$data);
		}
		
		
		//update swap
		if($p1=="swap_update"){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_reason',
				'label' => 'Swap reason',
				'rules' => 'required'
			),
			array(
				'field' => 'u_employee',
				'label' => 'Employee',
				'rules' => 'required|callback_employee_schedule_status'
			),
			array(
				'field' => 'u_start_date',
				'label' => 'Start Date',
				'rules' => 'required|callback_u_validate_start_date'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->requests("m_update_swap",$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Swap Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "The employee selected has an active Shift!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}
		
	}//end requests function

	//recheck swap status in db
	public function recheck_swap_status($p1){
		$validate = $this->crud->recheck_swap_status($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('recheck_swap_status', 'This Employee has a pending Swap schedule!');
			return false;			
		} // /else
	}

	//check swap status of employee and return booleans
	public function check_current_employee_swap_status($p1){
		$validate = $this->crud->check_current_employee_swap_status($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('check_current_employee_swap_status', 'This Employee Already has an active Swap schedule!');
			return false;			
		} // /else
	}
	
	//check whether employee has an active time off on the selected date range and return false
	public function _validate_timeoff(){
		$p1=$this->input->post('date_range');
		$p2=$this->input->post('employee');
		$validate = $this->crud->_validate_timeoff($p1,$p2);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('_validate_timeoff', 'This Employee has an active time off schedule on this duration selected!');
			return false;			
		} // /else
	}
	
	
	//check if specific employee has an active time off status
	public function employee_time_off_status($p1=''){
		$validate = $this->crud->employee_time_off_status($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('employee_time_off_status', 'This Employee Already has an active Time Off Schedule!');
			return false;			
		} // /else
	}
	
	//function to ensure only date range is from today onwards
	public function _validate_selected_date($p1=''){
			$validate = $this->crud->_validate_selected_date($p1);
	

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('_validate_selected_date', 'Select date range starting from <b>'.date('m/d/Y').'</b> onwards!');
			return false;			
		} // /else
	}
	
	//determine if employee has an active shift
		public function validate_start_date(){
			$p1=$this->input->post('schedule_id');
			$p2=$this->input->post('start_date');
		$validate = $this->crud->validate_start_date($p1,$p2);

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_start_date', 'The %s selected exceeds the scheduled date when the shift ends.!');
			return false;			
		} // /else
	}
	
	//determine if employee has an active shift
		public function u_validate_start_date(){
			$p1=$this->input->post('schedule_id');
			$p2=$this->input->post('u_start_date');
		$validate = $this->crud->validate_start_date($p1,$p2);

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('u_validate_start_date', 'The %s selected exceeds the scheduled date when the shift ends.!');
			return false;			
		} // /else
	}
	
	//kill the user session
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
	//end of Manager class bracket
}