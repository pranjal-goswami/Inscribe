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
			$this->addToView('user',SessionCache::get('user'));
			}
		$posts = $this->streamAllPublishedPosts();
		$this->setViewTemplate('post-stream.tpl');
		$this->addToView('posts',$posts);
		return $this->generateView();
	}
	/*
	 *  Add a new post
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
			$post->published_on = $this->convertToDisplayPublishTime($post->publish_time);
		}
		return $posts;
	}
	/*
	 *  Convert Publish timestamp to 'Published on' for display
	 */
	 public function convertToDisplayPublishTime($time)
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

}
?>