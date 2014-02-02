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
	public function getAllPosts() {
        $q = "SELECT * FROM in_posts";
        $ps = $this->execute($q);
        $result = $this->getDataRowsAsObjects($ps, 'Post');
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
	public function insertPost(Post $post)
	{
		$q = "INSERT INTO in_posts";
		$q .= "(title, author_id, category, content_id, excerpt, read_length, publish_time, upvote_count) ";
		$q .= "VALUES (:title, :author_id, :category, :content_id, :excerpt, :read_length, :publish_time, :upvote_count, :time)";
		$vars = array(
			':title'=>$post->title,
			':author_id'=>$post->author_id,
			':category'=>$post->category,
			':content_id'=>$post->content_id,
			':excerpt'=>$post->excerpt,
			':read_length'=>$post->read_length,
			':publish_time'=>$post->publish_time,
			':upvote_count'=>$post->upvote_count
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
        return $this->getInsertId($ps);
	}

   
}