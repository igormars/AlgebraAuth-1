<?php

	require_once 'core/init.php';
	
	$validation = new Validation();
	
	if(Input::exists()) {
		
		if(Token::check(Input::get('_csrf'))) {
			
			$validate = $validation->check(array(
				'username' => array(
					'required' => true,
					'min'      => 8
				),
				'password' => array(
					'required' => true
				)
			));
			
			if($validate->passed()) {
				Session::flash('success', 'Validacija uspjela');
			}	
		}
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
					<input type="hidden" name="_csrf" value="<?php echo Token::generate() ?>">
					<div class="form-group <?php echo ($validation->hasError('username')) ? 'has-error' : '' ?>">
						<label for="username" class="control-label">Username</label>
						<input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Enter your username" value="<?php
						echo escape(Input::get('username'))?>">
						<?php echo ($validation->hasError('username')) ? '<p class="text-danger">' . $validation->hasError('username') . '</p>' : '' ?>
					</div>
					<div class="form-group <?php echo ($validation->hasError('password')) ? 'has-error' : '' ?>">
						<label for="password" class="control-label">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
						<?php echo ($validation->hasError('password')) ? '<p class="text-danger">' . $validation->hasError('password') . '</p>' : '' ?>
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
		#echo '<pre>';
		#var_dump($_SESSION);
		#echo '</pre>';
	Helper::getFooter();
?>
