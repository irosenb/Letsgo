<link href="/resources/style-login.css" rel="stylesheet" type="text/css">

<div class="description-wrapper">
Welcome to Let's Go! The place to find new friends who like to go to the same events as you!!
</div>

<div class="toggle-wrapper">
	<input type="button" class="toggle-button selected" id="login-toggle" value="Login">
	<input type="button" class="toggle-button" id="register-toggle" value="Sign Up">
</div>

<div class="login-wrapper">
	<div id="loginform">
		<form action="/login" method="POST" id="login">
			<input class="login-field" id="email" type="text" name="email" placeholder="Email address"><br />
			<input class="login-field" id="password" type="password" name="password" placeholder="Password"><br />
			<input type="submit" name="login" class="button login-button" value="Login"><br/>
		</form>
	</div>
	<div id="registerform">
		<form action="/login" method="POST" id="register">
			<input class="login-field" id="email" type="text" name="email" placeholder="Email address"><br />
			<input class="login-field" id="password" type="password" name="password" placeholder="Password"><br />
			<input class="login-field" id="name" type="text" name="name" placeholder="Your name"><br />
			<input class="login-field" id="phone" type="phone" name="phone" placeholder="Phone number"><br />
			<input type="submit" name="register" class="button login-button" value="Register"><br/>
		</form>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#registerform').hide();
		
		$('#login-toggle').click(function(e) {
			e.preventDefault();
			$('#registerform').hide();
			$('#register-toggle').removeClass('selected')
			$('#loginform').show();
			$('#login-toggle').addClass('selected');
		});

		$('#register-toggle').click(function(e) {
			e.preventDefault();
			$('#loginform').hide();
			$('#login-toggle').removeClass('selected')
			$('#registerform').show();
			$('#register-toggle').addClass('selected');

		});
	});
</script>