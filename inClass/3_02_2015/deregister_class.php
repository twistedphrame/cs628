<?php
  session_start();
  if (empty($_COOKIE['uname'])) {
    header('LOCATION: index_3.php');
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("dbc.php");
    
    $q = "DELETE FROM registration WHERE uname='{$_COOKIE['uname']}' AND class_id='{$_POST['classid']}';";
    
    $r = mysqli_query($dbc, $q);
      if($r) {
        echo "Deregistered Class";
      } else {
        die("Could not register for class with id: " + $_POST['classid']);          
      }
  }
?>