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
		/**
		 *Update the given column name with the given value for the given userName
		 *with the given DB connection
		 */
		  function update($connection, $colName, $colVal, $userName) {
				$query = "UPDATE users SET $colName='$colVal' where uname='$userName'";
        return mysqli_query($connection, $query);				
			}		
		?>
			
		<?php
		$errors = array();
		$errors["lock"] ="";
		$errors["uname"]= "";
		$errors["psword"]= "";
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['button']=='Login'){
				$uname= $_POST['uname'];
				$psword= $_POST['psword'];
			
				
		
				if(empty($uname)) $errors["uname"]= "You forgot to enter user name.";
				if(empty($psword)) $errors["psword"]= "You forgot to enter password.";
			  
				if(empty($errors)) {
					$dbc = mysqli_connect('localhost', 'root', 'huntin', 'reg2')
																or die("cannot connect to database.");
					
					$q = "SELECT * FROM users WHERE uname = '$uname'";					
					$r = mysqli_query($dbc, $q);					
					$num = mysqli_num_rows($r);					
					if ($num == 1){
						$row = mysqli_fetch_array($r);
						$locked = false;
						if(isset($row['lock_time']) && !empty($row['lock_time'])) {
							$lockTime = strtotime($row['lock_time']);
							$minAgo = strtotime("- 1 min");
							if($lockTime > $minAgo) {//lock for  minute
	            //LOCKED
                $locked = true;
								$waitTime = $lockTime-$minAgo;
								$errors["lock"] = "You are blocked from accessing the"
									               + " system. You need to wait for $waitTime seconds.";
								echo "here" + $errors["lock"];
              } else {//clear the lock time
                 $r = update($dbc, "lock_time", "NULL", $uname);
			        }
            }
            if(!$locked) {
				  		$pwd = SHA1($psword);
							if ($pwd == $row['psword']){
        			  $q = "UPDATE users SET attempts='0' where uname='$uname'";
				  		  $r = mysqli_query($dbc, $q);
   							session_start();
								$_SESSION['uname'] = $uname;
								$_SESSION['fname'] = $row['fname'];
								header('LOCATION: login.html');
								}
								else {
									if(isset($row['attempts'])) {
										$attempts = $row['attempts'];
									} else {
										$attempts = 0;
									}									
									$attempts = $attempts + 1;
									$errors["psword"] = "Incorrect Password " + 3- $attempts + " attempts left.";
									if($attempts == 3) {
										$attempts = $attempts % 3; // only store 0 - 2
										$r = update($dbc, "lock_time", date('Y-m-d H:i:s'), $uname);
									}
									$r = update($dbc, "attempts", $attempts, $uname);
								}
              }
					}
					else {
						$errors["uname"]="unknown username.";
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
					<td></td>
					<td>
						<div style="color: red">
					    <?php echo $errors["uname"]; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div style="color: red">
					    <?php echo $errors["psword"]; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div style="color: red">
					    <?php echo $errors["lock"]; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>Username:</td>
					<td>						
						<input type="text" name="uname">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="psword">
					</td>
				</tr>
	
			</table></center>
			<div style="padding: 0px 450px;" >
				<input type="submit" name="button" value="Login" />
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






