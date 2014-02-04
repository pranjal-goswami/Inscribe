<?

/*Session variable handles*/
// Added #in_# prefix to avoid conflict with parallel projects 
define('S_STATUS','in_session_status');
define('S_STATUS_ACTIVE','in_active');
define('S_ADMIN_NAME','in_admin_name');
define('S_ADMIN_FAIL','in_admin_login_failed');
define('S_OWNER','owner');
/* Database Connection Credentials */
if(SERVER=='localhost'){
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PWD','regiate');
	define('DB_NAME','inscribe');
}

?>