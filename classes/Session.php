<?php

class Session
{
	private function __construct(){}
	private function __clone(){}
	
	public static function put($key, $value)
	{
		return $_SESSION[$key] = $value;
 	}
	
	public static function get($key)
	{
		
 	}
	
	public static function exists($key)
	{
		
 	}
	
	public static function delete($key)
	{
		
 	}
	
	public static function flash($type, $string = '')
	{
		
 	}
}