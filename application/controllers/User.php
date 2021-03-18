<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Crud_model','crud');
	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE)
            redirect(base_url(), 'refresh');
	}
	
	public function index()
	{
		$this->dashboard();
	}
	
	public function dashboard(){
		$this->check_session();
        $page_data['page_name']  = 'dashboard';
		$page_data['crumb']  = '1';	
		//$page_data['page_name_phrase']  = '';//get_phrase('dashboard');
        $page_data['page_title'] = 'dashboard';//get_phrase('admin dashboard');
        $this->load->view('index', $page_data);
		//$this->load->view('backend/index');
	}
	
	//shifts
	public function shifts(){
		$this->check_session();
        $page_data['page_name']  = 'shifts';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'shifts';;
        $this->load->view('index', $page_data);
	}
	
	//profile
	public function profile(){
		$this->check_session();
        $page_data['page_name']  = 'profile';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'profile';;
        $this->load->view('index', $page_data);
	}
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
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required|min_length[10]'
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->user_profile_post($userId);

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
	
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Picture Updated Successfully!');
			redirect ('user/profile','refresh');
	}
	
	public function family($p1="",$p2=""){
		if($p1=="add"){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'marital_status',
				'label' => 'Marital Status',
				'rules' => 'required'
			),
			array(
				'field' => 'spouse',
				'label' => 'Spouse',
				'rules' => 'required'
			),
			array(
				'field' => 's_phone',
				'label' => 'Spouse Phone Number',
				'rules' => 'required|is_numeric|min_length[10]'
			),
			array(
				'field' => 'kids',
				'label' => 'Number of Kids',
				'rules' => 'required|is_numeric'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->family("add", $userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Family Details Added Successfully!";
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
		if($p1=="update"){
			
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_marital_status',
				'label' => 'Marital Status',
				'rules' => 'required'
			),
			array(
				'field' => 'spouse',
				'label' => 'Spouse',
				'rules' => 'required'
			),
			array(
				'field' => 's_phone',
				'label' => 'Spouse Phone Number',
				'rules' => 'required|is_numeric|min_length[10]'
			),
			array(
				'field' => 'kids',
				'label' => 'Number of Kids',
				'rules' => 'required|is_numeric'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->family("update", $userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Family Details Updated Successfully!";
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
		if($p1=="get_family"){
			if($p2=="0"){
				echo '';
			}
			if($p2=="1"){
				echo '<div class="form-group">
						<label>Spouse Name:</label>
						<input type="text" name="spouse" placeholder="spouse name" id="spouse" class="form-control">
					  </div>
					  <div class="form-group">
						<label>Spouse Phone Number:</label>
						<input type="text" name="s_phone" id="s_phone" placeholder="spouse phone number" class="form-control">
					  </div>
					  <div class="form-group">
						<label>Number Of Kids:</label>
						<input type="text" name="kids" id="kids" placeholder="number of kids" class="form-control">
					  </div>';
			}
		}
	}
	
	//time off
	public function time_off(){
		$this->check_session();
        $page_data['page_name']  = 'time_off';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'Time off';
        $this->load->view('index', $page_data);
	}
	
	//swap schedules
	public function schedule_swap(){
		$this->check_session();
        $page_data['page_name']  = 'schedule_swap';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'Schedule swap';
        $this->load->view('index', $page_data);
	}
	
	//employee reports
	public function reports(){
		$this->check_session();
        $page_data['page_name']  = 'reports';
		$page_data['crumb']  = '1';	
        $page_data['page_title'] = 'Reports';
        $this->load->view('index', $page_data);
	}
	
	//requests
	public function requests($p1='',$p2=''){
		
		if($p1=="get_option"){
			if($p2=="other"){
				echo '<div class="form-group">
						<label>Add Other Reason:</label>
						 <textarea class="form-control" name="other_reason" required="required" id="other_reason" placeholder="Input the reason..."></textarea>
					</div>';
			}
		}
		
		//add 
		if($p1=="add"){
			$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
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
		//edit
		if($p1=="edit"){
			$data['timeoff_id']=$this->db->get_where('time_off', array('time_off_id' => $p2));
			$this->load->view('backend/user/modal_edit_time_off.php',$data);
		}
		//add swap
		if($p1=="swap_add"){
			$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'reason',
				'label' => 'Swap reason',
				'rules' => 'required'
			),
			array(
				'field' => 'employee',
				'label' => 'Employee',
				'rules' => 'required|callback_employee_schedule_status'
			),
			array(
				'field' => 'start_date',
				'label' => 'Start Date',
				'rules' => 'required|callback_validate_start_date'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->requests("add_swap");

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Swap Added Successfully!";
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
		
		if($p1=="swap_edit"){
			$data['s_id']=$this->db->get_where('swap', array('swap_id' => $p2));
			$this->load->view('backend/user/modal_edit_swap.php',$data);
		}
		
		//update swap
		if($p1=="swap_update"){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'reason',
				'label' => 'Swap reason',
				'rules' => 'required'
			),
			array(
				'field' => 'employee',
				'label' => 'Employee',
				'rules' => 'required|callback_employee_schedule_status'
			),
			array(
				'field' => 'start_date',
				'label' => 'Start Date',
				'rules' => 'required|callback_validate_start_date'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->crud->requests("update_swap",$p2);

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
		
		//update time off
		if($p1=="update"){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
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

			$posting = $this->crud->requests("update_time_off",$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Time Off updated Successfully!";
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
	}
	//determine if employee has an active shift
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
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
	//end
}