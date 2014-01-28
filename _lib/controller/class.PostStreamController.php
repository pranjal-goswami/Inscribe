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
 * File : _lib/controller/class.PostStreamController.php
 * Description : Controller For Post stream
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in>
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 22:09:06 GMT+0530 (India Standard Time)
 */

class PostStreamController extends InscribeController{
	
	public function control()
	{
		$this->setViewTemplate('post-stream.tpl');
		return $this->generateView();
	}
}
?>