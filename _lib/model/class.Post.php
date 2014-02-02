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
 * File : /_lib/model/class.Post.php
 * Description : Model for Post
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Jan 29 2014 20:04:33 GMT+0530 (IST)
 */
 
class Post{
	/**
	 * @var int   Unique ID of the post  
	 */
	var $id;
	/**
	 * @var varchar   Title of the post 
	 */
	var $title;
	/**
	 * @var int   Unique ID of the author (user) 
	 */
	var $author_id;
	/**
	 * @var varchar   Category(s) of the post (Array) 
	 */
	var $category;
	/**
	 * @var int   ID of the content txt file 
	 */
	var $content_id;
	/**
	 * @var longtext   Short description of the post
	 */
	var $excerpt;
	/**
	 * @var int   Length of the read (in minutes) 
	 */
	var $read_length;
	/**
	 * @var datetime   Time of publish 
	 */
	var $publish_time;
	/**
	 * @var int   Number of upvotes on the post 
	 */
	var $upvote_count;
	/**
	 * @var timestamp   Time of this row entry 
	 */
	var $time;

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	$this->id = $row['id'];
			$this->title = $row['title'];
			$this->author_id = $row['author_id'];
			$this->category = $row['category'];
			$this->content_id = $row['content_id'];
			$this->excerpt = $row['excerpt'];
			$this->read_length = $row['read_length'];
			$this->publish_time = $row['publish_time'];
			$this->upvote_count = $row['upvote_count'];
			$this->time = $row['time'];
        }
    }
}
?>