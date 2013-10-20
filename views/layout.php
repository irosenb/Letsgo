
<!DOCTYPE html>


<!DOCTYPE html>

<html>

<head>
	
	<title>Let's Go!</title>
	<link href="/resources/style-layout.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Kaushan+Script' rel='stylesheet' type='text/css'>

</head>

<body>
<div class="background">

<?php if(!(isset($loginpage) && $loginpage)): ?>
	<div class="user-bar">
	Logged in as <div class="user"><?php echo $login_name ?></div>
	</div>
<?php endif ?>

	<div class="body-wrapper">
	
		<div class="header-wrapper">
			<div class="header-text">
				Let's Go!
			</div>
		</div>

		<?php echo $content ?>
		
		</div>

		<div class="footer-wrapper"></div>
		
	</div>
</div>
</body>

</html>