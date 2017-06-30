<?php

	require_once 'core/init.php';
	
	Helper::getHeader('Login Page');
	
	DB::getInstance()->insert('users', array(
										'username' => 'Cicarija',
										'password' => 1234569,
										'salt'     => 'salt',
										'name'     => 'Mirko Cicarija',
										'role_id'  => 1
										)
	);
	
	#$query = DB::getInstance()->query('SELECT * FROM users WHERE id = ?', array(1));
	
	#$action = DB::getInstance()->action('SELECT *','users',array('id','=',1));
	
	$get = DB::getInstance()->get('*','users');
	
	#$find = DB::getInstance()->find(1,'users');
	
	$delete = DB::getInstance()->delete('users',array('id','=',5));

	$results = DB::getInstance()->results();
	
	echo '<pre>';
	var_dump($results);
?>
