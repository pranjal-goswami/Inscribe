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
 * File : /_lib/model/class.Upvote.php
 * Description : Model for Upvoting Posts
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Jan 29 2014 20:04:33 GMT+0530 (IST)
 */

 class Upvote(){
 	/**
	 * @var int   Internal Unique ID of upvote 
	 */
	var $id;
	/**
	 * @var int   ID of user who upvoted 
	 */
	var $user_id;
	/**
	 * @var int   ID of the post upvoted 
	 */
	var $post_id;
	/**
	 * @var int   Vote type (upvoted=1) 
	 */
	var $vote;
	/**
	 * @var timestamp   Time of the upvote 
	 */
	var $time;

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	$this->id = $row['id'];
			$this->user_id = $row['user_id'];
			$this->post_id = $row['post_id'];
			$this->vote = $row['vote'];
			$this->time = $row['time'];
        }
    }
 }