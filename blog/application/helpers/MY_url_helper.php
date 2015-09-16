<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//returns the url to a category
function category_url($category)	{

	return base_url('category/' . $category);

}

//Returns the url to an article
function article_url($articleUrl, $articleDate)	{

	$articleDate = date_format(date_create($articleDate), 'Y/m/d');

	return base_url($articleDate . '/' . $articleUrl);

}

//Returns the url to a new article
function new_article_url()	{

	return base_url('article/new');

}

//Returns the url to edit an article
function edit_article_url($articleId = null)	{

	return base_url('article/edit/' . $articleId);

}

//Returns the url to delete an article
function del_article_url($articleId = null)	{

	return base_url('article/delete/' . $articleId);

}

//Returns the url to a new category
function new_category_url()	{

	return base_url('category/new');

}

//Returns the url to edit a category
function edit_category_url($categoryId)	{

	return base_url('category/edit/' . $categoryId);

}

//Returns the url to delete a category
function del_category_url($categoryId)	{

	return base_url('category/delete/' . $categoryId);

}

//Returns the url to a comment
function comment_url($commentId)	{

	return base_url('comment/view/' . $commentId);

}

//Returns the url to edit a comment
function edit_comment_url($commentId)	{

	return base_url('comment/edit/' . $commentId);

}

//Returns the url to delete a comment
function del_comment_url($commentId)	{

	return base_url('comment/delete/' . $commentId);

}

//Returns the url to the static files
function static_url($url)	{

	return base_url('static/' . $url);

}

//Returns the url to the static scripts files
function static_scripts_url($url)	{

	return static_url('scripts/' . $url);

}

//Returns the url to the static styles files
function static_styles_url($url)	{

	return static_url('styles/' . $url);

}