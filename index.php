<?php

	require_once 'core/init.php';
	
	$user = new User();
	
	if($user->check()) {
		Redirect::to('dashboard');
	}
	
	Helper::getHeader('Algebra Auth', 'header', $user);
		
?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="jumbotron">
			<h1>Algebra Auth</h1>
			<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
			<p>
				<a class="btn btn-primary btn-lg" href="login.php" role="button">Sign In</a>
				or
				<a class="btn btn-primary btn-lg" href="register.php" role="button">Create an account</a>
			</p>
		</div>
	</div>
</div>

<?php

	Helper::getFooter();

?>


	
	