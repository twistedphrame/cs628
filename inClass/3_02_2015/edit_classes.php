<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>

<body>
	<div id = "container">
	<?php include("includes/header_admin.html"); ?>
	<?php include("htmlTricks.php"); ?>
	<div id = "content">
		
		<script>
			function confirmDelete(classID, className, subject) {
				//document.getElementById("footer").innerHTML = classID + " className";

				var r = confirm(className +" Will be deleted.");
				if (r == true) {
					var xhr;
					if (window.XMLHttpRequest) {
							xhr = new XMLHttpRequest();
					}
					else if (window.ActiveXObject) {
							xhr = new ActiveXObject("Msxml2.XMLHTTP");
					}
					else {
							throw new Error("Ajax is not supported by this browser");
					}
					
					//what do I do when i get a response back
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4) {
							if (xhr.status == 200 && xhr.status < 300) {
								window.location.replace('edit_classes.php?subject='+subject, '_SELF')
							}
						}
					}
					xhr.open('POST', 'delete_class.php');
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("classid=" + classID);
				}
			}
			
			function displayClasses() {
				var subjectSelect = document.getElementById("subject");
				var subjectText = subjectSelect.options[subjectSelect.selectedIndex].text;
				window.location.replace('edit_classes.php?subject='+subjectText, '_SELF');
			}
		</script>
		
		
		<?php
			$SUBJ_STRING = "subject";
		?>
		
		<?php
			session_start();
     
			//if (empty($_SESSION['uname'])){
			if (empty($_COOKIE['uname'])) {
				header('LOCATION: index_3.php');
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
								  $concentrations = concentrations();
									$subject = $concentrations[0];
									if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$SUBJ_STRING])) {
										$subject=$_GET[$SUBJ_STRING];
									}
								  createDropDown($SUBJ_STRING, concentrations(), $subject);
								?>
							</td>
							<td>
								<input type="button"
											 onclick="displayClasses()" name="display" value="Display"/>
							</td>
						</tr>
					</table>
				</center>
			<?php
				$r = false;
				$q ='';
				if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$SUBJ_STRING])) {
					include("dbc.php");
					$q = "SELECT * FROM classes WHERE subject='$_GET[$SUBJ_STRING]';";
					$r = mysqli_query($dbc, $q);
				}
				if(!empty($q)) {
					echo '<form><center><table border="3"  cellspacing="10">';
					echo '<tr><td align="center">Subject</td><td align="center">Code</td><td align="center">Section</td><td align="center">Name</td>';
					echo '<td align="center">Schedule</td><td align="center">Professor</td><td align="center">Room</td><td align="center">Edit</td><td align="center">Delete</td></tr>';
				if($r) {
					 while ($row = mysqli_fetch_assoc($r)) {
						echo "<tr><td>{$row['subject']}</td>\n";
						echo "<td>{$row['code']}</td>\n";
						echo "<td>{$row['section']}</td>\n";
						echo "<td>{$row['name']}</td>\n";
					  echo "<td>{$row['schedule']}</td>\n";
						echo "<td>{$row['professor']}</td>\n";
						echo "<td>{$row['room']}</td>\n";
						echo "<td><input type=\"button\" onclick=\"parent.location='edit_class.php?class_id={$row['class_id']}'\" value='Edit' /></td>\n";
						echo "<td><input type=\"button\" \n";
						echo 'onclick="confirmDelete(\''.$row['class_id'].'\',\''.$row['subject'].' '.$row['code'].'-'.$row['section'].'\',\''.$row['subject'].'\')" ';
						echo "value=\"Delete\" /></td></tr>\n";
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