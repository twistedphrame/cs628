<?php
  session_start();
  if (empty($_COOKIE['uname'])) {
    header('LOCATION: index_3.php');
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("dbc.php");
    
    $q = "INSERT INTO registration (uname, class_id) VALUES ('{$_COOKIE['uname']}','{$_POST['classid']}');";
    
    $r = mysqli_query($dbc, $q);
      if($r) {
        echo "Registered Class";
      } else {
        die("Could not register for class with id: " + $_POST['classid']);          
      }
  }
?>