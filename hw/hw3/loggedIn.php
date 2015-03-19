<html lang="en">
<head>
    <title>Logged In</title>
    <link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
</head>
<body>
<div id="container">
	<div id="header">
		<h1 style = "padding: 20px 100px"> Monmouth University Registration System</h1>
	</div>
  <div id="content">
    <?php
      session_start();

			if (empty($_SESSION['uname'])){
				header('LOCATION: index_3.php');
				//echo "<script>window.open('index_3.php', '_SELF')</script>";
			}

			//retrieve session data
			$uname = $_SESSION['uname'];
			$fname = $_SESSION['fname'];
      echo "$fname you are now logged in as: $uname<br>";
      session_destroy ();
    ?>
  </div>
</div>
</body>
</html>
