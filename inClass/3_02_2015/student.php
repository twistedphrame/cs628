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
     
			//if (empty($_SESSION['uname'])){
			if (empty($_COOKIE['uname'])) {
				header('LOCATION: index_3.php');
				//echo "<script>window.open('index_3.php', '_SELF')</script>";
			}

			//retrieve session data
			$uname = $_COOKIE['uname'];//$_SESSION['uname'];
			$fname = $_COOKIE['fname'];//$_SESSION['fname'];
		?>
	
		<h1>Welcome, <?php echo $uname ?>!</h1>
		<p>Welcome message here...</p>
	</div>
	
	<div id = "footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
	</div>
</body>
</html>