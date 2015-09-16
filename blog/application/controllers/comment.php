<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller	{

	public function __construct()	{
		parent::__construct();
		$this->load->model('CommentModel');
	}

	public function view($commentId = null)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		if($commentId == null)	{

			$data['comments'] = $this->CommentModel->getAllComments();

			$data['title'] = 'Comentarios';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('comments/view_all', $data);
			$this->load->view('templates/footer');

		}
		else 	{

			$commentData = $this->CommentModel->getComment($commentId);

			$data['comment'] = $commentData['comment'];
			$data['answers'] = $commentData['answers'];

			$data['title'] = 'Comentario';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('comments/view', $data);
			$this->load->view('templates/footer');

		}

	}

	//Creates a new comment
	public function insert()	{

		/* ** Gets the comment data ** */
		//Gets the article id
		$articleId = $this->input->post('article_id');

		//Gets the article url
		$articleUrl = $this->input->post('article_url');

		//Gets the article date
		$articleDate = $this->input->post('article_date');

		//Gets the comment content 
		$commentData['comment_content'] = $this->input->post('comment_content');

		//Gets the date
		$commentData['comment_date'] = date('Y-m-d H:i:s');

		//Gets the user data
		$commentData['comment_user_name'] = $this->input->post('comment_user_name');
		$commentData['comment_user_email'] = $this->input->post('comment_user_email');
		$commentData['comment_user_url'] = $this->input->post('comment_user_url');
		$commentData['comment_user_ip'] = $this->session->userdata('ip_address');
		$commentData['comment_user_agent'] = $this->session->userdata('user_agent');

		if(is_admin())
			$commentData['comment_approved'] = 1;
		else	
			$commentData['comment_approved'] = 0;
		
		//Gets the comment parent
		$commentData['comment_parent'] = $this->input->post('comment_parent');

		//Gets the article id
		$commentData['comment_article_id'] = $articleId;

		//Creates the new comment
		$comment_id = $this->CommentModel->newComment($commentData);

	}

	public function edit($commentId)	{

		//Checks if the user is admin
		if(!is_admin())
			show_404(current_url());

		//Set the validation rules
		$this->load->library('form_validation');
		$validation_rules = array(
			array(
				'field' => 'comment_user_name',
				'label' => 'Nombre',
				'rules' => 'required'
			),
			array(
				'field' => 'comment_user_email',
				'label' => 'Email',
				'rules' => 'required'
			),
			array(
				'field' => 'comment_content',
				'label' => 'Comentario',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($validation_rules);

		//If the form has been submited it process the data and creates the comment
		if($this->form_validation->run())	{

			/* ** Gets the comment data ** */
			//Gets the comment id
			$commentData['comment_id'] = $commentId;

			//Gets the comment content 
			$commentData['comment_content'] = $this->input->post('comment_content');

			//Gets the user data
			$commentData['comment_user_name'] = $this->input->post('comment_user_name');
			$commentData['comment_user_email'] = $this->input->post('comment_user_email');
			$commentData['comment_user_url'] = $this->input->post('comment_user_url');

			//Updates the comment
			$this->CommentModel->editComment($commentData);

			//Redirects to the comment
			header('location: ' . comment_url($commentId));

		}
		else 	{

			$commentData = $this->CommentModel->getComment($commentId);
			$data['comment'] = $commentData['comment'];

			$data['title'] = 'Editar Comentario';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/menu');
			$this->load->view('comments/edit_comment', $data);
			$this->load->view('templates/footer');


		}
			

	}

	public function status()	{

		$commentId = $this->input->post('comment_id');
		$status = $this->input->post('status');

		$this->CommentModel->changeStatus($commentId, $status);

	}


	public function delete($commentId)	{

		$this->CommentModel->deleteComment($commentId);

		$data['title'] = 'Comentario Eliminado';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/menu');
		$this->load->view('comments/del_comment_success');
		$this->load->view('templates/footer');
		
	}

}