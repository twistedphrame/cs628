<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>

<body>
	<div id = "container">
	<?php
			include("insertHeader.php");
	?>
	
	<div id = "content">
		<?php
			//retrieve session data
			$uname = $_COOKIE['uname'];//$_SESSION['uname'];
			$fname = $_COOKIE['fname'];//$_SESSION['fname'];
			$lname = '';
			$major = '';
			$address = '';
			$city = '';
			$state = '';
			$email = '';
			$phone = '';
			$errors = array();
			$errors["fname"] = '';
			$errors["lname"] = '';
			$errors["addr"] = '';
			$errors["city"] = '';
			$errors["email"] = '';
			$errors["phone"] = '';
			if ($_SERVER['REQUEST_METHOD'] !== "POST") {
				include("dbc.php");
							
				$q = "Select * FROM users WHERE uname='$uname'";
				$r = mysqli_query($dbc, $q);
				if($r) {
					$row = mysqli_fetch_array($r);
					$lname = $row['lname'];
					$major = $row['major'];
					$address = $row['address'];
					$city = $row['city'];
					$state = $row['state'];
					$email = $row['email'];
					$phone = $row['phone'];
				} else {
					die("<div>Could not find user?</div>");
				}
			} else {
				$r = false;
				$fname = (isset($_POST['fname']) ? $_POST['fname'] : '');
				$lname = (isset($_POST['lname']) ? $_POST['lname'] : '');
				$major = (isset($_POST['major']) ? $_POST['major'] : '');
				$address = (isset($_POST['address']) ? $_POST['address'] : '');
				$city = (isset($_POST['city']) ? $_POST['city'] : '');
				$state = (isset($_POST['state']) ? $_POST['state'] : '');
				$email = (isset($_POST['email']) ? $_POST['email'] : '');
				$phone = (isset($_POST['phone']) ? $_POST['phone'] : '');
				
				if(empty($fname)) {
						$errors["fname"] = "First Name must be specified";
				} else {
						$errors["fname"] = '';
				}
				
				if(empty($lname)) {
						$errors["lname"] = "Last Name must be specified";
				} else {
						$errors["lname"] = '';
				}
				
				if(empty($address)) {
						$errors["addr"] = "Address must be specified";
				} else {
						$errors["addr"] = '';
				}
				
				if(empty($city)) {
						$errors["city"] = "City must be specified";
				} else {
						$errors["city"] = '';
				}
				
				if(empty($email)) {
						$errors["email"] = "Email must be specified";
				} else {
						$errors["email"] = '';
				}
				
				if(empty($phone)) {
						$errors["phone"] = "Email must be specified";
				} else {
						$errors["phone"] = '';
				}
				
				$valid = true;
				foreach($errors as $error) { //TODO can check during above ifs
						if(!empty($error)) {
								$valid = false;
								break;
						}
				}
				
				if($valid) {
					include("dbc.php");
					$q = "UPDATE users SET fname='$fname',
					                       lname='$lname',
																 address='$address',
																 major='$major',
																 state='$state',
																 city='$city',
																 email='$email',
																 phone='$phone'
																 WHERE uname='$uname';";
			    $r = mysqli_query($dbc, $q);
				}
			}
		?>
		  
			<form action="" method="POST">
			  <table style="padding-left: 200px;">
					<tr>
						<td>User Name:</td>
						<td><?php echo $uname?></td>
					</tr>
				  <tr>
					  <td>First Name:</td>
						<td>
							<div style="color: red">
							<input type="text" name="fname" value="<?php echo $fname;?>" />
							<?php
							  if(isset($errors))
						  		 echo $errors["fname"];
						   ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td>
							<div style="color: red">
							<input type="text" name="lname" value="<?php echo $lname;?>" />
						<?php
							  if(isset($errors))
						  		 echo $errors["lname"];
						   ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>Major:</td>
						<td><?php //Drop down in PHP 
                              $majors = array("MA","CS","SE","EN","HS","BM");
                              echo "<select name=\"major\" >";
                              foreach ($majors as $maj) {
                                echo '<option value="'.$maj.'"';
                                if($maj == $major) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$maj.'</option>';
                              }
                              echo "</select>";
                            ?></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>
							<div style="color: red">
							<input type="text" name="address" value="<?php echo $address;?>" />
					<?php
							  if(isset($errors))
						  		 echo $errors["addr"];
						   ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>City:</td>
						<td>
							<div style="color: red">
							<input type="text" name="city" value="<?php echo $city;?>" />
											<?php
							  if(isset($errors))
						  		 echo $errors["city"];
						   ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>State:</td>
					   <td><?php //Drop down in PHP 
                              $states = array("NJ","PA","FL","MN","MO","NY");
                              echo "<select name=\"state\">";
                              foreach ($states as $stat) {
                                echo '<option value="'.$stat.'"';
                                if($stat == $state) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$stat.'</option>';
                              }
                              echo "</select>";
                            ?>
					  </td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>
							<div style="color: red">
							<input type="text" name="email" value="<?php echo $email;?>"/>
																	<?php
							  if(isset($errors))
						  		 echo $errors["email"];
						   ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td>
							<div style="color: red">
							<input type="text" name="phone" value="<?php echo $phone;?>"/>
								<?php
							  if(isset($errors))
						  		 echo $errors["phone"];
						   ?>
							</div>
							</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<div>
							<input type="submit" name="button" value="Update"/>
							<?php
							if ($_SERVER['REQUEST_METHOD'] === "POST") {
								if($r) {
									echo "Succesfully Updated"; 
								} else {
									echo '<div style="color: red;">Failed to update</div>';
								}
							}
							?>
							</div>
						</td>
					</tr>
				</table>
			</form>

	</div>
	
	<div id = "footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
	</div>
</body>
</html>