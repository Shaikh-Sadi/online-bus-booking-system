<html>
<head>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	
	
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	
	
	
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="log.js"></script>
	
	<style>
    .btn-login {
        background-color: #59b2e0;
        border-color: #59b2e6;
        color: #fff;
        font-size: 14px;
        font-weight: normal;
        height: auto;
        outline: medium none;
        padding: 14px 0;
        text-transform: uppercase;
    }
    .panel-login {
        border-color: #ccc;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2);
    }
</style>
	
</head>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="server/login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<!--a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a-->
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="server/signup.php" method="post" role="form" style="display: none;">
									
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="pass" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-pass" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</html>