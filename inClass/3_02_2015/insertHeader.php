<?php
      session_start();
			if (empty($_COOKIE['uname'])){
				header('LOCATION: index_3.php');
				//echo "<script>window.open('index_3.php', '_SELF')</script>";
			}
			if($_COOKIE['role']==="admin") {
				include("includes/header_admin.html");
			} else {
				include("includes/header.html");
			}
?>