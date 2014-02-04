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
		$this->setViewTemplate('user.login.tpl');
		$this->disableCaching();
		$this->view_mgr->force_compile = true;
		
		return $this->generateView();
	}
}