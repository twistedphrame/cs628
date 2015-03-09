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
        
        <div id="main">
            <div align="center">
            <?php
                session_start();
     
                //if (empty($_SESSION['uname'])){
                if (empty($_COOKIE['uname'])) {
                  header('LOCATION: index_3.php');
                  //echo "<script>window.open('index_3.php', '_SELF')</script>";
                }
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $success = '';
                    $subject = (isset($_POST['subject']) ? $_POST['subject'] : '');
                    $code = (isset($_POST['code']) ? $_POST['code'] : '');
                    $section = (isset($_POST['section']) ? $_POST['section'] : '');
                    $name = (isset($_POST['name']) ? $_POST['name'] : '');
                    $schedule = (isset($_POST['sched']) ? $_POST['sched'] : '');
                    $prof = (isset($_POST['prof']) ? $_POST['prof'] : '');
                    $room = (isset($_POST['room']) ? $_POST['room'] : '');
                    
                    $errors = array();
                    if(empty($subject)) {
                        $errors['subject'] = "Subject must be Specified";
                    } else {
                        $errors['subject'] = '';
                    }
                    if(empty($code)) {
                        $errors['code'] = "Code must be specified";
                    } else {
                        $errors['code'] = '';
                    }
                    
                    if(empty($section)) {
                        $errors['section'] = "Section must be specified";
                    } else {
                        $errors['section'] = '';
                    }
                    
                    if(empty($name)) {
                        $errors['name'] = "Name must be specified";
                    } else {
                        $errors['name'] = '';
                    }
                    
                    if(empty($schedule)) {
                        $errors['sched'] = "Schedule must be specified";
                    } else {
                        $errors['sched'] = '';
                    }
                    
                    if(empty($prof)) {
                        $errors['prof'] = "Professor must be specified";
                    } else {
                        $errors['prof'] = '';
                    }
                    
                    if(empty($room)) {
                        $errors['room'] = "Room must be specified";
                    } else {
                        $errors['room'] = '';
                    }
                    $valid = true;
                    foreach($errors as $error) {
                        if(!empty($error)) {
                            $valid = false;
                            break;
                        }
                    }
                    
                    if($valid) {
                      //or die shows an message when that does not work
                        $dbc = mysqli_connect('localhost', 'root', 'huntin', 'reg2')
                            or die("Cannot connect to database");
                        
                        //Insertion query
                        $q = "INSERT INTO classes (subject,
                                                code,
                                                section,
                                                name,
                                                schedule,
                                                professor,
                                                room) VALUES
                                               ('$subject',
                                                '$code',
                                                '$section',
                                                '$name',
                                                '$schedule',
                                                '$prof',
                                                '$room')";
                        
                        //execute the query
                        $r = mysqli_query($dbc, $q);
                        //check to make sure it's there
                        if($r) {
                            
                            $success = "Class: $subject $code-$section has been added";
                            $subject = '';
                            $code = '';
                            $section = '';
                            $name = '';
                            $schedule = '';
                            $prof = '';
                            $room = '';                           
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
                              $subjects = array("MA","CS","SE","EN","HS","BM");
                              echo "<select name=\"subject\" >";
                              $sub = (isset($subject) ? $subject: '');
                              foreach ($subjects as $subj) {
                                echo '<option value="'.$subj.'"';
                                if($sub == $subj) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$subj.'</option>';
                              }
                              echo "</select>";
                              if(isset($errors['subject']) && !empty($errors['subject'])) {
                                echo $errors['subject'];
                              }
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Code:</td>
                        <td>
                            <div style="color: red">
                            <input type="code" name="code" value =
                                   <?php echo "\"".(isset($code) ? $code:"")."\""; ?> />
                            <?php
                                if(isset($errors['code']))
                                    echo $errors['code'];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Section:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="section" value=
                            <?php echo "\"".(isset($section) ? $section:"")."\""; ?> />
                            <?php
                                if(isset($errors['section']))
                                    echo $errors['section'];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <td>Name:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="name" value=
                            <?php echo "\"".(isset($name) ? $name:"")."\""; ?> />
                            <?php
                                if(isset($errors['name']))
                                    echo $errors['name'];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Schedule</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="sched" value=
                            <?php echo "\"".(isset($schedule) ? $schedule:"")."\""; ?> />
                            <?php
                                if(isset($errors['sched']))
                                    echo $errors['sched'];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Professor</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="prof" value=
                            <?php echo "\"".(isset($professor) ? $professor:"")."\""; ?> />
                            <?php
                                if(isset($errors['prof']))
                                    echo $errors['prof'];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Room</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="room" value=
                            <?php echo "\"".(isset($room) ? $room:"")."\""; ?> />
                            <?php
                                if(isset($errors['room']))
                                    echo $errors['room'];
                            ?>
                            </div>
                        </td>
                    </tr>
                 </table>
                <div style="padding: 5px;" align="center">
                    <table>
                        <tr>
                            <td>
                              <input type="button" onclick="parent.location='admin.php'" value='Back' />
                            </td>
                            <td>
                                <input type="submit" name="button" value="Register"/>
                            </td>
                            <td>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                  if(!empty($success)) {
                                    echo '<div style="color: black;">'.$success.'</div>';
                                  }
                                  else {
                                    echo '<div style="color: red;">Class could not be added</div';
                                  }
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>