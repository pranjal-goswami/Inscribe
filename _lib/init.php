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
 
date_default_timezone_set('Asia/Calcutta');
session_start();
 
$local_path = str_replace('\\','/',dirname(dirname(__FILE__)));
echo $local_path;
if(strpos($local_path,$needle)>=0){ 
	define('SERVER','localhost'); 
	$needle = 'htdocs';
	$app_path = substr($local_path,(strpos($local_path,$needle)+strlen($needle)));
}
else{
	define('SERVER','web');
	$needle = 'public_html';
	$app_path = substr($local_path,(strpos($local_path,$needle)+strlen($needle)));
}
define('INSCRIBE_WEBAPP_ROOT',$app_path);

require_once('app.config.php');
require_once('class.Loader.php');

Loader::register();

?>