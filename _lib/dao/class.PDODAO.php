<?php
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
 * File : class.PDODAO.php
 * Description : PHP PDO implementation
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Fri Jan 31 2014 19:14:02 GMT+0530 (IST)
 */

class PDODAO {
	
    /* Logger */
	var $logger;
	/* PDO Object */
    static $PDO = null;
    
	/* Constructor */
	public function __construct($log_location = 'PDODAO.log'){
        $this->logger = Logger::getInstance($log_location);
        if (is_null(self::$PDO)) {
            $this->connect();
        }
        
    }

    /**
     * Instantiate singleton instance of the logger pointing at the specified file.
     * @param str $log_location
     * @return void
     */
    public function setLogger($log_location) {
        $this->logger = Logger::getInstance($log_location);
    }

    /**
     * Set the logger instance used by the DAO.
     * @param Logger $logger
     * @return void
     */
    public function setLoggerInstance($logger) {
        $this->logger = $logger;
    }

    /**
     * Return the singleton Logger instance.
     * @return Logger
     */
    public function getLogger() {
        return $this->logger;
    }

    /**
     * Connection initiator
     */
    public final function connect(){
        //echo 'Trying to connect';
		
		if(!defined('DB_USER')) define('DB_USER','root');
		if(!defined('DB_PWD')) define('DB_PWD','');
        if (is_null(self::$PDO)) {
            self::$PDO = new PDO(
            self::getConnectString(),
            DB_USER,
            DB_PWD
            );
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
          
        }
    }

    /**
     * Generates a connect string to use when creating a PDO object.
     */
    public static function getConnectString() {
        $db_type="mysql";
        $db_string = sprintf(
            "%s:dbname=%s;host=%s",
        $db_type,
        DB_NAME,
        DB_SERVER
        );
        return $db_string;
    }

    /**
     * Disconnector
     * Caution! This will disconnect for ALL DAOs
     */
    protected final function disconnect(){
        self::$PDO = null;
    }

    /**
     * Executes the query, with the bound values
     * @param str $sql
     * @param array $binds
     * @return PDOStatement
     */
    protected final function execute($sql, $binds = array()) {
        $stmt = self::$PDO->prepare($sql);
        if (is_array($binds) and count($binds) >= 1) {
            foreach ($binds as $key => $value) {
                if (is_int($value)) {
                    $stmt->bindValue($key, $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $exception_details = 'Database error! || '.$e.' ||';
			$this->logger->logError($e);
            throw new PDOException ($exception_details);
        }
        return $stmt;
    }

    /**
     * Proxy for getUpdateCount
     * @param PDOStatement $ps
     * @return int Update Count
     */
    protected final function getDeleteCount($ps){
        //Alias for getUpdateCount
        return $this->getUpdateCount($ps);
    }
    /**
     * Gets a single row and closes cursor.
     * @param PDOStatement $ps
     * @return various array,object depending on context
     */
    protected final function fetchAndClose($ps){
        $row = $ps->fetch();
        $ps->closeCursor();
        return $row;
    }
    /**
     * Gets a multiple rows and closes cursor.
     * @param PDOStatement $ps
     * @return array of arrays/objects depending on context
     */
    protected final function fetchAllAndClose($ps){
        $rows = $ps->fetchAll();
        $ps->closeCursor();
        return $rows;
    }
    /**
     * Gets the rows returned by a statement as array of objects.
     * @param PDOStatement $ps
     * @param str $obj
     * @return array numbered keys, with objects
     */
    protected final function getDataRowAsObject($ps, $obj){
        $ps->setFetchMode(PDO::FETCH_CLASS,$obj);
        $row = $this->fetchAndClose($ps);
        if (!$row){
            $row = null;
        }
        return $row;
    }

    /**
     * Gets the first returned row as array
     * @param PDOStatement $ps
     * @return array named keys
     */
    protected final function getDataRowAsArray($ps){
        $ps->setFetchMode(PDO::FETCH_ASSOC);
        $row = $this->fetchAndClose($ps);
        if (!$row){
            $row = null;
        }
        return $row;
    }

    /**
     * Returns the first row as an object
     * @param PDOStatement $ps
     * @param str $obj
     * @return array numbered keys, with Objects
     */
    protected final function getDataRowsAsObjects($ps, $obj){
        $ps->setFetchMode(PDO::FETCH_CLASS,$obj);
        $data = $this->fetchAllAndClose($ps);
        return $data;
    }

    /**
     * Gets the rows returned by a statement as array with arrays
     * @param PDOStatement $ps
     * @return array numbered keys, with array named keys
     */
    protected final function getDataRowsAsArrays($ps){
        $ps->setFetchMode(PDO::FETCH_ASSOC);
        $data = $this->fetchAllAndClose($ps);
        return $data;
    }

    /**
     * Gets the result returned by a count query
     * (value of col count on first row)
     * @param PDOStatement $ps
     * @param int Count
     */
    protected final function getDataCountResult($ps){
        $ps->setFetchMode(PDO::FETCH_ASSOC);
        $row = $this->fetchAndClose($ps);
        if (!$row or !isset($row['count'])){
            $count = 0;
        } else {
            $count = (int) $row['count'];
        }
        return $count;
    }

    /**
     * Gets whether a statement returned anything
     * @param PDOStatement $ps
     * @return bool True if row(s) are returned
     */
    protected final function getDataIsReturned($ps){
        $row = $this->fetchAndClose($ps);
        $ret = false;
        if ($row && count($row) > 0) {
            $ret = true;
        }
        return $ret;
    }

    /**
     * Gets data "insert ID" from a statement
     * @param PDOStatement $ps
     * @return int|bool Inserted ID or false if there is none.
     */
    protected final function getInsertId($ps){
        $rc = $this->getUpdateCount($ps);
        $id = self::$PDO->lastInsertId();
        if ($rc > 0 and $id > 0) {
            return $id;
        } else {
            return false;
        }
    }

    /**
     * Proxy for getUpdateCount
     * @param PDOStatement $ps
     * @return int Insert count
     */
    protected final function getInsertCount($ps){
        //Alias for getUpdateCount
        return $this->getUpdateCount($ps);
    }

    /**
     * Get the number of updated rows
     * @param PDOStatement $ps
     * @return int Update Count
     */
    protected final function getUpdateCount($ps){
        $num = $ps->rowCount();
        $ps->closeCursor();
        return $num;
    }

    /**
     * Converts any form of "boolean" value to a Database usable one
     * @internal
     * @param mixed $val
     * @return int 0 or 1 (false or true)
     */
    protected final function convertBoolToDB($val){
        return $val ? 1 : 0;
    }

    /**
     * Converts a Database boolean to a PHP boolean
     * @param int $val
     * @return bool
     */
    public final static function convertDBToBool($val){
        return $val == 0 ? false : true;
    }
}
