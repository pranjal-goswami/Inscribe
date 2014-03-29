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
								$posts = $this->streamAllPublishedPostsByCategory();
							}
							$this->setViewTemplate('post-stream.tpl');
							$this->addToView('posts',$posts);
							return $this->generateView();
					}
				}
		$category_list = $this->getCategoryList();
		$this->setViewTemplate('index.tpl');
		$this->addToView('category_list',$category_list);
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
			$user = $UserDAO->getUserNameByUserId($post->author_id);
			$post->author_name = $user->full_name;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
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
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	 /*
	 *  Get Category List
	 */
	 public function getCategoryList()
	 {
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
	 	$category_list = $PostDAO->getCategoryList();
	 	return $category_list;
	 }


}
?>