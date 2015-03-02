<!--
	Week 2
	- sticky forms
	- two forms on one page
	- User registration
-->

<html>
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
<!--
	<style>
		body {background-color: grey; }
		#container {width: 800px; background-color: white;}
		#header {height: 70px; background-color: blue; color: white;}
		#main {height: 350px; background-color: white;}
		#footer {height: 30px; background-color: blue; color: white}
		table {padding: 20px 280px;}
	</style>
-->

</head>

<body>



<div id="container">
	<div id="header">
		<h1 style = "padding: 20px 100px"> Monmouth University Registration System</h1>
	</div>
	
	<div id="content">
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
					/*
					connect to database
					search users table to find the user
					if found
						verify password
						if correct
							//do something here
						else
							report incorrect password
					else
						report unknown user
					*/
					$dbc = mysqli_connect('localhost', 'root', 'huntin', 'reg2')
						or die("cannot connect to database.");
					
					$q = "SELECT * FROM users WHERE uname = '$uname'";
					
					$r = mysqli_query($dbc, $q);
					
					$num = mysqli_num_rows($r);
					
					if ($num == 1){
						$row = mysqli_fetch_array($r);
						
						$pwd = SHA1($psword);
						
						if ($pwd == $row['psword']){
							session_start();
							
							$_SESSION['uname'] = $uname;
							$_SESSION['fname'] = $row['fname'];
							
							if($row['role'] == 'student')
								//header('LOCATION: student.php');
								echo "<script>window.open('student.php', '_SELF')</script>";
							else 
								header('LOCATION: admin.php');
						}
						else {
							echo "incorrect password";
						}
					}
					else 
						echo "unknown username.";
						
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
					header('LOCATION: register.php?role='.$role);
					//echo "<script>window.open('register.php', '_SELF')</script>";
			}
		}
		?>
		</div>
	
		<div style = "padding: 50px 0px">
		<form action="" method="POST">
			<center><table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname"></td>					
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="psword"></td>	
				</tr>
	
			</table></center>
			<div style="padding: 0px 450px" >
				<input type="submit" name="button" value="Login" >
			</div>
		</form>
		</div>
		
		<form action="" method="POST">
			<center><table>
		
				<tr>
					<td>Role:</td>
					<td><input type="radio" name="role" value="admin">Admin
						<input type="radio" name="role" value="student">Student
					</td>	
				</tr>
			</table></center>
			<div style="padding: 0px 450px" >
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






