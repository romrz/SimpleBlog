                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                data['categories'] = $this->CategoryModel->getCategories();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('article/new_article', $data);
			

		}
		else 	{

			/* *** Get all needed data to create a new article *** */
			//Get the title
			$articleData['article_title'] = $this->input->post('article_title');

			//Get the url
			//If the user doesn't put anything in the url field, then it uses the title with the spaces replaced by dashes
			if($this->input->post('article_url') == '')
				$articleData['article_url'] = str_replace(' ', '-', $articleData['article_title']);
			else
				$articleData['article_url'] = $this->input->post('article_url');

			//Get the article content
			$articleData['article_content'] = $this->input->post('article_content');

			//Get the category of the article
			$articleData['article_category'] = $this->input->post('article_category');

			//Get the actual date and time
			$articleData['article_date'] = date('Y-m-d H:i:s');

			//Gets the las modified date
			$articleData['article_last_modified_date'] = $articleData['article_date'];

			//Get the user who post the article
			$articleData['article_user'] = $this->session->userdata('userId');

			//Insert the article and get his id
			$articleData['article_id'] = $this->ArticleModel->newArticle($articleData);

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('article/insert_article_success', $articleData);

		}

		//Loads the page footer
		$this->load->view('templates/footer');

	}

	//Edits an article
	public function edit($articleId)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the page title
		$data['title'] = 'Editar Articulo';

			//Set the validation rules
		$this->load->library('form_validation');
		$validation = array(
			array(
				'field' => 'article_title',
				'label' => 'Titulo',
				'rules' => 'required'
				),
			array(
				'field' => 'article_content',
				'label' => 'Contenido',
				'rules' => 'required'
				),
			array(
				'field' => 'article_category',
				'label' => 'Categoria',
				'rules' => 'required'
				)
			);
		$this->form_validation->set_rules($validation);

		//If the form has not been submited shows the form to edit the article
		//Else process the data to edit the article
		if($this->form_validation->run() == FALSE)	{

			//Get the article to edit
			$data['article'] = $this->ArticleModel->getArticle($articleId);

			//Loads the category model
			$this->load->model('CategoryModel');
			$data['categories'] = $this->CategoryModel->getCategories();

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('article/edit_article', $data);

		}
		else 	{

			//Get the article id
			$articleData['article_id'] = $articleId;

			//Get the title
			$articleData['article_title'] = $this->input->post('article_title');

			//Get the url
			//If the user doesn't put anything in the url field, then it uses the title with the spaces replaced by dashes
			if($this->input->post('article_url') == '')
				$articleData['article_url'] = str_replace(' ', '-', $articleData['article_title']);
			else
				$articleData['article_url'] = $this->input->post('article_url');

			//Get the article content
			$articleData['article_content'] = $this->input->post('article_content');

			//Gets the actual date
			$articleData['article_last_modified_date'] = date('Y-m-d H:i:s');

			//Get the category of the article
			$articleData['article_category'] = $this->input->post('article_category');

			//Update the article
			$this->ArticleModel->editArticle($articleData);

			//Loads the views
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('article/insert_article_success', $articleData);

		}

		//Loads the page footer
		$this->load->view('templates/footer');

	}

	//Deletes an article
	public function delete($articleId)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the page title
		$data['title'] = 'Eliminar Articulo';

		//Delete article
		$this->ArticleModel->deleteArticle($articleId);

		//Loads the views
		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/menu');
		$this->load->view('article/del_article_success');
		$this->load->view('templates/footer');

	}

}