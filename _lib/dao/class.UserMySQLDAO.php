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
 * File : class.UserMySQLPDO.php
 * Description : DAO for Users
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sat Feb 01 2014 17:17:25 GMT+0530 (IST)
 */
 class UserMySQLDAO extends PDODAO{

 	/*
	 * Get User by User ID
	 */
	public function getUserByUserId($id=null)
	{
		if(is_null($id)){
			$this->logger->logError('No User ID provided.','Input Error');
			return false;
		}
		$q = "SELECT * FROM in_users WHERE id=:id";
		$vars = array(
			":id"=>(int)$id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowAsObject($ps,'User');
		return $result;
	}
	/*
	 * Get User by Post ID
	 */
	public function getUserByPostId($id=null)
	{
		if(is_null($id)){
			$this->logger->logError('No Post ID provided.','Input Error');
			return false;
		}
		$q = "SELECT in_users.* FROM in_users INNER JOIN in_posts ";
		$q.= "ON in_users.id=in_posts.author_id "; 
		$q.="WHERE in_posts.id=:id";
		$vars = array(
			":id"=>(int)$id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowAsObject($ps,'User');
		return $result;
	}
	/*
	 * Get Hash of Password of the User
	 */
	public function getPwdHash($pwd = null,$pwd_salt = null)
	{
		if(!$pwd || !$pwd_salt) return false;
		return md5($pwd.md5($pwd_salt));
	}
	/*
	 * Insert a User
	 */
	public function insertUser(User $user)
	{
		$q = "INSERT INTO in_users";
		$q .= "(full_name, pwd, pwd_salt, email, last_login, admirers_count, total_upvotes_count, posts_count) ";
		$q .= "VALUES (:full_name, :pwd, :pwd_salt, :email, :last_login, :admirers_count, :total_upvotes_count, :posts_count)";
		$vars = array(
			':full_name'=>$profile->full_name,
			':pwd'=>$profile->pwd,
			':pwd_salt'=>$profile->pwd_salt,
			':email'=>$profile->email,
			':last_login'=>$profile->last_login,
			':admirers_count'=>$profile->admirers_count,
			':total_upvotes_count'=>$profile->total_upvotes_count,
			':posts_count'=>$profile->posts_count
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
        return $this->getInsertId($ps);
	}



 }