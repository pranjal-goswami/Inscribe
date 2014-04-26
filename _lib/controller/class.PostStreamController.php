<?
/**
 * © 2013-2015 GreekTurtle
 *
 * LICENSE:
 *
 * This file is part of Inscribe (http://inscribe.io).
 *
 * The contents of this file cannot be copied, distributed or modified without prior
 * consent of the author. 
 *
 * Project : Inscribe
 * File : _lib/controller/class.PostStreamController.php
 * Description : Controller For Post stream
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in>
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 22:09:06 GMT+0530 (India Standard Time)
 */

class PostStreamController extends InscribeController{
	
	public function control()
	{
		$this->disableCaching();
		$this->view_mgr->force_compile = true;

		if($this->isLoggedIn()){
			var_dump(Session::getLoggedInUser());
			$this->addToView('isLoggedIn',true);
			$this->addToView('user',Session::getLoggedInUser());
			}

		// Options that do not require Loggin in
		if(isset($_GET['a'])) {

				if($_GET['a']=='catposts') {
							if($_POST['category_id'] == 0)
							{
								$posts = $this->streamAllPublishedPosts();
							}
							else
							{
								$posts = $this->streamAllPublishedPostsByCategory($_POST['category_id']);
							} 
							
							$this->setViewTemplate('post-stream.tpl');
							$this->addToView('posts',$posts);
							if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
							return $this->generateView();
					}

					if($_GET['a']=='userposts') {
							$posts = $this->streamAllPublishedPostsByUserId();
							$this->setViewTemplate('_user.published-stream.tpl');
							$this->addToView('posts',$posts);
							if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
							return $this->generateView();
					}

					if($_GET['a']=='ownposts') {
							$posts = $this->streamAllPublishedPostsByUserId();
							$this->setViewTemplate('_user.published-stream.tpl');
							$this->addToView('posts',$posts);
							if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
							return $this->generateView();
					}
					if($_GET['a']=='sp') {
							$category_list = $this->getCategoryList();
							$posts = $this->streamAllPublishedPostsByPostTitle();
							$this->setViewTemplate('index.tpl');
							$this->addToView('category_list',$category_list);
							$this->addToView('posts',$posts);
							if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
							return $this->generateView();
					}
					if($_GET['a']=='scatposts') {
							if($_GET['cat'] == 0)
							{
								$posts = $this->streamAllPublishedPosts();
							}
							else
							{
								$posts = $this->streamAllPublishedPostsByCategory($_GET['cat']);
							} 
							$category_list = $this->getCategoryList();
							$this->setViewTemplate('index.tpl');
							$this->addToView('category_list',$category_list);
							$this->addToView('posts',$posts);
							if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
							return $this->generateView();
					}

				}


		$category_list = $this->getCategoryList();
		$posts = $this->streamAllPublishedPosts();
		$this->setViewTemplate('index.tpl');
		$this->addToView('category_list',$category_list);
		$this->addToView('posts',$posts);
		if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
		return $this->generateView();


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
			$user = $UserDAO->getUserByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->author_profile_pic_id = $user->profile_pic_id;
			$post->author_encrypted_id = Utils::encryptId($user->id);
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id);
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get all published posts under a category
	 */
	 public function streamAllPublishedPostsByCategory($category_id)
	 {
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getAllPublishedPostsByCategory($category_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->author_profile_pic_id = $user->profile_pic_id;
			$post->author_encrypted_id = Utils::encryptId($user->id);
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id); 
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get all published posts of a user
	 */
	 public function streamAllPublishedPostsByUserId($user_id=null)
	 {
	 	if(is_null($user_id))
	 	{
			if(isset($_POST['user_id'])) $user_id = $_POST['user_id'];
	 		else $user_id = Session::getLoggedInUser()->id;
		}
		
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$posts = $PostDAO->getAllPublishedPostsByUserId($user_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->author_profile_pic_id = $user->profile_pic_id;
			$post->author_encrypted_id = Utils::encryptId($user->id);
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id); 
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Get (search) all published posts by Post Title
	 */
	 public function streamAllPublishedPostsByPostTitle()
	 {
	 	$title = $_GET['ptitle'];
		$SearchDAO = DAOFactory::getDAO('Search','Search_DAO.log');
		$posts = $SearchDAO->getPostsByTitle($title);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$user = $UserDAO->getUserByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->author_profile_pic_id = $user->profile_pic_id;
			$post->author_encrypted_id = Utils::encryptId($user->id);
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id); 
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	 /*
	 *  Get Category List
	 */
	 public function getCategoryList()
	 {
		 var_dump(DB_USER);
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
	 	$category_list = $PostDAO->getCategoryList();
	 	return $category_list;
	 }


}
?>