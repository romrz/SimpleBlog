<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends CI_Model	{

	//Article Model construct
	public function __construct()	{

		parent::__construct();
		$this->load->database();

	}

	/**
	 * Get an article by his id
	 *
	 * @param Int $articleId.
	 * 
	 * @return Object. An object with the result of the query
	 *
	*/
	public function getArticleById($articleId)	{

		$sql = "SELECT *
		FROM articles 
		LEFT JOIN users ON users.user_id = articles.users_user_id 
		LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id 
		LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
		WHERE articles.article_status = 'published' AND articles.article_id = " . $articleId;

		//Executes the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->row();

	}

	/**
	 * Get an article by his url and date
	 *
	 * @param String $articleUrl.
	 * @param String Date $articleDate. 
	 * 
	 * @return Object. An object with the result of the query
	 *
	*/
	public function getArticleByUrl($articleUrl, $articleDate)	{

		$sql = "SELECT *
		FROM articles 
		LEFT JOIN users ON users.user_id = articles.users_user_id 
		LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id 
		LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
		WHERE articles.article_status = 'published' AND DATE(articles.article_date) = '$articleDate' AND articles.article_url = '$articleUrl'";

		//Executes the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->row();

	}

	/**
	 * Get an article by his date
	 *
	 * @param Int $year.
	 * @param Int $month (optional).
	 * @param Int $day (optional). 
	 * 
	 * @return Array of objects. An array of objects with the result of the query
	 *
	*/
	public function getArticlesByDate($year, $month = null, $day = null)	{

		if($year != null && $month != null && $day != null)	{

			$date = $year . '-' . $month . '-' . $day;

			$sql = "SELECT *
			FROM articles 
			LEFT JOIN users ON users.user_id = articles.users_user_id 
			LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id 
			LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
			WHERE articles.article_status = 'published' AND DATE(articles.article_date) = '$date'";

		}
		elseif($year != null && $month != null)	{

			$date = $year . '-' . $month;

			$sql = "SELECT *
			FROM articles 
			LEFT JOIN users ON users.user_id = articles.users_user_id 
			LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id 
			LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
			WHERE articles.article_status = 'published' AND DATE_FORMAT(articles.article_date, '%Y-%m') = '$date'";

		}
		elseif($year != null)	{

			$date = $year;

			$sql = "SELECT *
			FROM articles 
			LEFT JOIN users ON users.user_id = articles.users_user_id 
			LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id 
			LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
			WHERE articles.article_status = 'published' AND DATE_FORMAT(articles.article_date, '%Y') = '$date'";

		}

		//Executes the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->result();

	}

	//Creates a new article
	public function newArticle($data)	{

		//Inserts the new article in the table articles
		$sql = "INSERT INTO articles(article_title, article_url, article_content, article_date, article_last_modified_date, users_user_id)
		VALUES (
			'" . $data['article_title'] . "',
			'" . $data['article_url'] . "',
			'" . $data['article_content'] . "',
			'" . $data['article_date'] . "',
			'" . $data['article_last_modified_date'] . "',
			'" . $data['article_user'] . "'
		)";
		$this->db->query($sql);

		//Gets the las insert id
		$articleId = $this->db->insert_id();
		
		//Set the article category
		if($data['article_category'] != 0)	{

			$sql = "INSERT INTO articles_has_categories (articles_article_id, categories_category_id)
			VALUES (
				'" . $articleId . "',
				'" . $data['article_category'] . "'
			)";
				
			$this->db->query($sql);

		}

		$this->db->close();

		return $articleId;

	}

	//Edits an article
	public function editArticle($data)	{

		//Update the article
		$sql = "UPDATE articles
		SET article_title = '" . $data['article_title'] . "',
			article_url = '" . $data['article_url'] . "',
			article_content = '" . $data['article_content'] . "',
			article_last_modified_date = '" . $data['article_last_modified_date'] . "'
		WHERE article_id = " . $data['article_id'];

		$this->db->query($sql);

		//Update the category
		$del_sql = "DELETE FROM articles_has_categories WHERE articles_article_id = " . $data['article_id'];
		$insert_sql = "INSERT INTO articles_has_categories (articles_article_id, categories_category_id)
		VALUES (
			'" . $data['article_id'] . "',
			'" . $data['article_category'] . "'
		)";

		//Execute the queries
		$this->db->query($del_sql);
		$this->db->query($insert_sql);

		$this->db->close();

	}

	//Deletes an article
	public function deleteArticle($articleId)	{

		//Delete the article
		$del_articles = "DELETE FROM articles WHERE article_id = " . $articleId;
		$del_categories = "DELETE FROM articles_has_categories WHERE articles_article_id = ". $articleId;
		$del_comments = "DELETE FROM comments WHERE articles_article_id = " . $articleId;

		//Execute the queries
		$this->db->query($del_categories);
		$this->db->query($del_comments);
		$this->db->query($del_articles);

		$this->db->close();

	}
	
}