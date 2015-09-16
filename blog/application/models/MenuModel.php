<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuModel extends CI_Model	{

	//Menu Construct
	public function __construct()	{

		parent::__construct();
		$this->load->database();

	}

	//Return the menu items
	public function getMenu()	{

		$sql = "SELECT *
		FROM categories
		ORDER BY category_display_name DESC";

		//Executes the query
		$query = $this->db->query($sql);

		return $query->result();

		$this->db->close();

	}

}