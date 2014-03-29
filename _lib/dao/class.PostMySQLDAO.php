<?php
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
 * File : class.PostMySQLDAO.php
 * Description : DAO for Posts
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Fri Jan 31 2014 19:14:02 GMT+0530 (IST)
 */ 
class PostMySQLDAO extends PDODAO {
    /*
	 * Get all Posts
	 */
	public function getAllPosts() 
	{
        $q = "SELECT * FROM in_posts";
        $ps = $this->execute($q);
        $result = $this->getDataRowsAsObjects($ps, 'Post');
        return $result;
    }
    /*
	 * Get all Categories
	 */
	public function getCategoryList() 
	{
        $q = "SELECT * FROM in_categories ORDER BY category_name";
        $ps = $this->execute($q);
        $result = $this->getDataRowsAsObjects($ps, 'Category');
        return $result;
    }
    /*
	 * Get all Published Posts
	 */
	public function getAllPublishedPosts() 
	{
        $q = "SELECT * FROM in_posts WHERE publish_flag = 1 ORDER BY publish_time DESC";
        $ps = $this->execute($q);
        $result = $this->getDataRowsAsObjects($ps, 'Post');
        return $result;
    }
    /*
	 * Get All published Posts By Category 
	 */
	public function getAllPublishedPostsByCategory($category_id=null)
	{
		if(is_null($category_id)){
			$this->logger->logError('No Category ID provided.','Input Error');
			return false;
		}
		$q = "SELECT in_posts.* FROM in_posts INNER JOIN in_posts_categories ";
		$q.= "ON in_posts.id=in_posts_categories.post_id "; 
		$q.="WHERE (in_posts_categories.category_id=:category_id AND in_posts.publish_flag=1)";
		$vars = array(
			":category_id"=>(int)$category_id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowsAsObjects($ps,'Post');
		return $result;
	}
	/*
	 * Get Post by Post ID
	 */
	public function getPostByPostId($id=null)
	{
		if(is_null($id)){
			$this->logger->logError('No ID provided.','Input Error');
			return false;
		}
		$q = "SELECT * FROM in_posts WHERE id=:id";
		$vars = array(
			":id"=>(int)$id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowAsObject($ps,'Post');
		return $result;
	}
	/*
	 * Get Posts by Author ID (All posts by an author)
	 */
	public function getPostsByAuthorId($id=null)
	{
		if(is_null($id)){
			$this->logger->logError('No ID provided.','Input Error');
			return false;
		}
		$q = "SELECT * FROM in_posts WHERE author_id=:id";
		$vars = array(
			":id"=>(int)$id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowsAsObjects($ps,'Post');
		return $result;
	}
	/*
	 * Get Posts By Categories 
	 */
	public function getPostsByCategory($category_id=null)
	{
		if(is_null($category_id)){
			$this->logger->logError('No Category ID provided.','Input Error');
			return false;
		}
		$q = "SELECT in_posts.* FROM in_posts INNER JOIN in_posts_categories ";
		$q.= "ON in_posts.id=in_posts_categories.post_id "; 
		$q.="WHERE in_posts_categories.category_id=:category_id";
		$vars = array(
			":category_id"=>(int)$category_id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowsAsObjects($ps,'Post');
		return $result;
	}
	/*
	 * Insert a Post 
	 */
	public function insert(Post $post)
	{
		$q = "INSERT INTO in_posts ";
		$q .= "(title, author_id, excerpt) ";
		$q .= "VALUES (:title, :author_id, :excerpt)";
		$vars = array(
			':title'=>$post->title,
			':author_id'=>Session::getLoggedInUser()->id,
			':excerpt'=>$post->excerpt
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
        return $this->getInsertId($ps);
	}
	/*
	 * Update a Post 
	 */
	public function update(Post $post)
	{
		$q = "UPDATE in_posts ";
		$q .= "SET title=:title, excerpt=:excerpt WHERE id=:post_id";
		$vars = array(
			':title'=>$post->title,
			':excerpt'=>$post->excerpt,
			':post_id'=>Utils::decryptId($post->content_id)
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
	}
	/*
	 * Update Unique Content ID of the Post
	 */
	public function updateContentId($content_id, $post_id)
	{
		$q = "UPDATE in_posts ";
		$q .= "SET content_id=:content_id WHERE id=:post_id";
		$vars = array(
			':content_id'=>$content_id,
			':post_id'=>$post_id
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
	}
	/*
	 * Publish a Post 
	 */
	public function publish(Post $post)
	{
		$q = "UPDATE in_posts ";
		$q .= "SET publish_flag=1, read_length=:read_length, publish_time=Now() WHERE id=:post_id";
		$vars = array(
			':read_length'=>$post->read_length,
			':post_id'=>Utils::decryptId($post->content_id)
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
	}
	/*
	 * Get Categories of a post by Post ID 
	 */
	public function getPostCategories($post_id=null)
	{
		if(is_null($post_id)){
			$this->logger->logError('No Post ID provided.','Input Error');
			return false;
		}
		$q = "SELECT in_categories.category_name FROM in_categories INNER JOIN in_posts_categories ";
		$q.= "ON in_categories.id=in_posts_categories.category_id "; 
		$q.="WHERE in_posts_categories.post_id=:post_id";
		$vars = array(
			":post_id"=>$post_id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowsAsArray($ps);
		return $result;
	}

   
}