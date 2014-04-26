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
						$query = $_POST['term'];
						$posts = $this->searchPostsByTitle($query);
						$this->setViewTemplate('post-stream.tpl');
						$this->addToView('posts',$posts);
						if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
						return $this->generateView();
					}
				if($_GET['a']=='typeahead') {
					$query = $_GET['term'];
					$posts = (array)$this->searchPostsByTitle($query);
					$authors = (array)$this->searchAuthorNames($query);
					$search_results = array_merge($posts, $authors);
					if(empty($search_results))
					{
						$result = (object) array("label"=>"No results found", "sublabel"=>"Try another keyword", "type_gl_icon"=>"exclamation-sign");
						$search_results = array($result);
					}  
					return json_encode($search_results);

				}

			}

		return false;
		
	 }
	 /*
	 *  Search posts by title
	 */
	 public function searchPostsByTitle($query)
	 {
		$SearchDAO = DAOFactory::getDAO('Search','Post_DAO.log');
		$posts = $SearchDAO->getPostsByTitle($query);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		foreach ($posts as $post)
		{
			$post->label = $post->title;
			$user = $UserDAO->getUserByUserId($post->author_id);
			$post->type_gl_icon = "book";
			$post->type = "post";
			$post->author_name = $user->full_name;
			$post->author_profile_pic_id = $user->profile_pic_id;
			$post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			$post->sublabel = "By ".$user->full_name.", published ".$post->published_on;
			if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id);
			$post->categories = Post::getPostCategories($post->id);
		}
		return $posts;
	}
	/*
	 *  Search author names
	 */
	 public function searchAuthorNames($query)
	 {
		$SearchDAO = DAOFactory::getDAO('Search','Post_DAO.log');
		$authors = $SearchDAO->getAuthorNames($query);
		foreach ($authors as $author)
		{
			$author->label = $author->full_name;
			$author->sublabel = $author->posts_count." posts published";
			$author->type_gl_icon = "user";
			$author->type = "user";
			$author->encrypted_id = Utils::encryptId($author->id); 
			// $post->published_on = Post::convertToDisplayPublishTime($post->publish_time);
			// if($this->isLoggedIn()) $post->user_upvote = Post::checkIfUpvotedByUserId($post->id);
			// $post->categories = Post::getPostCategories($post->id);
		}
		return $authors;
	}
	

 }