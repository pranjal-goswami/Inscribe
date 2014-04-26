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
		 
		$this->disableCaching();
		$this->view_mgr->force_compile = true;

		// Options that do not require Logging in		
		if(isset($_GET['a'])) {

			if($_GET['a']=='sprofile') {
					if(!isset($_GET['uid'])) return $this->redirect('./');
					$this->setViewTemplate('user.profile.show.tpl');
					$PostStream = new PostStreamController();
					$user_id = Utils::decryptId($_GET['uid']);
					$posts = $PostStream->streamAllPublishedPostsByUserId($user_id);
					$this->addToView('posts',$posts);
					$this->addToView('tpl','_user.published-stream.tpl');
					$UserDAO = DAOFactory::getDAO('User','User_DAO.log');
					$user = $UserDAO->getUserByUserId($user_id);
					$this->addToView('suser', $user);
					if($this->isLoggedIn()) 
					{
						$this->addToView('isLoggedIn',true);
						$this->addToView('user',Session::getLoggedInUser());
					}
			        return $this->generateView();
			}
		}

		//Redirect to login.php if not logged in
		 if(!$this->isLoggedIn()) return $this->redirect('./login/');

		// Options that require Logging in		
		if(isset($_GET['a'])) {

			if($_GET['a']=='create') {
					$this->setViewTemplate('user.profile.tpl');
					$this->addToView('user',Session::getLoggedInUser());
					$this->addToView('tpl','post.create.tpl');
					if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
					$postController = new PostController();
					$content_id = $postController->createNewPost();
					$this->addToView('content_id',$content_id);
					return $this->generateView();
			}
		}

		$this->setViewTemplate('user.profile.tpl');
		$PostStream = new PostStreamController();
		$posts = $PostStream->streamAllPublishedPostsByUserId();
		$this->addToView('user',Session::getLoggedInUser());
		$this->addToView('posts',$posts);
		$this->addToView('tpl','_user.published-stream.tpl');
		if($this->isLoggedIn()) $this->addToView('isLoggedIn',true);
        return $this->generateView();

	 }

}