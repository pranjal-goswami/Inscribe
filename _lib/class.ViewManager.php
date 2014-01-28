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
 * File : /_lib/class.ViewManager.php
 * Description : View Manager - Implements Smarty
 *
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Jan 28 2014 21:53:23 GMT+0530 (India Standard Time)
 */
 class ViewManager extends Smarty {
    /**
     * @var boolean
     */
    private $debug = false;
    /**
     * @var array
     */
    private $template_data = array();
    /**
     * @var array
     */
    private $contextual_help = array();
    /**
     * @var array
     */
    private $error_msgs = array();
    /**
     * @var array
     */
    private $success_msgs = array();
    /**
     * @var array
     */
    private $info_msgs = array();
    /**
     * Success-type messages.
     * @var int
     */
    const SUCCESS_MESSAGE = 1;
    /**
     * Informational-type messages.
     * @var unknown_type
     */
    const INFO_MESSAGE = 2;
    /**
     * Error-type messages.
     * @var unknown_type
     */
    const ERROR_MESSAGE = 3;
    /**
     * Constructor
     *
     * Sets default values all view templates have access to:
     *
     *  <code>
     *  //path of the Moneycare Apanel 
     *  {$site_root_path}
     *  //application name
     *  {$app_title}
     *  </code>
     *  @param array $config_array Defaults to null; Override source_root_path, site_root_path, app_title, cache_pages,
     *  debug
     *
     */
    public function __construct($config_array=null) {

        Loader::definePathConstants();
		$src_root_path = INSCRIBE_ROOT_PATH.'/';
        $site_root_path = INSCRIBE_ROOT_PATH.'/';
        $app_title = 'Inscribe';
        $cache_pages = false;
        $cache_lifetime = 0;
        $debug =  false;
              
        $this->Smarty();
        $this->template_dir = array(INSCRIBE_ROOT_PATH.'/_lib/view');
        $this->compile_dir = INSCRIBE_ROOT_PATH.'/data/compiled_view';
        $this->plugins_dir = array('plugins', INSCRIBE_ROOT_PATH.'_lib/view/plugins/');
        $this->cache_dir = INSCRIBE_ROOT_PATH.'/data/cache';
        $this->compile_check = false;
        $this->caching = ($cache_pages)?1:0;
        $this->cache_lifetime = $cache_lifetime;
        $this->debug = $debug;

        $this->assign('app_title', $app_title);
        $this->assign('site_root_path', $site_root_path);
    }

    /**
     * Assigns data to a template variable.
     * If debug is true, stores it for access by tests or developer.
     * @param string $key
     * @param mixed $value
     */
    public function assign($key, $value = null) {
        parent::assign($key, $value);
        if ($this->debug) {
            $this->template_data[$key] = $value;
        }
    }

    /**
     * Assign contextual help to the template.
     * @param $key Unique help item key.
     * @param $link_slug Documentation page slug, ie, 'userguide/api/posts/index'
     */
    public function addHelp($id, $link_slug) {
        $this->contextual_help[$id] = $link_slug;
        $this->assign('help', $this->contextual_help);
    }

    /**
     * Add page-level or field-level error message to view.
     * To add a page-level message, leave $field null. To add a field-level message, specify $field name.
     * @param str $msg
     * @param str $field Defaults to null
     */
    public function addErrorMessage($msg, $field=null, $disable_xss=false) {
        $this->addMessage(self::ERROR_MESSAGE, $msg, $field);
        if ($disable_xss === true) {
            $this->disableXSSMessageFilter(self::ERROR_MESSAGE);
        }
    }

    /**
     * Disable XSS filtering for a message type
     * @param int $msg_type
     */
    public function disableXSSMessageFilter($msg_type) {
        switch ($msg_type) {
            case self::SUCCESS_MESSAGE:
                $this->assign('success_msg_no_xss_filter', true);
                break;
            case self::INFO_MESSAGE:
                $this->assign('info_msg_no_xss_filter', true);
                break;
            case self::ERROR_MESSAGE:
                $this->assign('error_msg_no_xss_filter', true);
                break;
            default:
                error_log("bad message id passed to disableXSSMessageFilter()");
                break;
        }
    }

    /**
     * Add page-level or field-level info message to view
     * To add a page-level message, leave $field null. To add a field-level message, specify $field name.
     * @param str $msg
     * @param str $field Defaults to null
     */
    public function addInfoMessage($msg, $field=null, $disable_xss=false) {
        $this->addMessage(self::INFO_MESSAGE, $msg, $field, $disable_xss);
        if ($disable_xss === true) {
            $this->disableXSSMessageFilter(self::INFO_MESSAGE);
        }
    }

    /**
     * Add page-level or field-level success message to view
     * To add a page-level message, leave $field null. To add a field-level message, specify $field name.
     * @param str $msg
     * @param str $field Defaults to null
     */
    public function addSuccessMessage($msg, $field=null, $disable_xss=false) {
        $this->addMessage(self::SUCCESS_MESSAGE, $msg, $field, $disable_xss);
        if ($disable_xss === true) {
            $this->disableXSSMessageFilter(self::SUCCESS_MESSAGE);
        }
    }

    /**
     * Add a field or page-level message to the view.
     * @param int $msg_type Should equal self::SUCCESS_MSG, self::INFO_MSG, self::ERROR_MSG
     * @param string $msg
     * @param string $field
     */
    private function addMessage($msg_type, $msg, $field=null) {
        switch ($msg_type) {
            case self::SUCCESS_MESSAGE:
                if (isset($field)) {
                    $this->success_msgs[$field] = $msg;
                    $this->assign('success_msgs', $this->success_msgs );
                } else {
                    $this->assign('success_msg', $msg);
                }
                break;
            case self::INFO_MESSAGE:
                if (isset($field)) {
                    $this->info_msgs[$field] = $msg;
                    $this->assign('info_msgs', $this->info_msgs );
                } else {
                    $this->assign('info_msg', $msg);
                }
                break;
            case self::ERROR_MESSAGE:
                if (isset($field)) {
                    $this->error_msgs[$field] = $msg;
                    $this->assign('error_msgs', $this->error_msgs );
                } else {
                    $this->assign('error_msg', $msg);
                }
                break;
            default:
                break;
        }
    }

    /**
     * For use only by tests: return a template data value by key.
     * @param string $key
     */
    public function getTemplateDataItem($key) {
        return isset($this->template_data[$key]) ? $this->template_data[$key]:null;
    }

    /**
     * Check if caching is enabled
     * @return bool
     */
    public function isViewCached() {
        return ($this->caching==1)?true:false;
    }

    /**
     * Turn off caching
     */
    public function disableCaching() {
        $this->caching=0;
    }

    /**
     * Override the parent's fetch method to handle an unwritable compilation directory.
     * @param str $template Template name
     * @param str $cache_key Cache key
     * @param str Results
     */
    public function fetch($template, $cache_key=null, $compile_id=null, $display=false) {
        $continue = false;
        if (is_writable(ADMIN_ROOT_PATH.'/')) {
			$ret = ADMIN_ROOT_PATH.' is writable';
            if (!file_exists($this->compile_dir)) {
                if (mkdir($this->compile_dir, 0777)) {
                    $continue = true;
                }
            } else {
                $continue = true;
            }
        }
        if (is_writable($this->compile_dir)) {
            if ($this->caching == 1 && !file_exists($this->compile_dir.'/cache')) {
                if (mkdir($this->compile_dir.'/cache/', 0777)) {
                    $continue = true;
                }
            } else {
                $continue = true;
            }
        }
        if ($continue) {
            return parent::fetch($template, $cache_key, $compile_id, $display);
        } else {
            Loader::definePathConstants();
            $whoami = @exec('whoami');
            if (empty($whoami)) {
                $whoami = 'nobody';
            }
            return 'Permission Denied. :'.$whoami.' ret:'.$ret.'<br/><br/>';
        }
    }

    /**
     * Override the parent's clear_all_cache method to check if caching is on to begin with. We do this to prevent the
     * cache/MAKETHISDIRWRITABLE.txt from being deleted during test runs; this file needs to exist in order for the
     * cache directory to remain in the git repository.
     * @param int $expire_time
     */
    public function clear_all_cache($exp_time = null) {
        if ($this->caching == 1) {
            parent::clear_all_cache($exp_time);
        }
    }

}


 ?>