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
 * File : ./_lib/class.Loader.php
 * Description : Implements Lazy Loading
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 18:22:11 GMT+0530 (India Standard Time)
 */
class Loader
{
	/**
     * Lookup paths for classes and interfaces
     * @var array
     */
    private static $lookup_path;

    /**
     * Classes whose filename doesn't follow the convention
     * @var array
     */
    private static $special_classes = array();

    /**
     * Register
     *
     * Registers the autoloader to enable lazy loading
     *
     * @param array $paths Array of additional lookup path strings
     * @return bool
     */
    public static function register(Array $paths=null) {
        self::setLookupPath($paths);
        return spl_autoload_register(array(__CLASS__, "load"));
    }
	 /**
     * Unregister
     *
     * Unregisters the autoloader script, disabling lazy loading
     *
     * @return bool
     */
    public static function unregister() {
        self::$lookup_path = null;
        self::$special_classes = null;
        return spl_autoload_unregister(array(__CLASS__, "load"));
    }
	 /**
     * Set Lookup Path
     *
     * Establishes lookup paths, including additional paths if provided
     *
     * @param array $paths Array of additional lookup path strings
     */
    private static function setLookupPath(Array $paths = null) {
        self::definePathConstants();

        // set default lookup paths
        self::$lookup_path = array(
        INSCRIBE_ROOT_PATH . "_lib/",
        INSCRIBE_ROOT_PATH . "_lib/model/",
        INSCRIBE_ROOT_PATH . "_lib/dao/",
        INSCRIBE_ROOT_PATH . "_lib/controller/",
        INSCRIBE_ROOT_PATH . "_lib/exceptions/"
        );

        // set default lookup path for special classes
        self::$special_classes ["Smarty"] = INSCRIBE_WEBAPP_ROOT . "_lib/extlib/Smarty-2.6.26/libs/Smarty.class.php";

        if (isset($paths)) {
            foreach($paths as $path) {
                self::$lookup_path[] = $path;
            }
        }
    }
	
	 /**
     * Define application path constants 
     */
    public static function definePathConstants() {
        if ( !defined('INSCRIBE_ROOT_PATH') ) {
            $local_path = str_replace('\\','/',dirname(dirname(__FILE__)));
			
			
			
			define('INSCRIBE_ROOT_PATH',$local_path.'/');
        }
    }
	
	 /**
     * Add Path
     *
     * Adds another path to crawl for class files
     *
     * @param string $path
     */
    public static function addPath($path) {
        if (!isset(self::$lookup_path)) self::register();
        self::$lookup_path[] = $path;
    }

    /**
     * Get Lookup Path
     *
     * Gets the array of lookup paths
     *
     * @return array
     */
    public static function getLookupPath() {
        return self::$lookup_path;
    }

    /**
     * Get Special Classes
     *
     * Gets the array of special class paths
     *
     * @return array
     */
    public static function getSpecialClasses() {
        return self::$special_classes;
    }

    /**
     * Add Special Classe
     *
     * Add special class information for loading
     *
     * @param str $class_name
     * @param str $path
     */
    public static function addSpecialClass($class_name, $path) {
        self::definePathConstants();
        self::$special_classes[$class_name] = ADMIN_ROOT_PATH.$path;
        require_once(ADMIN_ROOT_PATH.$path);
    }

    /**
     * Load
     *
     * The method registered to run on _autoload. When a class is instantiated, this
     * method will be called to look up the class file if the class is not present.
     * The second instantiation of the same class wouldn't call this method.
     *
     * @param string $class
     * @param bool
     */
    public static function load($class) {
        // check if class is already in scope
        if (class_exists($class, false)) return;
		// if class is a standard ThinkUp object or interface
        foreach (self::$lookup_path as $path) {
            $filename = $path . "class." . $class . ".php";
            if (file_exists($filename)) {
                require_once($filename);
                return;
            }

            $filename = $path . "interface." . $class . ".php";
            if (file_exists($filename)) {
                require_once($filename);
                return;
            }

            $filename = $path . $class . ".php";
            if (file_exists($filename)) {
                require_once($filename);
                return;
            }
        }
        // if class is a special class
        if (array_key_exists($class, self::$special_classes)) {
            require_once(self::$special_classes[$class]);
            return;
        }
		echo 'Failed to find file';
    }
	
}

?>
