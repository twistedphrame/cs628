<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>

<body>
	<div id = "container">
	<?php include("includes/header_admin.html"); ?>
	
	<div id = "content">
		
		<?php
			$SUBJ_STRING = "subject";
		?>
		
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
			<form action="" method="POST">
				<center>
					<table border="1">
						<tr>
							<td>
								<?php //Drop down in PHP 
                              $subjects = array("MA","CS","SE","EN","HS","BM");
                              echo "<select name=\"$SUBJ_STRING\" >";
                              foreach ($subjects as $subj) {
                                echo '<option value="'.$subj.'">'.$subj.'</option>';
                              }
                              echo "</select>";
								?>								
							</td>
							<td>
								<input type="submit" name="display" value="Display"/>
							</td>
						</tr>
					</table>
				</center>
			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					include("dbc.php");
																//edit will use a GET to show editClass?classID page
																//delete will go to a page to delete the record and
																// will return the you to the this page
					echo '<form><center><table border="1">';
					echo "<tr><td>Subject</td><td>Code</td><td>Section</td><td>Name</td><td>Schedule</td><td>Professor</td><td>Room</td><td>Edit</td><td>Delete</td></tr>";
					$q = "SELECT * FROM classes WHERE subject='$_POST[$SUBJ_STRING]';";
					$r = mysqli_query($dbc, $q);
					if($r) {
					 while ($row = mysqli_fetch_assoc($r)) {
						echo "<tr><td>{$row['subject']}</td>";
						echo "<td>{$row['code']}</td>";
						echo "<td>{$row['section']}</td>";
						echo "<td>{$row['name']}</td>";
					  echo "<td>{$row['schedule']}</td>";
						echo "<td>{$row['professor']}</td>";
						echo "<td>{$row['room']}</td>";
						echo "<td><input type=\"button\" onclick=\"parent.location='edit_class.php?class_id={$row['class_id']}'\" value='Edit' /></td>";
						echo "<td>Delete</td></tr>";
					 }
					}
					echo "</table></center></form>";
				}		
			?>
			</form>
	</div>
	
	<div id = "footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
	</div>
</body>
</html>