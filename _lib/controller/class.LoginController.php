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
 * File : _lib/controller/class.LoginController.php
 * Description : Implement Uer Login Controller
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 20:35:13 GMT+0530 (India Standard Time)
 */
 
class LoginController extends InscribeController {
	public function control()
	{
		$this->disableCaching();
		$this->view_mgr->force_compile = true;
		
		if(isset($_GET['a']))
		{
			if($_GET['a']=='login')
			{
				return $this->loginUser();
			}
		}
		$this->setViewTemplate('user.login.tpl');
		
		return $this->generateView();
	}
	protected function loginUser()
	{
		$UserDAO = DAOFactory::getDAO("User","User_DAO.log");
		$user = $UserDAO->getUserByUserEmail($_POST['user_email']);
		if(is_null($user)){
			$this->json_data = array(
				"status" => "error",
				"message" => "The email ID <strong>".$_POST['user_email']."</strong> does not exist in our records."
			);
			return $this->generateView();	
		}
		
		if($user->pwd == User::getHashedPwd($_POST['user_pwd'],$user->pwd_salt)) {
			SessionCache::put(S_STATUS,S_STATUS_ACTIVE);
			$_SESSION['user']=$user;
			$this->json_data = array(
				"status" => "success",
				"message" => 'Logged In. Redirecting...'
			);
			return $this->generateView();
			}
		$this->json_data = array(
			"status" => "error",
			"message" => "The password entered is incorrect"
		);
		return $this->generateView();
	}
}