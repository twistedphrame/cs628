<html>
<head>
	<title>Change Password</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
</head>

<body>

<div id="container">
    <?php include("includes/header.html"); ?>
    <div id="content">
	<div style = "padding: 15px 0px">
	    <center>
		<table>
		    <tr>
			<td>
			    <h2>Change Password</h2>
			</td>
		    </tr>
		</table>
	    </center>
	</div>
	<?php
	    //session_start();
	    //if (empty($_COOKIE['uname'])) {
		//    header('LOCATION: index_3.php');
	    //}
	    //retrieve session data
	    $uname = "test";//$_COOKIE['uname'];//$_SESSION['uname'];
	    $fname = "k"; //$_COOKIE['fname'];//$_SESSION['fname'];
	    
	    $ERR_STRING = "error";
	    $PSWORD_STRING = "psword";
	    $NEW_PSWORD1_STRING = "newpass1";
	    $NEW_PSWORD2_STRING = "newpass2";
	    $DB_USER = "root";
	    $DB_PASS = "";
	    $DB_NAME = "registration";
	?>
	<?php
	    $errors = array();
	    $errors[$ERR_STRING]= "";
	    $success="";
	    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$oldPass = $_POST[$PSWORD_STRING];
		$newpsword1 = $_POST[$NEW_PSWORD1_STRING];
		$newpsword2 = $_POST[$NEW_PSWORD2_STRING];
		
		if (empty($oldPass)) {
		    $errors[$ERR_STRING]= "You forgot to enter password.";
		} elseif (empty($newpsword1)) {
		    $errors[$ERR_STRING]= "You forgot to enter new password 1.";
		} elseif (empty($newpsword2)) {
		    $errors[$ERR_STRING]= "You forgot to enter new password 2.";
		} elseif ($newpsword1 !== $newpsword2) {
		    $errors[$ERR_STRING]= "New Passwords do not match.";
		} else {
		    $dbc = mysqli_connect('localhost', $DB_USER, $DB_PASS, $DB_NAME)
				    or die("cannot connect to database.");
		    $q = "SELECT * FROM users WHERE uname = '$uname'";					
		    $r = mysqli_query($dbc, $q);					
		    $num = mysqli_num_rows($r);					
		    if ($num == 1){
			$row = mysqli_fetch_array($r);
			if(SHA1($oldPass) == $row[$PSWORD_STRING]) {
			    //Everythings good lets reset the password
			    $q = "INSERT INTO users ($PSWORD_STRING) VALUES (SHA1('$newpsword2'))";
			    $r = mysqli_query($dbc, $q);
			    if($r) {
				$success = "Password successfully updated";
			    }
			} else {
			    $errors[$ERR_STRING]= "Old Password is incorrect";
			}
		    } else { //How does that even happen?
			die ("Something went wrong when looking up user information.  Try again later");
		    }
		}
	    }
        ?>
	<div style = "padding: 25px 0px">
	    <form action="" method="POST">
		<center>
		    <table>
			<tr>
			    <td>
				<div style="color: red"><?php echo $errors[$ERR_STRING]; ?></div>
			    </td>
			</tr>
		    </table>
		</center>
		<center>
		<table>
		    <tr>
			<td>Old Password:</td>
			<td>						
			    <input type="password" name="<?php echo $PSWORD_STRING; ?>" />
			</td>
		    </tr>
		    <tr>
			<td>New Password:</td>
			<td>
			    <input type="password" name="<?php echo $NEW_PSWORD1_STRING; ?>" />
			</td>
		    </tr>
		    <tr>
			<td>New Password:</td>
			<td>
			    <input type="password" name="<?php echo $NEW_PSWORD2_STRING; ?>" />
			</td>
		    </tr>	
		</table>
		<table>
		    <tr>
			<td>
			  <input type="button" onclick="parent.location='<?php
									    //if($_COOKIE['role'] == "Admin") {
									      echo "admin.php";
									    //} else {
									    //  echo "student.php";
									    //}
									?>'" value='Back' />
			</td>
			<td>
			    <input type="submit" name="button" value="Update" />
			</td>
		    </tr>
		    <tr>
			<td colspan="2">
			    <?php
			    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			      if(!empty($success)) {
				echo '<div style="color: black;">'.$success.'</div>';
			      }
			      else {
				echo '<div style="color: red;">Password could not be updated</div';
			      }
			    }
			    ?>
			</td>
		    </tr>
		</table>
		</center>
	</form>
	</div>
	<div id="footer">
		<p style = "padding: 10px 250px; font-size: 12px">Copyright 2015 Monmouth University</p> 
	</div>
    </div>
</body>
</html>