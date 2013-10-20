<!DOCTYPE html>
<html>

<head>
	
	<title>Let's Go!</title>
	<link href="/resources/style-layout.css" rel="stylesheet" type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Kaushan+Script' rel='stylesheet' type='text/css'>
</head>

<body>

<?php if(!(isset($loginpage) && $loginpage)): ?>
	<div class="user-bar">
	<span class="lia">Logged in as </span><div class="user"><?php echo $login_name ?></div>
	</div>
<?php endif ?>

	<div class="body-wrapper">
	
		<div class="header-wrapper">
			<div class="header-text">
				Let's Go!
			</div>		
		</div>

		<?php echo $content ?>

		<div class="footer-wrapper"></div>
		
	</div>
</body>

</html>