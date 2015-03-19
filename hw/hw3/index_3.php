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
			$LOCK_STRING = "lock";
			$UNAME_STRING = "uname";
			$PSWORD_STRING = "psword";
			$ATTEMPTS_STRING = "attempts";
			$FIRST_NAME_STRING = "fname";
			$LOCK_TIME_STRING = "lock_time";
			$DB_USER = "root";
			$DB_PASS = "";
			$DB_NAME = "registration";
		?>
			
		<?php
		$errors = array();
		$errors[$LOCK_STRING] ="";
		$errors[$UNAME_STRING]= "";
		$errors[$PSWORD_STRING]= "";
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['button']=='Login'){
				$uname= $_POST[$UNAME_STRING];
				$psword= $_POST[$PSWORD_STRING];
				
				if(empty($uname)) $errors[$UNAME_STRING]= "You forgot to enter user name.";
				if(empty($psword)) $errors[$PSWORD_STRING]= "You forgot to enter password.";
			  
				if(empty($errors[$UNAME_STRING]) && empty($errors[$PSWORD_STRING])) {
					$dbc = mysqli_connect('localhost', $DB_USER, $DB_PASS, $DB_NAME)
																or die("cannot connect to database.");
					
					$q = "SELECT * FROM users WHERE uname = '$uname'";					
					$r = mysqli_query($dbc, $q);					
					$num = mysqli_num_rows($r);					
					if ($num == 1){
						$row = mysqli_fetch_array($r);
						$locked = false;
						if(isset($row[$LOCK_TIME_STRING]) && !empty($row[$LOCK_TIME_STRING])) {
							$lockTime = strtotime($row[$LOCK_TIME_STRING]);
							$minAgo = strtotime("- 1 min");
							if($lockTime > $minAgo) {//lock for  minute
	            //LOCKED
                $locked = true;
								$waitTime = $lockTime-$minAgo;
								$errors[$LOCK_STRING] = 'You are blocked from accessing the'
																				.' system. You need to wait for '
																				.$waitTime
																				.' seconds.';
              } else {//clear the lock time
                 $r = update($dbc, $LOCK_TIME_STRING, "NULL", $uname);
								 if(!$r){ echo "Could not clear lock"; } 
			        }
            }
            if(!$locked) {
				  		$pwd = SHA1($psword);
							if ($pwd == $row[$PSWORD_STRING]){
								$r = update($dbc, $ATTEMPTS_STRING, 0, $uname);
								if(!$r){ die("Could not update attempt count"); }
   							session_start();
								$_SESSION[$UNAME_STRING] = $uname;
								$_SESSION[$FIRST_NAME_STRING] = $row[$FIRST_NAME_STRING];
								header('LOCATION: loggedIn.php');
								}
								else {
									if(isset($row[$ATTEMPTS_STRING])) {
										$attempts = $row[$ATTEMPTS_STRING];
									} else {
										$attempts = 0;
									}									
									$attempts = $attempts + 1;
									$attemptsLeft = (3- $attempts);
									$errors[$PSWORD_STRING] = "Incorrect Password $attemptsLeft attempts left.";
									if($attempts == 3) {
										$attempts = $attempts % 3; // only store 0 - 2
										$r = update($dbc, $LOCK_TIME_STRING, date('Y-m-d H:i:s'), $uname);
										if(!$r){ die("Could not set timestamp."); } 
									}
									$r = update($dbc, $ATTEMPTS_STRING, $attempts, $uname);
									if(!$r){ die("Could not update attempt count"); } 
								}
              }
					}
					else {
						$errors[$UNAME_STRING]="unknown username.";
					}
				}
			}
			else {   //register button was hit
				header('LOCATION: register.php');
			}
		}
		?>
		</div>
	
		<div style = "padding: 50px 0px">
		<form action="" method="POST">
			<center>
				<table>
			  <tr>
					<td>
						<div style="color: red">
					    <?php echo $errors[$UNAME_STRING]; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="color: red">
					    <?php echo $errors[$PSWORD_STRING]; ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="color: red">
					    <?php echo $errors[$LOCK_STRING]; ?>
						</div>
					</td>
				</tr>
				</table>
			</center>
			<center>
			<table>
				<tr>
					<td>Username:</td>
					<td>						
						<input type="text" name="<?php echo $UNAME_STRING; ?>">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="<?php echo $PSWORD_STRING; ?>">
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






