<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//login class
class Login extends CI_Controller {

public function __construct(){
		parent:: __construct();
		$this->load->model('Login_model','lm');
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		$this->index();
	}
	//validate login
	public function validate(){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|callback_validate_username'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$login = $this->lm->login($username, $password);

			if($login) {
				$user_data = array(
					'id' => $login,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				
				//determine role
				$role=$this->db->get_where('login' , array('id'=>$login))->row()->role; 
				
				//if manager				
				if($role=='manager'){
					$validator['success'] = true;
					$validator['messages'] = "manager/dashboard";
				}else{
					//else user
					$validator['success'] = true;
					$validator['messages'] = "user/dashboard";
				}
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "<i class='ti-info-alt'></i> Your Password is Incorrect!";
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

	public function validate_username()
	{
		$validate = $this->lm->validate_username($this->input->post('username'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_username', 'This user does not exist!');
			return false;			
		} // /else
	} // /validate username function
	
	public function register(){
		$this->load->view('register');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
	public function validate_register(){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'r_username',
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
				'field' => 'r_password',
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
				'rules' => 'required|matches[r_password]'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->lm->register_post();

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Account created successfully!";
			
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


//end of class login
}