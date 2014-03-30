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
 
class Post {
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
	 * @var varchar   ID of the content txt file.  (== Encryption of Unique Post ID)
	 */
	var $content_id;
	/**
	 * @var blob Content (from editor) -- Transient Field
	 */
	var $content;
	/**
	 * @var longtext   Short description of the post
	 */
	var $excerpt;
	/**
	 * @var int   Length of the read (in minutes) 
	 */
	var $read_length;
	/**
	 * @var int   Publish status of the post (1=published, 0=not published yet) 
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
	/**
	 * @var timestamp   Time of creation if this post
	 */
	var $created_time;

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	$this->id = $row['id'];
			$this->title = $row['title'];
			$this->author_id = $row['author_id'];
			$this->content_id = $row['content_id'];
			$this->content = $row['content'];
			$this->excerpt = $row['excerpt'];
			$this->read_length = $row['read_length'];
			$this->publish_flag = $row['publish_flag'];
			$this->publish_time = $row['publish_time'];
			$this->upvote_count = $row['upvote_count'];
			$this->time = $row['time'];
        }
    }

    /* 
    * Get Content Text from Content ID 
    */
    public static function getContentfromContentId($content_id = null) {

		$content_path='posts_content/content_'.$content_id.'.txt';
		$content=file_get_contents($content_path);
		return $content;	
    }
    /* 
    * Get Content Text from Content ID 
    */
    public static function deleteContentfromContentId($content_id = null) {

		$content_path='posts_content/content_'.$content_id.'.txt';
		unlink($content_path);	
    }
    /* 
    * Calculate Read Length Based on the number of words 
    */
    public function calculateReadLength($content_id=null) {

    	$READ_TIME_PER_WORD = 0.3; //in seconds; (at 200 Words Per Minute)
    	$content = Post::getContentfromContentId($content_id);
    	$no_of_words=str_word_count($content);
    	$read_length=$no_of_words*$READ_TIME_PER_WORD;
    	$total_read_length=(int)($read_length/60);
    	if($total_read_length==0) $total_read_length = 1;
    	return $total_read_length;
    }

    /* 
    * Generate and assign Unique Content ID 
    */
    public function assignContentId($post_id=null) {

		return Utils::encryptId($post_id);
    }

    /* 
    * Save Content of Post in a Text File  
    */
    public function saveContentInTextFile($content_id=null, $content=null) {

		$filepath='posts_content/content_'.$content_id.'.txt';
		file_put_contents($filepath, $content);
    }
    /*
	 *  Convert Publish timestamp to 'Published on' for display
	 */
	 public static function convertToDisplayPublishTime($time)
	 {
	 	$publish_time = strtotime($time);
	 	$now = time();
	 	$lapse = $now - $publish_time;

	 	$MINUTE = 60;
	 	$HOUR = 60 * 60;
	 	$DAY = 24 * 60 * 60;
	 	$WEEK = $DAY * 7;
	 	$MONTH = $WEEK * 30;
	 	$YEAR = $MONTH * 12;

	 	$publish_case = 0;

	 	// $time24 = substr($time, 11, 5);
 		// $time24e = explode(':', $time24);
 		// $hour = $time24e[0];
 		// $minute = $time24e[]
 		// if($hour == 12 && )
 		// $publish_case = 1;

	 	if ($lapse < $MINUTE)
	 	{
	 		$publish_case = 0;
	 	}
	 	elseif ($lapse < $HOUR)
	 	{
	 		$magnitude = intval($lapse / $MINUTE);
	 		if($magnitude == 1) $publish_case = 1;
	 		else $publish_case = 2;
	 	}
	 	elseif ($lapse < $DAY) 
	 	{
	 		$magnitude = intval($lapse / $HOUR);
	 		if($magnitude == 1) $publish_case = 3;
	 		else $publish_case = 4;
	 	}
	 	elseif ($lapse < $WEEK)
	 	{
	 		$magnitude = intval($lapse / $DAY);
	 		if($magnitude == 1) $publish_case = 5;
	 		else $publish_case = 6;
	 	}
	 	elseif ($lapse < $MONTH)
	 	{
	 		$magnitude = intval($lapse / $WEEK);
	 		if($magnitude == 1) $publish_case = 7;
	 		else $publish_case = 8;
	 	}
	 	elseif ($lapse < $YEAR)
	 	{
	 		$magnitude = intval($lapse / $MONTH);
	 		if($magnitude == 1) $publish_case = 9;
	 		else $publish_case = 10;
	 	}
	 	else
	 	{
	 		$magnitude = intval($lapse / $YEAR);
	 		if($magnitude == 1) $publish_case = 11;
	 		else $publish_case = 12;
	 	}

	 	switch ($publish_case) {
	 		case 0:
		        $published_on = "a few seconds ago";
		        break;
		    case 1:
		        $published_on = "a minute ago";
		        break;
		    case 2:
		        $published_on = $magnitude." minutes ago";
		        break;
		    case 3:
		        $published_on = "an hour ago";
		        break;
		    case 4:
		        $published_on = $magnitude." hours ago";
		        break;
		    case 5:
		        $published_on = "1 day ago";
		        break;
		    case 6:
		        $published_on = $magnitude." days ago";
		        break;
		    case 7:
		        $published_on = "1 week ago";
		        break;
		    case 8:
		        $published_on = $magnitude." weeks ago";
		        break;
		    case 9:
		        $published_on = "1 month ago";
		        break;
		    case 10:
		        $published_on = $magnitude." months ago";
		        break;
		    case 11:
		        $published_on = "1 year ago";
		        break;
		    case 12:
		        $published_on = $magnitude." years ago";
		        break;
		}

		return $published_on;
	 }
	 /*
	 *  Get post categories (as array) by Post ID
	 */
	 public static function getPostCategories($post_id)
	 {
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
	 	$categories = $PostDAO->getPostCategories($post_id);
	 	return $categories;
	 }
	 /*
	 *  Check if upvoted by Post Id
	 */
	 public static function checkIfUpvotedByUserId($post_id)
	 {
	 	$PostDAO = DAOFactory::getDAO('Post','Post_DAO.log');
	 	$user_upvote = $PostDAO->checkIfUpvotedByUserId($post_id);
	 	if(empty($user_upvote)) return 0;
	 	else return $user_upvote;
	 }

}







