<?php
  session_start();
  if (empty($_COOKIE['uname'])) {
    header('LOCATION: index_3.php');
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("dbc.php");
    $q = 'DELETE FROM classes WHERE class_id=\''.$_POST['classid'].'\';';
    $r = mysqli_query($dbc, $q);
      if($r) {
        echo "Deleted Class";
      } else {
        die("Could not delete class with id: " + $_POST['classid']);          
      }
  } else {
    if($_COOKIE['role']==="admin") {
				include("admin.php");
			} else {
				include("student.php");
			}
  }
?>