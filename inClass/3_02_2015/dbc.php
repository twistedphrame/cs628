<?php
  //  $dbc = mysqli_connect('localhost', "root", "huntin", "reg2")
		//													or die("cannot connect to database.");
                                
    $dbc = mysqli_connect('localhost', "s0626532", "iedooW5I", "s0626532")
  or die("cannot connect to database.");
  
  function registeredClassIDs($dbc) {
    $q = "SELECT class_id FROM registration WHERE uname='{$_COOKIE['uname']}';";
    $r = mysqli_query($dbc, $q);
    $classIDs = array();
    if($r) {
      while ($row = mysqli_fetch_assoc($r)) {
        $classIDs[] = $row['class_id'];						
      }
    }
    return $classIDs;
  }
?>