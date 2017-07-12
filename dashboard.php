<?php

	require_once 'core/init.php';
	
	$user = new User();
	
	if(!$user->check()) {
		Redirect::to('login');
	}
	
	Helper::getHeader('Login Page');
	
	require_once 'notifications.php';
	
?>
	<h1>Dashboard</h1>
<?php

	Helper::getFooter();

?>	
	
