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
	 * @var int   Publish status of the post (1=published, 0=not) 
	 */
	var $publish_flag;
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
			$this->content_id = $row['content_id'];
			$this->excerpt = $row['excerpt'];
			$this->read_length = $row['read_length'];
			$this->publish_flag = $row['publish_flag'];
			$this->publish_time = $row['publish_time'];
			$this->upvote_count = $row['upvote_count'];
			$this->time = $row['time'];
        }
    }
    /* Get Content Text from Content ID */
    public function getContentfromContentId($id = null) {
    	if(is_null($id)){
			$this->logger->logError('No Content ID provided.','Input Error');
			return false;
		}
    		$content_path='posts_content/content_:id';
    		$vars = array(
			":id"=>(string)$id
			);
    		$content=file_get_contents($content_path);
    		return $content;	
    }
    /* Calculate Read Length Based on the number of words */
    public function calculateReadLength() {
    	$READ_TIME_PER_WORD = 0.1; //in seconds;
    	$content = $this->getContentfromContentId($this->content_id);
    	$no_of_words=str_word_count($content);
    	$read_length=$no_of_words*$READ_TIME_PER_WORD;
    	$total_read_length=(int)($read_length/60);
    	$this->read_length = $total_read_length;
    }
}
?>