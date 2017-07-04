<?php

	require_once 'core/init.php';
	
	$validation = new Validation();
	
	if(Input::exists()) {
		
		$validate = $validation->check(array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));
		echo '<pre>';
		var_dump($validate);
		echo '</pre>';
		
	}
	
	Helper::getHeader('Login Page');
	
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Sign In</h3>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Enter your username" value="<?php
						echo escape(Input::get('username'))?>">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Sign In</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
	Helper::getFooter();
?>
