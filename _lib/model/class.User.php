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
 * File : /_lib/model/class.User.php
 * Description : Class to define user parameters
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Jan 29 2014 20:04:33 GMT+0530 (IST)
 */

class User(){
	/**
	 * @var int   Unique ID of the user 
	 */
	var $id;
	/**
	 * @var varchar   User full name 
	 */
	var $full_name;
	/**
	 * @var varchar   Hash of the owner password 
	 */
	var $pwd;
	/**
	 * @var varchar   Salt for securely hashing the owner password 
	 */
	var $pwd_salt;
	/**
	 * @var varchar   User email 
	 */
	var $email;
	/**
	 * @var timestamp   Date-time user registered for an account 
	 */
	var $joined;
	/**
	 * @var datetime   Last time user logged in 
	 */
	var $last_login;
	/**
	 * @var varchar   Password reset token 
	 */
	var $pwd_token;
	/**
	 * @var int   Number of unique users who upvoted this user’s work 
	 */
	var $admirers_count;
	/**
	 * @var int   Number of total upvotes from all posts by this user 
	 */
	var $total_upvotes_count;
	/**
	 * @var int   Number of total posts made by this user 
	 */
	var $posts_count;

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	$this->id = $row['id'];
			$this->full_name = $row['full_name'];
			$this->pwd = $row['pwd'];
			$this->pwd_salt = $row['pwd_salt'];
			$this->email = $row['email'];
			$this->joined = $row['joined'];
			$this->last_login = $row['last_login'];
			$this->pwd_token = $row['pwd_token'];
			$this->admirers_count = $row['admirers_count'];
			$this->total_upvotes_count = $row['total_upvotes_count'];
			$this->posts_count = $row['posts_count'];
        }
    }
}