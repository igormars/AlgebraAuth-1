<?php

	require_once 'core/init.php';
	
	$user = new User();
	
	if($user->check()) {
		Redirect::to('dashboard');
	}
	
	$validation = new Validation();
	
	if(Input::exists()) {
		
		if(Token::check(Input::get('_csrf'))) {
			
			$validate = $validation->check(array(
				'name' => array(
					'required' => true,
					'min'      => 2,
					'max'      => 50
				),
				'username' => array(
					'required' => true,
					'min'      => 4,
					'max'      => 20,
					'unique'   => 'users'
				),
				'password' => array(
					'required' => true,
					'min'      => 8
				),
				'password-again' => array(
					'required' => true,
					'matches'  => 'password'
				)
			));
			
			if($validate->passed()) {
				
				$salt = Hash::salt(32);
				
				try {
					
					$user->create();
					
				} catch(Exception $e) {
					Session::flash('danger', $e->getMessage());
					Redirect::to('register');
					exit;
				}
				
				Session::flash('success', 'You registered successfully');
				
				Redirect::to('login');
			}	
		} else {
			Session::flash('danger', 'CSRF Token missmatch');
		}
	}
		
	Helper::getHeader('Registration Page');
	
	require_once 'notifications.php';
	
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Create an account</h3>
			</div>
			<div class="panel-body">
				<form method="post">
					<input type="hidden" name="_csrf" value="<?php echo Token::generate() ?>">
					<div class="form-group <?php echo ($validation->hasError('name')) ? 'has-error' : '' ?>">
						<label for="name" class="control-label">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="<?php
						echo escape(Input::get('name'))?>">
						<?php echo ($validation->hasError('name')) ? '<p class="text-danger">' . $validation->hasError('name') . '</p>' : '' ?>
					</div>
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
					<div class="form-group <?php echo ($validation->hasError('password-again')) ? 'has-error' : '' ?>">
						<label for="password-again" class="control-label">Confirm Password</label>
						<input type="password" class="form-control" name="password-again" id="password-again" placeholder="Enter your password again">
						<?php echo ($validation->hasError('password-again')) ? '<p class="text-danger">' . $validation->hasError('password-again') . '</p>' : '' ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Create account</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php

	Helper::getFooter();
	
?>
