<?

/*Session variable handles*/

define('S_STATUS','session_status');
define('S_STATUS_ACTIVE','active');
define('S_ADMIN_NAME','admin_name');
define('S_ADMIN_FAIL','admin_login_failed');
define('S_OWNER','owner');
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
		define('DB_PWD','');
		define('DB_NAME','inscribe');
	}}

?>