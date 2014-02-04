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
 * File : user/index.php
 * Description : Users Page
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Sun Feb 02 2014 17:45:35 GMT+0530 (IST)
 */
<<<<<<< HEAD
include('../_lib/init.php');
=======
require_once('../_lib/init.php');
>>>>>>> 564da2725adbc24a96d42bdafcef4d7ba0927260
$controller = new UserController(__FILE__);
echo $controller->go();