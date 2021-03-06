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
 * File : /_lib/class.Session.php
 * Description : Session Manager
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 21:53:23 GMT+0530 (India Standard Time)
 */
class Session{
	
	public static function isLoggedIn()
	{
		/*return true iff session is active*/
		if(isset($_SESSION[S_STATUS]) && $_SESSION[S_STATUS]==S_STATUS_ACTIVE) return true;
		else return false;
	}
	
	public static function isAdmin()
	{
		/*return true iff session owner is admin */
		if(isset($_SESSION[S_ADMIN])) return true;
		else return false;
	}
		
	public static function getLoggedInUser()
	{
		if(!self::isLoggedIn()) {
			Logger::getInstance()->LogError("No user logged in. Cannot return logged in User");
		}
		$user = Utils::fixObject(SessionCache::get(S_USER));
		$joined = strtotime($user->joined);
		$user->joined_f ='someything';// date('Y',$joined)	;	
		return Utils::fixObject(SessionCache::get(S_USER));
	}
	
}
?>