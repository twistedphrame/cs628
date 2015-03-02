<html>
<head>
	<title>CS628--Week1</title>
	<style>
		body {background-color: grey;}
		#container {width: 800px; background-color: white;}
		#header {height: 70px; background-color: blue; color: white;}
		#main {height: 350px; background-color: white;}
		#footer {height: 30px; background-color: blue; color: white}
		table {padding: 50px 280px;}
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
			$uname= $_POST['uname'];
			$psword= $_POST['psword'];
			$major= $_POST['major'];
			$gender= $_POST['gender'];
			
			echo $major;
			echo $gender;
			
			
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
				<tr>
					<td>Major:</td>
					<td>
						<?php
							$major=array("MA", "CS", "SE", "EN", "HS", "BM");
							echo '<select name="major">';
							foreach($major as $mj){
								echo '<option value="'.$mj.'">'.$mj.'</option>';	
							}
							
							echo '</select>';
						
						?>
						<!--  comment out html code
						<select name="uname">
							<option value="Math">Math</option>	
							<option value="CS">CS</option>	
							<option value="SE">SE</option>	
							<option value="EN">EN</option>	
							<option value="HS">Hs</option>	
						</select>	
						-->	
					</td>					
				</tr>
				
				<tr>
					<td>Gender:</td>
					<td><input type="radio" name="gender" value="Male">Male
						<input type="radio" name="gender" value="Female">Female
					</td>	
				</tr>
			</table>
			<div style="padding: 0px 350px" >
				<input type="submit" value="Login" >
			</div>
		</form>
	</div>
	
	<div id="footer">
		<p style = "padding: 10px 250px; font-size: 12px">Copyright 2015 Monmouth University</p> 
	</div>

</div>

</body>
</html>






