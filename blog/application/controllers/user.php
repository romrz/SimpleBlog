<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 	{

	public function __construct()	{
	
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
	
	}

	public function login()	{

		//If the user is logged, redirect to index page
		if(user_logged())
			header('location: ' . base_url());


		//Set the validation rules
		$this->form_validation->set_rules('user_email', 'Email', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required');

		//Set the page title
		$data['title'] = 'Login';

		//Store the login errors
		$data['login_errors'] = '';

		//Get the menu
		$data['menu'] = $this->MenuModel->getMenu();

		//Check if the form has been submited
		if($this->form_validation->run())	{

			//Recieve the the information passed by POST
			$email = $this->input->post('user_email');
			$password = $this->input->post('user_password');

			//Get and compare the input info with the database info
			$loginInfo = $this->UserModel->getLoginInfo($email);

			//If the user exist and is an active user an the password is correct, is log in
			if(count($loginInfo) > 0 && $loginInfo->user_status == 'active' && $password == $loginInfo->user_password)	{

				$user_data = array(
					'userId' => $loginInfo->user_id,
					'userName' => $loginInfo->user_name,
					'privileges' => $loginInfo->user_privileges
				);

				$this->session->set_userdata($user_data);

				header('location: ' . base_url());
			
			}
			else 	{

				$data['login_errors'] = 'Datos incorrectos';

				$this->load->view('templates/header', $data);
				$this->load->view('templates/site/menu', $data);
				$this->load->view('user/login', $data);

			}	

		}
		else 	{

			$this->load->view('templates/header', $data);
			$this->load->view('templates/site/menu', $data);
			$this->load->view('user/login', $data);
			
		}

		$this->load->view('templates/footer');

	}

	public function logout()	{

		$this->session->sess_destroy();

		header('location: ' . base_url());

	}

	public function view($id)	{

	}

	public function insert()	{

	}

	public function edit($id)	{

	}

	public function delete($id)	{
		
	}

}