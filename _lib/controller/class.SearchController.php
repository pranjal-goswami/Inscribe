<?
/**
 * © 2013-2015 GreekTurtle
 *
 * LICENSE:
 *
 * This file is part of Inscribe (http://inscribe.io).
 *
 * The contents of this file cannot be copied, distributed or modified without prior
 * consent from the author. 
 *
 * Project : Inscribe
 * File : class.SearchController.php
 * Description : Controller for Search
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 17:45:35 GMT+0530 (IST)
 */
 class SearchController extends InscribeController{
 	/**
 	* Main Control of the class
 	*/
 	public function control()
	 {
		$this->disableCaching();
		$this->view_mgr->force_compile = true;
		
		// get DAO
		$SearchDAO = DAOFactory::getDAO('Search','Post_DAO.log');

		// Options that do not require Loggin in
		if(isset($_GET['a'])) {
				if($_GET['a']=='search') {
						$query = $_POST['query'];
						$posts = $this->searchPostsByQuery($query);
						$this->setViewTemplate('post-stream.tpl');
						$this->addToView('posts',$posts);
						if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
						return $this->generateView();
					}
				if($_GET['a']=='typeahead') {
					
				}

			}

		return false;
		
	 }
	 /*
	 *  Search posts by query
	 */
	 public function searchPostsByQuery($query)
	 {
		$SearchDAO = DAOFactory::getDAO('Search','Post_DAO.log');
		$posts = $SearchDAO->getPostsByTitle($query);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserNameByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id);
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get all published posts
	 */
	 public function streamAllPublishedPosts()
	 {
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getAllPublishedPosts();
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserNameByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id);
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get all published posts under a category
	 */
	 public function streamAllPublishedPostsByCategory()
	 {
	 	$category_id = $_POST['category_id'];
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getAllPublishedPostsByCategory($category_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserNameByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id); 
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get all published posts under a category
	 */
	 public function streamAllPublishedPostsByUserId()
	 {
	 	if(isset($_POST['user_id'])) $user_id = $_POST['user_id'];
	 	else $user_id = Session::getLoggedInUser()->id;
	 	
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getAllPublishedPostsByUserId($user_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserNameByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id); 
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get All Posts specific to the user
	 */
	public function getAllPostsByUserId()
	{
		$user_id = Session::getLoggedInUser()->id;
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getPostsByAuthorId($user_id);
		foreach ($posts as $post)
		{
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get Categories (list) and that of the post
	 */
	 public function getPostCategories()
	 {
	 	$post_id = Utils::decryptId($_POST['post_encrypted_id']);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post_categories = $PostDAO->getPostCategories($post_id);
		return $post_categories;
	}

 }