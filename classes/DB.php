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
	}
	
}