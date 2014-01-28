<?php
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
 * File : _lib/controller/class.InscribeController.php
 * Description : Parent Class for all Inscribe Webapp controllers
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in>
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 22:09:06 GMT+0530 (India Standard Time)
 */
abstract class InscribeController {
    /**
     * @var ViewManager
     */
    protected $view_mgr;
    /**
     * @var string Smarty template filename
     */
    protected $view_template = null;
    /**
     *
     * @var string cache key separator
     */
    const KEY_SEPARATOR='-';
    /**
     *
     * @var bool
     */
    protected $header_scripts = array ();
    /**
     *
     * @var araray
     */
    protected $header_css = array ();
    /**
     *
     * @var array
     */
    protected $json_data = null;
    /**
     * For testing
     * @var str
     */
    public $redirect_destination;
	/**
     * For Breadcrumb trailgeneration
     * @var str
     */
    public $caller_file_path = null;
    /**
     *
     * @var str
     */
    protected $content_type = 'text/html; charset=UTF-8'; //default
    /**
    *
    * @var boolean if true we will pass a CSRF token to the view
    */
    protected $view_csrf_token = false; //default

    /**
     * Constructs MoneycareController
     *
     *  Adds details address of currently logged in user, '' if not logged in, to view
     *  {$logged_in_user}
     *  @return MoneycareController
     */
    public function __construct($caller_file_path=null) {
        try {
			if(!is_null($caller_file_path)) $this->caller_file_path=$caller_file_path;
            $this->view_mgr = new ViewManager();
			//Add ADMIN_ROOT to view
			$this->addToView('INSCRIBE_WEBAPP_ROOT', INSCRIBE_WEBAPP_ROOT);
	
        } catch (Exception $e) {
            Loader::definePathConstants();
            //echo 'sending this to Smarty:'.ADMIN_ROOT.'/data/';
            $cfg_array =  array(
            'site_root_path'=>INSCRIBE_ROOT_PATH,
            'source_root_path'=>INSCRIBE_ROOT_PATH,
            'datadir_path'=>INSCRIBE_ROOT_PATH.'/data/',
            'debug'=>false,
            'app_title_prefix'=>"",
            'cache_pages'=>false);
            $this->view_mgr = new ViewManager($cfg_array);
        }
    }

    /**
     * Handle request parameters for a particular resource and return view markup.
     *
     * @return str Markup which renders controller results.
     */
    abstract public function control();

    /**
     * Returns whether or not user is logged in
     *
     * @return bool whether or not user is logged in
     */
    protected function isLoggedIn() {
        return Session::isLoggedIn();
    }

    /**
     * Returns whether or not a logged-in user is an admin
     *
     * @return bool whether or not logged-in user is an admin
     */
    protected function isAdmin() {
        return Session::isAdmin();
    }

    /**
     * Return email address of logged-in user
     *
     * @return str email
     */
    protected function getLoggedInUser() {
        return Session::getLoggedInUser();
    }

    /**
     * Returns cache key as a string,
     * Preface every key with .ht to make resulting file "forbidden" by request thanks to Apache's default rule
     * <FilesMatch "^\.([Hh][Tt])">
     *    Order allow,deny
     *    Deny from all
     *    Satisfy All
     * </FilesMatch>
     *
     * Set to public for the sake of tests only.
     * @return str cache key
     */
    public function getCacheKeyString() {
        $view_cache_key = array();
        if ($this->getLoggedInUser()) {
            array_push($view_cache_key, $this->getLoggedInuser());
        }
        $keys = array_keys($_GET);
        foreach ($keys as $key) {
            array_push($view_cache_key, $_GET[$key]);
        }
        return '.ht'.$this->view_template.self::KEY_SEPARATOR.(implode($view_cache_key, self::KEY_SEPARATOR));
    }

    /**
     * Generates web page markup
     *
     * @return str view markup
     */
    protected function generateView() {
        // add header javascript if defined
        if ( count($this->header_scripts) > 0) {
            $this->addToView('header_scripts', $this->header_scripts);
        }
        // add header CSS if defined
        if ( count($this->header_css) > 0) {
            $this->addToView('header_css', $this->header_css);
        }
        // add CSRF token if enabled and defined
        if ($this->view_csrf_token) {
            $csrf_token = Session::getCSRFToken();
            if (isset($csrf_token)) { $this->addToView('csrf_token', $csrf_token); }
        }

        $this->sendHeader();
        if (isset($this->view_template)) {
			return $this->view_mgr->fetch($this->view_template);
        } else if (isset($this->json_data) ) {
            $this->setContentType('application/json');
            if ($this->view_mgr->isViewCached()) {
                if ($this->view_mgr->is_cached('json.tpl', $this->getCacheKeyString())) {
                    return $this->view_mgr->fetch('json.tpl', $this->getCacheKeyString());
                } else {
                    $this->prepareJSON();
                    return $this->view_mgr->fetch('json.tpl', $this->getCacheKeyString());
                }
            } else {
                $this->prepareJSON();
                return $this->view_mgr->fetch('json.tpl');
            }
        } else {
            throw new Exception(get_class($this).': No view template specified');
        }
    }

    /**
     * Prepares the JSON data in $this->json_data and adds it to the current view under the key "json".
     *
     * @param bool $indent Whether or not to indent the JSON string. Defaults to true.
     * @param bool $stripslashes Whether or not to strip escaped slashes. Default to true.
     * @param bool $convert_numeric_strings Whether or not to convert numeric strings to numbers. Defaults to true.
     */
    private function prepareJSON($indent = true, $stripslashes = true, $convert_numeric_strings = true) {
        if (isset($this->json_data)) {
            $json = json_encode($this->json_data);
            if ($stripslashes) {
                // strip escaped forwardslashes
                $json = preg_replace("/\\\\\//", '/', $json);
            }
            if ($convert_numeric_strings) {
                // converts numeric strings to numbers
                $json = Utils::convertNumericStrings($json);
            }
            if ($indent) {
                // indents JSON strings so they are human readable
                $json = Utils::indentJSON($json);
            }
            $this->addToView('json', $json);
        }
    }

    /**
     * Send Content-Type header
     */
    protected function sendHeader() {
        if ( !headers_sent() ) { // suppress 'headers already sent' error while testing
            header('Content-Type: ' . $this->content_type, true);
        }
    }

    /**
     * Send Location header
     * @param str $destination
     * @return bool Whether or not redirect header was sent
     */
    protected function redirect($destination=null) {
        if (!isset($destination)) {
            $destination = ADMIN_ROOT;
        }
        $this->redirect_destination = $destination; //for validation
        if ( !headers_sent() ) {
            header('Location: '.$destination);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the view template filename
     *
     * @param str $tpl_filename
     */
    protected function setViewTemplate($tpl_filename) {
		$this->view_template = $tpl_filename;
    }

    /**
     * Sets json data structure to output a json string, and sets Content-Type to appplication/json
     *
     * @param array json data
     */
    protected function setJsonData($data) {
        if ($data != null) {
            $this->setContentType('application/json');
        }

        $this->json_data = $data;
    }

    /**
     * Sets Content Type header
     *
     * @param string Content Type
     */
    protected function setContentType($content_type) {
        if ($content_type != 'image/png') {
            $this->content_type = $content_type.'; charset=UTF-8';
        } else {
            $this->content_type = $content_type;
        }
    }

    /**
     * Gets Content Type header
     *
     * @return string Content Type
     */
    public function getContentType() {
        return $this->content_type;
    }

    /**
     * Add javascript to header
     *
     * @param str javascript path
     */
    public function addHeaderJavaScript($script) {
        array_push($this->header_scripts, $script);
    }
    /**
     * Add CSS to header
     *
     * @param str CSS path
     */
    public function addHeaderCSS($css) {
        array_push($this->header_css, $css);
    }
    /**
     * get CSS scripts
     *
     * @return array List of CSS files
     */
    public function getHeaderCSS() {
        return $this->header_css;
    }

    /**
     * Add data to view template engine for rendering
     *
     * @param str $key
     * @param mixed $value
     */
    protected function addToView($key, $value) {
        $this->view_mgr->assign($key, $value);
    }

    /**
     * Invoke the controller
     *
     * Always use this method, not control(), to invoke the controller.
     * @TODO show get 500 error template on Exception
     * (if debugging is true, pass the exception details to the 500 template)
     */
    public function go() {
        try {
            $this->initalizeApp();
			$classname = get_class($this);
            return $this->control();        
        } catch (Exception $e) {
            $this->setErrorTemplateState();
            $this->addToView('error_type', get_class($e));
			$message = 'You need to log in.';
            $this->addErrorMessage($message, null, true);
            return $this->generateView();
        } 
    }

    /**
     * set proper error message and template
     */
    private function setErrorTemplateState() {
        $content_type = $this->content_type;
        if (strpos($content_type, ';') !== false) {
            $exploded = explode(';', $content_type);
            $content_type = array_shift($exploded);
        }
        switch ($content_type) {
            case 'application/json':
                $this->setViewTemplate('500.json.tpl');
                break;
            case 'text/plain':
                $this->setViewTemplate('500.txt.tpl');
                break;
            default:
                $this->setViewTemplate('500.tpl');
        }
    }
    /**
     * Initalize app
     * Load config file and required plugins
     * @throws Exception
     */
    private function initalizeApp() {
        $classname = get_class($this);
        
		ini_set("display_errors", 1);
		ini_set("error_reporting", E_STRICT);
	
        
    }

    /**
     * Provided for tests only, to assert that proper view values have been set. (Debug must be equal to true.)
     * @return ViewManager
     */
    public function getViewManager() {
        return $this->view_mgr;
    }

    /**
     * Turn off caching
     * Provided in case an individual controller wants to override the application-wide setting.
     */
    protected function disableCaching() {
        $this->view_mgr->disableCaching();
    }

    /**
     * Check if cache needs refreshing
     * @return bool
     */
    protected function shouldRefreshCache() {
        if ($this->view_mgr->isViewCached()) {
            return !$this->view_mgr->is_cached($this->view_template, $this->getCacheKeyString());
        } else {
            return true;
        }
    }

    /**
     * Set web page title
     * This method only works for views that reference _header.tpl.
     * @param str $title
     */
    public function setPageTitle($title) {
        $this->addToView('controller_title', $title);
    }

    /**
     * Add error message to view.
     * Include field if the message goes on a specific place on the page; otherwise leave it null for the message
     * to be page-level.
     * @param str $msg
     * @param str $field Defaults to null for page-level messages.
     * @param bool $disable_xss Disable HTML encoding tags, defaults to false
     */
    public function addErrorMessage($msg, $field=null, $disable_xss=false) {
        $this->disableCaching();
        $this->view_mgr->addErrorMessage($msg, $field, $disable_xss);
    }

    /**
     * Add success message to view
     * Include field if the message goes on a specific place on the page; otherwise leave it null for the message
     * to be page-level.
     * @param str $msg
     * @param str $field Defaults to null for page-level messages.
     * @param bool $disable_xss Disable HTML encoding tags, defaults to false
     */
    public function addSuccessMessage($msg, $field=null, $disable_xss=false) {
        $this->disableCaching();
        $this->view_mgr->addSuccessMessage($msg, $field, $disable_xss);
    }

    /**
     * Add informational message to view
     * Include field if the message goes on a specific place on the page; otherwise leave it null for the message
     * to be page-level.
     * @param str $msg
     * @param str $field Defaults to null for page-level messages.
     * @param bool $disable_xss Disable HTML encoding tags, defaults to false
     */
    public function addInfoMessage($msg, $field=null, $disable_xss=false) {
        $this->disableCaching();
        $this->view_mgr->addInfoMessage($msg, $field, $disable_xss);
    }

    /**
     * Will enable a CSRF token in the view
     */
    public function enableCSRFToken() {
        $this->view_csrf_token = true;
    }

    /**
     * Get the view CSRF token enabled status
     */
    public function isEnableCSRFToken() {
        return $this->view_csrf_token;
    }

    /**
     * Validate the CSRF token passed in the request data.
     * @throws invalid InvalidCSRFTokenException
     * @return bool True if $_POST['csrf_token'] or $_GET['csrf_token'] is valid
     */
    public function validateCSRFToken() {
        $token = 'no token passed';
        if (isset($_POST['csrf_token'])) {
            $token = $_POST['csrf_token'];
        } else if (isset($_GET['csrf_token'])) {
            $token = $_GET['csrf_token'];
        }
        $session_token = Session::getCSRFToken();
        if ($session_token && $session_token == $token) {
            return true;
        } else {
            throw new InvalidCSRFTokenException($token);
        }
    }
}
