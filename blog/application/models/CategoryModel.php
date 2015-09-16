<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model	{

	//Category Model construct
	public function __construct()	{

		parent::__construct();
		$this->load->database();

	}

	//Return all articles
	public function getAllArticles()	{

		$sql = "SELECT * FROM articles 
		LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id
		LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
		ORDER BY article_id DESC";

		//Execute the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->result();

	}

	//Return articles by category
	public function getArticles($categoryName)	{

		$sql = "SELECT * FROM categories
		LEFT JOIN articles_has_categories ON articles_has_categories.categories_category_id = categories.category_id
		LEFT JOIN articles ON articles.article_id = articles_has_categories.articles_article_id
		WHERE articles.article_status = 'published' AND categories.category_display_name = '$categoryName'";

		//Execute the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->result();

	}

	//Return the last articles
	public function getLastArticles()	{

		$sql = "SELECT * FROM articles 
		LEFT JOIN articles_has_categories ON articles_has_categories.articles_article_id = articles.article_id
		LEFT JOIN categories ON categories.category_id = articles_has_categories.categories_category_id
		WHERE articles.article_status = 'published'
		ORDER BY article_id DESC";

		//Execute the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->result();

	}

	//Return the category data
	public function getCategory($categoryId)	{

		$sql = "SELECT *
		FROM categories
		WHERE category_id = " . $categoryId;

		//Execute the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->row();

	}

	//Return the categories
	public function getCategories()	{

		$sql = "SELECT * FROM categories";

		//Execute the query
		$query = $this->db->query($sql);

		$this->db->close();

		return $query->result();
	}

	//Creates a new category
	public function newCategory($data)	{

		$sql = "INSERT INTO categories (category_display_name, category_url)
		VALUES (
			'" . $data['category_display_name'] . "',
			'" . $data['category_url'] . "'
		)";

		//Execute the query
		$this->db->query($sql);

		$this->db->close();

	}

	//Edits a category
	public function editCategory($data)	{

		$sql = "UPDATE categories
		SET category_display_name = '" . $data['category_display_name'] . "',
		category_url = '" . $data['category_url'] . "'
		WHERE category_id = " . $data['category_id'];

		//Executes the query
		$this->db->query($sql);

		$this->db->close();

	}

	//Deletes a category
	public function deleteCategory($categoryId)	{

		$sql_has_categories = "DELETE FROM articles_has_categories
		WHERE categories_category_id = " . $categoryId;

		$sql_categories = "DELETE FROM categories
		WHERE category_id = " . $categoryId;

		//Executes the queries
		$this->db->query($sql_has_categories);
		$this->db->query($sql_categories);

		$this->db->close();

	}

}