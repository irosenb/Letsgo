<link href="/resources/style-login.css" rel="stylesheet" type="text/css">

<div id="loginform">
	<form action="/login" method="POST" id="login">
		<input class="login-field" id="email" type="text" name="email" placeholder="Email address"><br />
		<input class="login-field" id="password" type="password" name="password" placeholder="Password"><br />
		<input type="submit" name="login" class="button login-button" value="Login"><br/>
		<p><a href="#" id="registerlink">Create an account</a></p>
	</form>
	<form action="/login" method="POST" id="register">
		<input class="login-field" id="email" type="text" name="email" placeholder="Email address"><br />
		<input class="login-field" id="password" type="password" name="password" placeholder="Password"><br />
		<input class="login-field" id="name" type="text" name="name" placeholder="Your name"><br />
		<input class="login-field" id="phone" type="phone" name="phone" placeholder="Phone number"><br />
		<input type="submit" name="register" class="button login-button" value="Register"><br/>
		<p><a href="#" id="loginlink">Login with existing account</a></p>
	</form>
</div>

<script>
	$(document).ready(function() {
		$('#registerlink').click(function(e) {
			e.preventDefault();
			$('#login').hide();
			$('#register').show();
		});

		$('#loginlink').click(function(e) {
			e.preventDefault();
			$('#register').hide();
			$('#login').show();
		});
	});
</script>