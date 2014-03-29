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
		$this->addToView('isLoggedIn',true);
		$this->addToView('user',Session::getLoggedInUser());

		$this->setViewTemplate('user.profile.tpl');
        return $this->generateView();

	 }

}