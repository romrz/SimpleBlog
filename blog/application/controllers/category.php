<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller	{

	//Category constructor
	public function __construct()	{

		parent::__construct();
		$this->load->model('CategoryModel');
		$this->output->enable_profiler(FALSE);

	}

	//Index Page
	public function index()	{

		//Get the last articles
		$data['articles'] = $this->CategoryModel->getLastArticles();

		//Get the menu
		$data['menu'] = $this->MenuModel->getMenu();

		//Get the basic information
		$data['title'] = 'Inicio';

		//Loads the views		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/site/menu', $data);
		$this->load->view('category/view', $data);
		$this->load->view('article/view_articles', $data);
		$this->load->view('templates/footer');

	}

	//Category Page
	public function view($categoryName)	{

		//Get the articles by category
		$data['articles'] = $this->CategoryModel->getArticles($categoryName);

		//Get the menu
		$data['menu'] = $this->MenuModel->getMenu();

		//Get the basic information
		$data['title'] = $categoryName;

		//Loads the views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/site/menu', $data);
		$this->load->view('category/view', $data);
		$this->load->view('article/view_articles', $data);
		$this->load->view('templates/footer');		

	}

	//Creates a new category
	public function insert()	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the validation rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_display_name', 'Categoria', 'required');

		//Set the page title
		$data['title'] = 'Nueva Categoria';

		//If the form has not been submitted it shows the form to create a new category
		//Else process the data and create the category
		if($this->form_validation->run() == FALSE)	{

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('category/new_category');

		}
		else 	{

			/* **Gets the category data** */
			//Gets the category name
			$categoryData['category_display_name'] = $this->input->post('category_display_name');

			if($this->input->post('category_url') == '')
				$categoryData['category_url'] = strtolower(str_replace(' ', '-', $categoryData['category_display_name']));
			else
				$categoryData['category_url'] = $this->input->post('category_url');

			//Creates the new category
			$this->CategoryModel->newCategory($categoryData);

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('category/new_category_success', $categoryData);

		}

		//Loads the page footer
		$this->load->view('templates/footer');

	}

	//Edits a category
	public function edit($categoryId)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the validation rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_display_name', 'Categoria', 'required');

		//Set the page title
		$data['title'] = 'Editar Categoria';

		//If the form has not been submited it shows the form to edit the category
		//Else it process the data and update the category
		if($this->form_validation->run() == FALSE)	{

			//Gets the category data
			$data['category'] = $this->CategoryModel->getCategory($categoryId);

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('category/edit_category', $data);

		}
		else 	{

			//Gets the category data
			$categoryData['category_id'] = $categoryId;
			$categoryData['category_display_name'] = $this->input->post('category_display_name');

			if($this->input->post('category_url') == '')
				$categoryData['category_url'] = strtolower(str_replace(' ', '-', $categoryData['category_display_name']));
			else
				$categoryData['category_url'] = $this->input->post('category_url');

			//Update the category
			$this->CategoryModel->editCategory($categoryData);

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('category/new_category_success', $categoryData);

		}

		//Loads the page footer
		$this->load->view('templates/footer');

	}

	//Deletes a category
	public function delete($categoryId)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the page title
		$data['title'] = 'Eliminar Categoria';

		//Deletes the category
		$this->CategoryModel->deleteCategory($categoryId);

		//Loads the views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/menu');
		$this->load->view('category/del_category_success');
		$this->load->view('templates/footer');

	}

}