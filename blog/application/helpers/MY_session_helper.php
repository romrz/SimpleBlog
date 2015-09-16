<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Returns true if the user is logged or false if is not
function user_logged()	{

	$CI =& get_instance();

	if($CI->session->userdata('userId'))
		return TRUE;
	else
		return FALSE;
	
}

//Returns true if the user is Admin or false if is not
function is_admin()	{

	$CI =& get_instance();

	if(user_logged() && $CI->session->userdata('privileges') == 1)
		return TRUE;
	else
		return FALSE;


}

//Return true if the user is a simple user or false if is not
function is_user()	{

	$CI =& get_instance();

	if(user_logged() && $CI->session->userdata('privileges') == 0)
		return TRUE;
	else
		return FALSE;


}

//Returns the user's name
function user_name()	{

	$CI =& get_instance();

	return $CI->session->userdata('userName');

}

//Checks if there is an unapproved comment
function comment_exist()	{

	$CI =& get_instance();

	if($CI->session->userdata('comment_id'))
		return TRUE;
	else
		return FALSE; 

}

//Returns the comment id
function sess_comment_id()	{

	$CI =& get_instance();

	return $CI->session->userdata('comment_id');

}

//Returns the comment parent
function sess_comment_parent()	{

	$CI =& get_instance();

	return $CI->session->userdata('comment_parent');

}

//Returns the comment user name
function sess_comment_user_name()	{

	$CI =& get_instance();

	return $CI->session->userdata('comment_user_name');

}

//Returns the comment article
function sess_comment_article()	{

	$CI =& get_instance();

	return $CI->session->userdata('comment_article');

}