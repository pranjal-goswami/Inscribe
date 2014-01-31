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
		$q = "SELECT * FROM in_posts WHERE category LIKE '%,:category_id,%'";
		$vars = array(
			":category_id"=>(int)$category_id
		);
		$ps = $this->execute($q,$vars);
		$result = $this->getDataRowsAsObjects($ps,'Post');
		return $result;
	}





	public function insert(Profile $profile)
	{
		$q = "INSERT INTO profiles";
		$q .= "(name, address, dob, height, weight, contact_no, mobile_no,";
		$q .= "email_id, password, profile_picture_path, occupation, nature_of_duties,"; 
		$q .= "annual_income, pan_number, office_address, office_contact, bank_name,";
		$q .= "account_number, father_name, father_dob, father_height, father_weight,";
		$q .= "mother_name, mother_dob, mother_height, mother_weight, spouse_name, spouse_dob,";
		$q .= "spouse_height, spouse_weight, child1_name, child1_dob, child1_height,";
		$q .= "child1_weight, child2_name, child2_dob, child2_height, child2_weight,";
		$q .= "child3_name, child3_dob, child3_height, child3_weight, aniversary_date) ";
		$q .= "VALUES (:name, :address, :dob, :height, :weight, :contact_no,";
		$q .= ":mobile_no, :email_id, :password, :profile_picture_path, :occupation,";
		$q .= ":nature_of_duties, :annual_income, :pan_number, :office_address, :office_contact,";
		$q .= ":bank_name, :account_number, :father_name, :father_dob, :father_height, :father_weight,";
		$q .= ":mother_name, :mother_dob, :mother_height, :mother_weight, :spouse_name,";
		$q .= ":spouse_dob, :spouse_height, :spouse_weight, :child1_name, :child1_dob,";
		$q .= ":child1_height, :child1_weight, :child2_name, :child2_dob, :child2_height,";
		$q .= ":child2_weight, :child3_name, :child3_dob, :child3_height, :child3_weight,";
		$q .= ":aniversary_date)";
		$vars = array(
			':name'=>$profile->name,
			':address'=>$profile->address,
			':dob'=>$profile->dob,
			':height'=>$profile->height,
			':weight'=>$profile->weight,
			':contact_no'=>$profile->contact_no,
			':mobile_no'=>$profile->mobile_no,
			':email_id'=>$profile->email_id,
			':password'=>$profile->password,
			':profile_picture_path'=>$profile->profile_picture_path,
			':occupation'=>$profile->occupation,
			':nature_of_duties'=>$profile->nature_of_duties,
			':annual_income'=>$profile->annual_income,
			':pan_number'=>$profile->pan_number,
			':office_address'=>$profile->office_address,
			':office_contact'=>$profile->office_contact,
			':bank_name'=>$profile->bank_name,
			':account_number'=>$profile->account_number,
			':father_name'=>$profile->father_name,
			':father_dob'=>$profile->father_dob,
			':father_height'=>$profile->father_height,
			':father_weight'=>$profile->father_weight,
			':mother_name'=>$profile->mother_name,
			':mother_dob'=>$profile->mother_dob,
			':mother_height'=>$profile->mother_height,
			':mother_weight'=>$profile->mother_weight,
			':spouse_name'=>$profile->spouse_name,
			':spouse_dob'=>$profile->spouse_dob,
			':spouse_height'=>$profile->spouse_height,
			':spouse_weight'=>$profile->spouse_weight,
			':child1_name'=>$profile->child1_name,
			':child1_dob'=>$profile->child1_dob,
			':child1_height'=>$profile->child1_height,
			':child1_weight'=>$profile->child1_weight,
			':child2_name'=>$profile->child2_name,
			':child2_dob'=>$profile->child2_dob,
			':child2_height'=>$profile->child2_height,
			':child2_weight'=>$profile->child2_weight,
			':child3_name'=>$profile->child3_name,
			':child3_dob'=>$profile->child3_dob,
			':child3_height'=>$profile->child3_height,
			':child3_weight'=>$profile->child3_weight,
			':aniversary_date'=>$profile->aniversary_date
		);
		//$this->logger->logInfo($q);
		$ps = $this->execute($q, $vars);
        return $this->getInsertId($ps);
	}

   
}