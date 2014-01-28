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
 * File : ./_lib/model/class.Post.php
 * Description : Model for Post
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 18:22:11 GMT+0530 (India Standard Time)
 */
 
class Post{
	/**
	 * @var title of the post
	 */
	var $title;
	
	public function getTitle()
	{
		return $this->title;
	}
	
}
?>