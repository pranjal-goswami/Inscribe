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
 * File : class.SignupController.php
 * Description : Controller for Signup
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 17:45:35 GMT+0530 (IST)
 */
class SignupController extends InscribeController {
	/*
	* Main control of the class
	*/
	public function control()
	{
		$this->disableCaching();
		$this->view_mgr->force_compile = true;

		//Redirect to User Home if logged in
		if($this->isLoggedIn()) return $this->redirect('../');

		if(isset($_GET['a'])) {
			if($_GET['a']=='add') {
				if(empty($_POST)) return false;
				return $this->createNewUser();
			}
		}
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		$this->setViewTemplate('_user.signup.tpl');
		return $this->generateView();

	}
	/*
	*  Create a New User
	*/
	public function createNewUser()
	{	
		$user = new User($_POST);
		$user->pwd=md5($user->pwd);
		$user->pwd_salt=User::generatePwdSalt();
		$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
		return $UserDAO->insert($user);
		
	}


}