<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>

<body>
	<div id = "container">
	<?php include("includes/header.html"); ?>
	
	<div id = "content">
		<?php
			session_start();
			$_SESSION = array();
			session_destroy();
			
			//destroys the cookie
			setcookie('uname');
			setcookie('fname');
		?>
	
		<h1>You have logged out successfully!</h1>
		<a href = "index_3.php">Click here to login.</a>
	</div>
	
	<div id = "footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
	</div>
</body>
</html>