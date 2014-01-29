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
	 * @var int id 	Unique Profile ID 
	 */
	var $id;
	/**
	 * @var varchar full_name 	User Full Name 
	 */
	var $full_name;
	/**
	 * @var varchar pwd 	Hash of the owner password
	 */
	var $pwd;
	/**
	 * @var varchar pwd_salt 	Salt for securely hashing the owner password	
	 */
	var $pwd_salt;
	/**
	 * @var varchar email 	User email
	 */
	var $email;
	/**
	 * @var timestamp joined 	Date-time user registered for an account
	 */
	var $joined;
	/**
	 * @var datetime last_login 	Last time user logged in
	 */
	var $last_login;
	/**
	 * @var varchar pwd_token 	Password reset token
	 */
	var $pwd_token;
	/**
	 * @var int admirers_count 	Number of unique users who upvoted this user’s work
	 */
	var $admirers_count;
	/**
	 * @var int total_upvotes_count	 Number of total upvotes from all posts by this user
	 */
	var $total_upvotes_count;
	/**
	 * @var int posts_count 	Number of total posts made by this user
	 */
	var $posts_count

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	
        }
    }
}