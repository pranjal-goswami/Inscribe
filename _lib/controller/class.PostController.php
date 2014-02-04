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
		
		if(isset($_GET['a'])) {
			if($_GET['a']=='add') return $this->addNewPost();
			if($_GET['a']=='save') return $this->updatePost();
			if($_GET['a']=='create') {
					$this->setViewTemplate('_post.create.tpl');
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
			if($_GET['a']=='publish') return $this->publishPost();
			if($_GET['a']=='read') {
				if(isset($_GET['p'])){
					$this->setViewTemplate('_post.read.tpl');
					$post_id = Post::decryptId($_GET['p']);
					$post = $PostDAO->getPostByPostId($post_id);
					$this->addToView('post',$post);
					return $this->generateView();
				}
			}
		}
		
		$this->setViewTemplate('_Profiles.tpl');
		$this->addBreadcrumbTrail();	
			
		$profile_data = $ProfileDAO->getAllProfiles();
		$this->addToView('profile_data',$profile_data);
		
        return $this->generateView();
	 }
	 /*
	 *  Add a new post
	 */
	 public function addNewPost()
	 {
		$post = new Post($_POST);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$insert_id = $PostDAO->insert($post);
		$content_id = $post->assignContentId($insert_id);
		$PostDAO->updateContentId($content_id, $insert_id);
		$post->saveContentInTextFile($content_id, $post->content);
	}
	 /*
	 *  Save (update) an existing post
	 */
	 public function updatePost()
	 {
		$post = new Post($_POST);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->update($post);
		$post->saveContentInTextFile($post->encrypted_id, $post->content);
	}
	/*
	 *  Publish a post
	 */
	 public function publishPost()
	 {	
		$post = new Post($_POST);
		$post->read_length = $post->calculateReadLength($post->encrypted_id);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->publish($post);
	}

	 

 }