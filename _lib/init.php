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
 * File : /init.php
 * Description : Global App Init
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 18:01:05 GMT+0530 (India Standard Time)
 */
 
$local_path = str_replace('\\','/',dirname(dirname(__FILE__)));
$needle = 'htdocs';
if(strpos($local_path,$needle)>=0){ 
	define('SERVER','localhost'); 
	$app_path = substr($local_path,(strpos($local_path,$needle)+strlen($needle)));
}
else{
	define('SERVER','web');
	$app_path = '';
}
define('INSCRIBE_WEBAPP_ROOT',$app_path);

require_once('app.config.php');
require_once('class.Loader.php');

Loader::register();

?>