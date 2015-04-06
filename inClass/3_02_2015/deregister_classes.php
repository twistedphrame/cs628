<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>CS628</title>
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>

<body>
	<div id = "container">
	<?php include("includes/header.html"); ?>
	<?php include("htmlTricks.php"); ?>
	<div id = "content">
		
		<script>
			function deregister(classID, className, subject) {
				//document.getElementById("footer").innerHTML = classID + " className";
				var r = confirm("You will be deregistered from: " + className);
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
								window.location.replace('deregister_classes.php', '_SELF')
							}
						}
					}
					xhr.open('POST', 'deregister_class.php');
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.send("classid=" + classID);
				}
			}
		</script>
		<?php
			session_start();
     
			//if (empty($_SESSION['uname'])){
			if (empty($_COOKIE['uname'])) {
				header('LOCATION: index_3.php');
			}
			include("dbc.php");
			$class_ids = registeredClassIDs($dbc);
			echo '<form><center><table border="3"  cellspacing="10">';
			echo '<tr><td align="center">Subject</td><td align="center">Code</td><td align="center">Section</td><td align="center">Name</td>';
			echo '<td align="center">Schedule</td><td align="center">Professor</td><td align="center">Room</td><td align="center">Register</td></tr>';
			
			if(empty($class_ids)) {
				echo "<tr><td colspan='8'>No classes have been registered.</td></tr>";
			} else {
				foreach($class_ids as $id) {
					$q = "SELECT * FROM classes WHERE class_id='$id';";
					$r = mysqli_query($dbc, $q);
					if($r) {
						$row = mysqli_fetch_assoc($r);
						echo "<tr><td>{$row['subject']}</td>\n";
						echo "<td>{$row['code']}</td>\n";
						echo "<td>{$row['section']}</td>\n";
						echo "<td>{$row['name']}</td>\n";
						echo "<td>{$row['schedule']}</td>\n";
						echo "<td>{$row['professor']}</td>\n";
						echo "<td>{$row['room']}</td>\n";
						echo "<td><input type=\"button\" \n";
						echo 'onclick="deregister(\''.$row['class_id'].'\',\''.$row['subject'].' '.$row['code'].'-'.$row['section'].'\',\''.$row['subject'].'\')" ';
						echo "value=\"Deregister\" /></td></tr>\n";
					}
				}
			}
			echo "</table></center></form>";				
		?>
	</div>
	
	<div id = "footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
	</div>
</body>
</html>