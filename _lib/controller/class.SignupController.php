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
			if($_GET['a']=='signup') {
				if(empty($_POST)) return false;
				return $this->createNewUser();
			}
		}


		$this->setViewTemplate('user.signup.tpl');
		$this->addHeaderJavaScript('assets/js/validation.js');
		return $this->generateView();

	}
	/*
	*  Create a New User
	*/
	public function createNewUser()
	{	
		$user = new User($_POST);
		if($user->validateUser()) {
			$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
			
			if($UserDAO->userAlreadyExists($user)) {
				$this->json_data = array(
					"status" => ERROR_CODE,
					"message"=> "The email ID <strong>".$user->email."</strong> is already registered.
						<a href=\"#\">Trouble loggin in?</a>"
				);
				return $this->generateView();
			}
			
			$user->pwd_salt = User::generatePwdSalt();
			$user->pwd = User::getHashedPwd($user->pwd,$user->pwd_salt);
			$UserDAO->insert($user);
			
			$this->json_data = array(
					"status" => SUCCESS_CODE,
					"message"=> "Your account was successfully created. 
						Please check your email and follow the instructions to activate your account
						and <a href=\"../login/\"><strong>Log in</strong></a>"
				);
		}
		else {
			$this->json_data = array(
					"status" => INFO_CODE,
					"message"=> "There is some problem with our servers right now. Please try later"
				);
		}
		return $this->generateView();
		
	}
	


}