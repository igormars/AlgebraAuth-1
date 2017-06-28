<?php

class DB
{
	private static $_instance = null;
	# config data
	private $_driver;
	private $_host;
	private $_db;
	private $_user;
	private $_pass;
	private $_charset;
	private $_fetch;
	# connection and query
	private $_connection;
	private $_query;
	private $_results;
	private $_count = 0;
	# errors
	private $_error = false;
	
	/**
    * Get an instance of the Database
    *
    * @return DB object
    */
	public static function getInstance()
	{
		if(!self::$_instance) {
			self::$_instance = new DB();
		}
		return self::$_instance;		
	}
	
	private function __construct()
	{
		$config = Config::get('database');
		$this->_fetch = $config['fetch'];
		$this->_driver = $config['driver'];
		$this->_host = $config[$this->_driver]['host'];
		$this->_db = $config[$this->_driver]['db'];
		$this->_user = $config[$this->_driver]['user'];
		$this->_pass = $config[$this->_driver]['pass'];
		$this->_charset = $config[$this->_driver]['charset'];
		
		try {
			
			$this->_connection = new PDO($this->_driver.':host='.$this->_host.';dbname='.$this->_db.';charset='.$this->_charset, $this->_user, $this->_pass);
			
		} catch (PDOException $e) {
			
			die($e->getMessage());
			
		}
		
	}
	
	/**
	* Magic method clone is empty and private to prevent duplication of connection
	*
	*/
	private function __clone(){}
	
	/**
	*  PDO Connection
	*
	* @return _connection property
	*/
	public function getConnection()
	{
		return $this->_connection;
	}
	
	/**
	*  Prepare and execute SQL queries.
	*
	* @param  string  $sql
	* @param  array  $params
	* @return DB object
	*/
	public function query($sql, $params = array())
	{
		$this->_error = false;
		
		if($this->_query = $this->_connection->prepare($sql)) {
			$x = 1;
			if(!empty($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x,$param);
					$x++;
				}
			}
			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll($this->_fetch);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		
		return $this;
	}
	
	/**
	*  Create SQL queries.
	*
	* @param  string  $action
	* @param  string  $table
	* @param  array  $where
	* @return DB object
	*/
	public function action($action, $table, $where = array())
	{
		
	}
	
	/**
	*  Return all records.
	*
	* @return array(object(stdClass))
	*/
	public function results()
	{
		return $this->_results;
	}
	
	/**
	*  Return first record.
	*
	* @return object(stdClass)
	*/
	public function first()
	{
		return $this->_results[0];
	}
	
	/**
	*  Check for errors.
	*
	* @return Bool
	*/
	public function error()
	{
		return $this->_error;
	}
	
	/**
	*  Return number of records.
	*
	* @return Int
	*/
	public function count()
	{
		return $this->_count;
	}
	
	
	
}