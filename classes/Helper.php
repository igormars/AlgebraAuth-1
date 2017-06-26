<?php

class Helper
{
	private function __construct(){}
	private function __clone(){}
	
	public function getHeader($title, $header = 'header')
	{
		$path = 'includes/layouts/' . $header . '.php';
		
		if(file_exists($path)) {	
		
			return require $path;
			
		}
		return false;
	}
}