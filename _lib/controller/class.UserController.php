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
 * File : class.UserController.php
 * Description : Controller for User
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 17:45:35 GMT+0530 (IST)
 */
class UserController extends InscribeController {
	/*
	 * Main Control of the class
	 */
	public function control()
	 {
		 //Redirect to login.php if not logged in
		 if(!$this->isLoggedIn()) return $this->redirect('./login/');
		 
		$this->disableCaching();
		$this->view_mgr->force_compile = true;

		// get DAO
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');

		if(isset($_GET['a'])) {
			if($_GET['a']=='add') {
				if(empty($_POST)) return false;
				return $this->createNewUser();
			}
			if($_GET['a']=='signup') {
					$this->setViewTemplate('_user.signup.tpl');
					return $this->generateView();
			}
		}
		$this->setViewTemplate('User.tpl');
        return $this->generateView();

	 }
	 /*
	 *  Create a New User
	 */
	 public function createNewUser()
	 {	
		$user = new User($_POST);
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		return $UserDAO->insert($user);
		
	 }
}