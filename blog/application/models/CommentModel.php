<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommentModel extends CI_Model	{

	public function __construct()	{
		parent::__construct();
		$this->load->database();
	}

	//Returns a comment
	public function getComment($commentId)	{

		$sql_comment = "SELECT *
		FROM comments
		LEFT JOIN articles ON articles.article_id = comments.articles_article_id
		WHERE comments.comment_id = " . $commentId;

		$sql_answers = "SELECT *
		FROM comments
		WHERE comment_parent = " . $commentId;

		$query_comment = $this->db->query($sql_comment);
		$query_answers = $this->db->query($sql_answers);

		$commentData = array(
			'comment' => $query_comment->row(),
			'answers' => $query_answers->result()
		);

		return $commentData;

	}

	//Returns all comments
	public function getAllComments()	{

		$sql_comments = "SELECT *
		FROM comments
		LEFT JOIN articles ON articles.article_id = comments.articles_article_id
		ORDER BY comments.comment_id DESC";

		$query = $this->db->query($sql_comments);

		return $query->result();

	}

	//Returns all the comments of an article
	public function getCommentsByArticle($articleId)	{

		$sql_comments = "SELECT *
		FROM comments
		WHERE comment_approved = 1 AND comment_parent = 0 AND articles_article_id = " . $articleId;

		$sql_answers = "SELECT *
		FROM comments
		WHERE comment_approved = 1 AND comment_parent <> 0 AND articles_article_id = " . $articleId;

		//Executes the queries
		$query_comments = $this->db->query($sql_comments);
		$query_answers = $this->db->query($sql_answers);

		$comments_data = array(
			'comments' => $query_comments->result(),
			'answers' => $query_answers->result()
		);
		
		$this->db->close();
		
		return $comments_data;

		

	}

	public function getCommentsByUser($userId)	{

	}

	//Creates a new comment
	public function newComment($data)	{

		$sql_insert_comment = "INSERT INTO comments (comment_content, comment_date, comment_user_name, comment_user_email, comment_user_url, comment_user_ip, comment_user_agent, comment_approved, comment_parent, articles_article_id)
		VALUES (
			'" . $data['comment_content'] . "',
			'" . $data['comment_date'] . "',
			'" . $data['comment_user_name'] . "',
			'" . $data['comment_user_email'] . "',
			'" . $data['comment_user_url'] . "',
			'" . $data['comment_user_ip'] . "',
			'" . $data['comment_user_agent'] . "',
			'" . $data['comment_approved'] . "',
			'" . $data['comment_parent'] . "',
			" . $data['comment_article_id'] . "
		)";

		$this->db->query($sql_insert_comment);

		$insert_id = $this->db->insert_id();

		if($data['comment_approved'] == 1)	{

			$sql_article_comments = "UPDATE articles
			SET article_comments = article_comments + 1
			WHERE article_id = " . $data['comment_article_id'];

			$this->db->query($sql_article_comments);
			
		}

		return $insert_id;


	}

	public function editComment($data)	{

		$sql = "UPDATE comments
		SET comment_content = '" . $data['comment_content'] . "',
		comment_user_name = '" . $data['comment_user_name'] . "',
		comment_user_email = '" . $data['comment_user_email'] . "',
		comment_user_url = '" . $data['comment_user_url'] . "'
		WHERE comment_id = " . $data['comment_id'];

		$this->db->query($sql);

	}

	public function changeStatus($comment_id, $status)	{

		$sql_update_comments = "UPDATE comments
		SET comment_approved = $status
		WHERE comment_id = $comment_id";

		if($status == 1)	{
			$sql_update_articles = "UPDATE articles
			SET articles.article_comments = articles.article_comments + 1
			WHERE articles.article_id = (
				SELECT comments.articles_article_id
				FROM comments
				WHERE comments.comment_id = $comment_id)";
		}
		else 	{
			$sql_update_articles = "UPDATE articles
			SET articles.article_comments = articles.article_comments - 1
			WHERE articles.article_id = (
				SELECT comments.articles_article_id
				FROM comments
				WHERE comments.comment_id = $comment_id)";
		}

		$this->db->query($sql_update_comments);
		$this->db->query($sql_update_articles);

	}

	public function deleteComment($commentId)	{

		$sql_article_comments = "UPDATE articles
		SET articles.article_comments = articles.article_comments - 1 -(SELECT COUNT(*)
			FROM comments 
			WHERE comments.comment_parent = $commentId)
		WHERE article_id = (
			SELECT comments.articles_article_id
			FROM comments
			WHERE comments.comment_id = $commentId
		)";

		$sql_delete_comment = "DELETE
		FROM comments
		WHERE comment_id = " . $commentId . " OR comment_parent = " . $commentId;

		$this->db->query($sql_article_comments);
		$this->db->query($sql_delete_comment);

	}

}