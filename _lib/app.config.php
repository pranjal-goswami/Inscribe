<?

/*Session variable handles*/
//added #in_# prefix to resolve parallel project conflicts
define('S_STATUS','in_session_status');
define('S_STATUS_ACTIVE','in_active');
define('S_ADMIN_NAME','in_admin_name');
define('S_ADMIN_FAIL','in_admin_login_failed');
define('S_USER','in_user');

define('ERROR_CODE','error');
define('SUCCESS_CODE','success');
define('INFO_CODE','info');

/* Database Connection Credentials */
if(SERVER=='localhost'){
$path = dirname(__FILE__).'/';
	if(file_exists($path.'../../pranjal'))
	{
		define('DB_SERVER','localhost');
		define('DB_USER','root');
		define('DB_PWD','regiate');
		define('DB_NAME','inscribe');
	}
	else if(file_exists($path.'../../naman'))
	{	
		define('DB_SERVER','localhost');
		define('DB_USER','root');
		define('DB_PWD','spades');
		define('DB_NAME','inscribe');
	}
	else
	{ 	//default values
		define('DB_SERVER','localhost');
		define('DB_USER','root');
		define('DB_PWD','ali~cia33');
		define('DB_NAME','greektur_inscribe');
	}
}
else if(SERVER=="web")
{
		define('DB_SERVER','localhost');
		define('DB_USER','greektur_root');
		define('DB_PWD','ali~cia33');
		define('DB_NAME','greektur_inscribe');
}
?>