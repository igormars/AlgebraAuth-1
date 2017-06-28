<?php

	require_once 'core/init.php';
	
	Helper::getHeader('Login Page');
	
	$user = 'kele';
	$pass = 'password';
	
	#$query = DB::getInstance()->query('SELECT * FROM users WHERE username = ? AND password = ?', array($user,$pass));
	
	
	$query = DB::getInstance()->query('SELECT * FROM users');
	
	$results = DB::getInstance()->results();
	
	echo '<pre>';
	var_dump($results);
?>
