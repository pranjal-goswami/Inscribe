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
				if(empty($_POST)) return false;	
				$post = $this->editPost();
				$this->setViewTemplate('_post.edit.tpl');
				$this->addToView('post',$post);
				return $this->generateView();
			}

			if($_GET['a']=='publish') {
				if(empty($_POST)) return false;
				$this->publishPost();
				$this->assignPostCategories();

				$posts = $this->getAllPostsByUserId();
				$this->setViewTemplate('_posts.manage.tpl');
				$this->addToView('posts',$posts);
				return $this->generateView();
			}

			if($_GET['a']=='unpublish') {
				if(empty($_POST)) return false;
				$this->unPublishPost();

				$posts = $this->getAllPostsByUserId();
				$this->setViewTemplate('_posts.manage.tpl');
				$this->addToView('posts',$posts);
				return $this->generateView();
			}

			if($_GET['a']=='manage') {
				$posts = $this->getAllPostsByUserId();
				$this->setViewTemplate('_posts.manage.tpl');
				$this->addToView('posts',$posts);
				return $this->generateView();
			}

			if($_GET['a']=='delete') {
				$this->deletePost();

				$posts = $this->getAllPostsByUserId();
				$this->setViewTemplate('_posts.manage.tpl');
				$this->addToView('posts',$posts);
				return $this->generateView();
			}

			if($_GET['a']=='assign_categories') {
				$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
				$post_complete_flag = $this->checkPostComplete();
				if($post_complete_flag === false) return false;
				$categories = $PostDAO->getCategoryList();
				$post_categories = $this->getPostCategories();
				$post_categories_array = array();
				foreach ($post_categories as $post_category) {
					array_push($post_categories_array, $post_category->category_name);
				}
				$this->setViewTemplate('_user.assign-categories.tpl');
				$this->addToView('categories',$categories);
				$this->addToView('post_categories',$post_categories_array);
				$this->addToView('post_encrypted_id',$_POST['post_encrypted_id']);
				return $this->generateView();
			}

			if($_GET['a']=='upvote') {
				if(!$this->isLoggedIn()) return 0;
				$post_id = Utils::decryptId($_POST['post_encrypted_id']);
				$user_upvote = Post::checkIfUpvotedByUserId($post_id);
				if($user_upvote != 0) return 1; 
				$this->upvote();
				return 2;
			}

			if($_GET['a']=='undo_upvote') {
				if(!$this->isLoggedIn()) return 0;
				$post_id = Utils::decryptId($_POST['post_encrypted_id']);
				$user_upvote = Post::checkIfUpvotedByUserId($post_id);
				if($user_upvote == 0) return 1;  
				$this->undoUpvote();
				return 2;
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
	 	$post_encrypted_id = $_POST['post_encrypted_id'];
	 	$post_id = Utils::decryptId($post_encrypted_id);
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		$post->read_length = $post->calculateReadLength($post->content_id);
		$PostDAO->publish($post);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		$UserDAO->upUserPostCount();
	}
	/*
	 *  UnPublish a post
	 */
	 public function unPublishPost()
	 {	
	 	$post_encrypted_id = $_POST['post_encrypted_id'];
	 	$post_id = Utils::decryptId($post_encrypted_id);
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->unPublish($post_id);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		$UserDAO->downUserPostCount();
	}
	/*
	 *  Edit Post
	 */
	 public function editPost()
	 {	
	 	$post_encrypted_id = $_POST['post_encrypted_id'];
	 	$post_id = Utils::decryptId($post_encrypted_id);
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		$content = Post::getContentfromContentId($post->content_id);
		$post->content = $content;
		return $post;
	}
	/*
	 *  Delete Post
	 */
	 public function deletePost()
	 {	
	 	$post_encrypted_id = $_POST['post_encrypted_id'];
	 	Post::deleteContentfromContentId($post_encrypted_id);
	 	$post_id = Utils::decryptId($post_encrypted_id);
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->delete($post_id);
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
	/*
	 *  Check if Post is complete
	 */
	 public function checkPostComplete()
	 {
	 	$post_id = Utils::decryptId($_POST['post_encrypted_id']);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		if($post->title == '' || $post->excerpt == '') return false;
		else return true;
	}
	/*
	 *  Assign Post Categories
	 */
	 public function assignPostCategories()
	 {
	 	$post_id = Utils::decryptId($_POST['post_encrypted_id']);
	 	$post_categories = $_POST['post_categories'];
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$PostDAO->insertPostCategories($post_id, $post_categories);
	}
	/*
	 *  Upvote a Post
	 */
	 public function upvote()
	 {
	 	$post_id = Utils::decryptId($_POST['post_encrypted_id']);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		$PostDAO->upvote($post);
	}
	/*
	 *  Undo Upvote a Post
	 */
	 public function undoUpvote()
	 {
	 	$post_id = Utils::decryptId($_POST['post_encrypted_id']);
		$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
		$post = $PostDAO->getPostByPostId($post_id);
		$PostDAO->undoUpvote($post);
	}
	 

 }