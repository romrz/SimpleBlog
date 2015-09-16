<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model	{

	public function __construct()	{

		parent::__construct();
		$this->load->database();

	}

	public function newtUser()	{

	}

	public function getLoginInfo($email)	{

		$sql = "SELECT *
		FROM users 
		WHERE user_email = '$email'";

		//Executes the query
		$query = $this->db->query($sql);
		
		return $query->row();

		$this->db->close();

	}

	public function editInfo()	{

	}

	public function deleteUser()	{

	}

}