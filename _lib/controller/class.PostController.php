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
 * File : class.PostController.php
 * Description : Controller for Post
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 17:45:35 GMT+0530 (IST)
 */
 class PostController extends InscribeController{
 	/**
 	* Main Control of the class
 	*/
 	public function control()
	 {
		$this->disableCaching();
		$this->view_mgr->force_compile = true;
		
		// get DAO
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');

		// Options that do not require Loggin in
		if(isset($_GET['a'])) {
				if($_GET['a']=='read') {
							$post = $this->getPostInBook();
							$this->setViewTemplate('_post.read.tpl');
							$this->addToView('post',$post);
							return $this->generateView();
					}
				}

		// Options that require Logging in		
		if(isset($_GET['a'])) {

			//if(!$this->isLoggedIn()) return $this->redirect('../');

			if($_GET['a']=='save') {
				if(empty($_POST)) return false;	
				return $this->updatePost();
			}
			if($_GET['a']=='create') {
					$this->setViewTemplate('post.create.tpl');
					$content_id = $this->createNewPost();
					$this->addToView('content_id',$content_id);
					return $this->generateView();
			}
			if($_GET['a']=='edit') {
				if(isset($_GET['p'])){
					$this->setViewTemplate('_post.edit.tpl');
					$post = $PostDAO->getPostByPostId(intval($_GET['p']));
					$this->addToView('post',$post);
					return $this->generateView();
				}
			}
			if($_GET['a']=='publish') {
				if(empty($_POST)) return false;
				return $this->publishPost();
			}
			
		}

		return false;
		
	 }
	 /*
	 *  Add a new post
	 */
	 public function createNewPost()
	 {
		$post = new Post();
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$insert_id = $PostDAO->insert($post);
		$content_id = $post->assignContentId($insert_id);
		$PostDAO->updateContentId($content_id, $insert_id);
		$post->saveContentInTextFile($content_id, $post->content);
		return $content_id;
	}
	 /*
	 *  Save (update) an existing post
	 */
	 public function updatePost()
	 {
		$post = new Post($_POST);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->update($post);
		$post->saveContentInTextFile($post->content_id, $post->content);
	}
	/*
	 *  Publish a post
	 */
	 public function publishPost()
	 {	
		$post = new Post($_POST);
		$post->read_length = $post->calculateReadLength($post->content_id);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->publish($post);
	}
	/*
	 *  Fetch content and put in book form
	 */
	public function getPostInBook()
	{
		$content_id = $_POST['post_encrypted_id'];
		$post_id = Utils::decryptId($content_id);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		$user = $UserDAO->getUserNameByUserId($post->author_id);
		$post->author_name = $user->full_name;
		$content = Post::getContentfromContentId($content_id);
		$pages = explode('<!-- pagebreak -->', $content);
		$page_count = sizeof($pages);
		if($page_count%2==0) $post->page_count = 0;
		else $post->page_count = 1;
		$post->pages = $pages;
		return $post;

	}

	 

 }