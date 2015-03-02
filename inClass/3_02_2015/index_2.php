<!--
	Week 2
	- sticky forms
	- two forms on one page
	- User registration
-->

<html>
<head>
	<title>CS628--Week1</title>
	<style>
		body {background-color: grey; }
		#container {width: 800px; background-color: white;}
		#header {height: 70px; background-color: blue; color: white;}
		#main {height: 350px; background-color: white;}
		#footer {height: 30px; background-color: blue; color: white}
		table {padding: 20px 280px;}
	</style>
</head>

<body>



<div id="container">
	<div id="header">
		<h1 style = "padding: 20px 100px"> Monmouth University Registration System</h1>
	</div>
	
	<div id="main">
		<div style="color: red;">
		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['button']=='Login'){
				$uname= $_POST['uname'];
				$psword= $_POST['psword'];
			
				$error = array();
		
				if(empty($uname)) $error[]= "You forgot to enter user name.";
				if(empty($psword)) $error[]= "You forgot to enter password.";
			
				if(empty($error)) {
					//do something here
				}
				else {
					//print error information
					foreach ($error as $err){
						echo $err;
						echo "<br>";
					}
				}
			}
			else {   //register button was hit
				$role = $_POST['role'];
				if (empty($role)) 
					echo "You forgot to select a role.";
				else
					header('LOCATION: register.php');
					//echo "<script>window.open('register.php', '_SELF')</script>";
			}
		}
		?>
		</div>
	
		<form action="" method="POST">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname"></td>					
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="psword"></td>	
				</tr>
	
			</table>
			<div style="padding: 0px 400px" >
				<input type="submit" name="button" value="Login" >
			</div>
		</form>
		
		<form action="" method="POST">
			<table>
		
				<tr>
					<td>Role:</td>
					<td><input type="radio" name="role" value="admin">Admin
						<input type="radio" name="role" value="student">Student
					</td>	
				</tr>
			</table>
			<div style="padding: 0px 400px" >
				<input type="submit" name="button" value="Register" >
			</div>
		</form>
	</div>
	
	<div id="footer">
		<p style = "padding: 10px 250px; font-size: 12px">Copyright 2015 Monmouth University</p> 
	</div>

</div>

</body>
</html>






