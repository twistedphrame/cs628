<html>
    <head>
        <title>CS628</title>
    </head>
    <!-- body is a keyword -->
    <!-- don't put comments inside the style -->
	<link rel = "stylesheet" href = "includes/style.css" type = "text/css" media = "screen" />
	<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
</head>
    
    <!-- design layout
       grey
      - -  - - - - - - - - - - - - -  - 
        Monmouth Registration System {blue}
        ---------------------------
          User Name |            |
          Password  |            | {white}
          
               button->Login
        ---------------------------
        Copyright     {blue}
      ---------------------------------
      {grey}
    -->
    <body>

      <div id="container">
        <?php include("includes/header_admin.html"); ?>
        <?php include("htmlTricks.php"); ?>
        <div id="main">
            <div align="center">
             <?php
               $SUBJ_STRING = "subject";
               $CODE_STRING = "code";
               $SECTION_STRING = "section";
               $NAME_STRING = "name";
               $SCHEDULE_STRING = "schedule";
               $PROFESSOR_STRING = "professor";
               $ROOM_STRING = "room";             
             ?>
                
                <h1>Edit Class</h1>
            <?php
                session_start();
     
                //if (empty($_SESSION['uname'])){
                if (empty($_COOKIE['uname'])) {
                  header('LOCATION: index_3.php');
                  //echo "<script>window.open('index_3.php', '_SELF')</script>";
                }
                
                $class_id ='';
                if(isset($_GET['class_id'])) {
                    $class_id = $_GET['class_id'];
                    include("dbc.php");
                    $q = "SELECT * FROM classes WHERE class_id='{$_GET['class_id']}';";
                    $r = mysqli_query($dbc, $q);
                    if($r) {
                        $row = mysqli_fetch_assoc($r);
                        $subject = $row[$SUBJ_STRING];
                        $code = $row[$CODE_STRING];
                        $section = $row[$SECTION_STRING];
                        $name = $row[$NAME_STRING];
                        $schedule = $row[$SCHEDULE_STRING];
                        $prof = $row[$PROFESSOR_STRING];
                        $room = $row[$ROOM_STRING];
                    } else {
                        die ("Class could not be found try again later.");
                    }
                }
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $success = '';
                    $subject = (isset($_POST[$SUBJ_STRING]) ? $_POST[$SUBJ_STRING] : '');
                    $code = (isset($_POST[$CODE_STRING]) ? $_POST[$CODE_STRING] : '');
                    $section = (isset($_POST[$SECTION_STRING]) ? $_POST[$SECTION_STRING] : '');
                    $name = (isset($_POST[$NAME_STRING]) ? $_POST[$NAME_STRING] : '');
                    $schedule = (isset($_POST[$SCHEDULE_STRING]) ? $_POST[$SCHEDULE_STRING] : '');
                    $prof = (isset($_POST[$PROFESSOR_STRING]) ? $_POST[$PROFESSOR_STRING] : '');
                    $room = (isset($_POST[$ROOM_STRING]) ? $_POST[$ROOM_STRING] : '');
                    
                    $errors = array();
                    if(empty($subject)) {
                        $errors[$SUBJ_STRING] = "Subject must be Specified";
                    } else {
                        $errors[$SUBJ_STRING] = '';
                    }
                    if(empty($code)) {
                        $errors[$CODE_STRING] = "Code must be specified";
                    } else {
                        $errors[$CODE_STRING] = '';
                    }
                    
                    if(empty($section)) {
                        $errors[$SECTION_STRING] = "Section must be specified";
                    } else {
                        $errors[$SECTION_STRING] = '';
                    }
                    
                    if(empty($name)) {
                        $errors[$NAME_STRING] = "Name must be specified";
                    } else {
                        $errors[$NAME_STRING] = '';
                    }
                    
                    if(empty($schedule)) {
                        $errors[$SCHEDULE_STRING] = "Schedule must be specified";
                    } else {
                        $errors[$SCHEDULE_STRING] = '';
                    }
                    
                    if(empty($prof)) {
                        $errors[$PROFESSOR_STRING] = "Professor must be specified";
                    } else {
                        $errors[$PROFESSOR_STRING] = '';
                    }
                    
                    if(empty($room)) {
                        $errors[$ROOM_STRING] = "Room must be specified";
                    } else {
                        $errors[$ROOM_STRING] = '';
                    }
                    $valid = true;
                    foreach($errors as $error) {
                        if(!empty($error)) {
                            $valid = false;
                            break;
                        }
                    }
                    
                    if($valid) {              
                        //update query
                        $q = "Update classes SET subject='$subject',
                                                code='$code',
                                                section='$section',
                                                name='$name',
                                                schedule='$schedule',
                                                professor='$prof',
                                                room='$room'
                                            WHERE class_id='$class_id'";
                        //execute the query
                        $r = mysqli_query($dbc, $q);
                        //check to make sure it's there
                        if($r) {                            
                            $success = "Class: $subject $code-$section has been updated";
                        } else {
                            $success = '';
                        }
                    }
                    
                }
            ?>
            
            
            <!-- we want to create a form here -->
            <!-- method how to transfer data to server
                 post = usually for forms - more secure
                 get = get adds data to URL so it is less secure
                 -->
            <form action="" method="POST">
                <table style = "padding-top: 10px; ">
                    <tr>
                        <td>Subject:</td>
                        <td>
                            <div style="color: red">
                            <?php //Drop down in PHP
                              createDropDown($SUBJ_STRING, concentrations(), (isset($subject) ? $subject: ''));
                              if(isset($errors[$SUBJ_STRING])) {
                                echo $errors[$SUBJ_STRING];
                              }
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Code:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                                echo '"'.$CODE_STRING.'" value=';                                
                                echo "\"".(isset($code) ? $code:"")."\""; ?> />
                            <?php
                                if(isset($errors[$CODE_STRING]))
                                    echo $errors[$CODE_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Section:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                                echo '"'.$SECTION_STRING.'" value=';
                                echo "\"".(isset($section) ? $section:"")."\""; ?> />
                            <?php
                                if(isset($errors[$SECTION_STRING]))
                                    echo $errors[$SECTION_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <td>Name:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                                echo '"'.$NAME_STRING.'" value=';
                               echo "\"".(isset($name) ? $name:"")."\""; ?> />
                            <?php
                                if(isset($errors[$NAME_STRING]))
                                    echo $errors[$NAME_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Schedule</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                                 echo '"'.$SCHEDULE_STRING.'" value=';
                                echo "\"".(isset($schedule) ? $schedule:"")."\""; ?> />
                            <?php
                                if(isset($errors[$SCHEDULE_STRING]))
                                    echo $errors[$SCHEDULE_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Professor</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                              echo '"'.$PROFESSOR_STRING.'" value=';
                              echo "\"".(isset($prof) ? $prof:"")."\""; ?> />
                            <?php
                                if(isset($errors[$PROFESSOR_STRING]))
                                    echo $errors[$PROFESSOR_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Room</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name=
                            <?php
                                echo '"'.$ROOM_STRING.'" value=';
                                echo "\"".(isset($room) ? $room:"")."\""; ?> />
                            <?php
                                if(isset($errors[$ROOM_STRING]))
                                    echo $errors[$ROOM_STRING];
                            ?>
                            </div>
                        </td>
                    </tr>
                 </table>
                <div style="padding: 5px;" align="center">
                    <table style="width:100%">
                        <tr>
                            <td align="right">
                              <input type="button" onclick="parent.location='edit_classes.php'" value='Back' />
                            </td>
                            <td>
                                <input type="submit" name="button" value="Update"/>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                  if(!empty($success)) {
                                    echo '<div style="color: black;">'.$success.'</div>';
                                  }
                                  else {
                                    echo '<div style="color: red;">Class could not be updated</div';
                                  }
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            </div>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>