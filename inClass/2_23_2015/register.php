<html>
    <head>
        <title>CS628</title>
    </head>
    <!-- body is a keyword -->
    <!-- don't put comments inside the style -->
    <style>        
        body {background-color: grey;}
        #container {width: 800px; background-color: white;}
        #header {height: 70px; line-height: 70px; background-color: blue; color: white;}
        #main {background-color: white; height: 400px}
        #footer {height: 30px; line-height: 30px; background-color: blue; color: white;}
        table { padding-left: 200px;}
    </style> <!-- height == line-height vertically centers the text -->
    
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
        <div id="header" >
            <!-- inside the header you could also use
            style="padding:20px 100px" -->
            <h1 align="center"> Monmouth University Registration System</h1>
        </div>
        
        <div id="main">
            <div style="color: red;" align="center">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $uname = (isset($_POST['uname']) ? $_POST['uname'] : '');
                    $psword = (isset($_POST['psword']) ? $_POST['psword'] : '');
                    $psword2 = (isset($_POST['psword2']) ? $_POST['psword2'] : '');
                    $fname = (isset($_POST['fname']) ? $_POST['fname'] : '');
                    $lname = (isset($_POST['lname']) ? $_POST['lname'] : '');
                    $major = (isset($_POST['major']) ? $_POST['major'] : '');
                    $address = (isset($_POST['address']) ? $_POST['address'] : '');
                    $city = (isset($_POST['city']) ? $_POST['city'] : '');
                    $state = (isset($_POST['state']) ? $_POST['state'] : '');
                    $email = (isset($_POST['email']) ? $_POST['email'] : '');
                    $phone = (isset($_POST['phone']) ? $_POST['phone'] : '');
                    
                    $_SESSION['errors'] = array();
                    if(empty($uname)) {
                        $_SESSION['errors'][] = "User Name must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    if(empty($psword)
                       || empty($psword2)) {
                        $_SESSION['errors'][] = "Password must be specified";
                    } elseif (!($psword === $psword2)) {
                        $_SESSION['errors'][] = "Passwords do not match";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($fname)) {
                        $_SESSION['errors'][] = "First Name must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($lname)) {
                        $_SESSION['errors'][] = "Last Name must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($address)) {
                        $_SESSION['errors'][] = "Address must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($city)) {
                        $_SESSION['errors'][] = "City must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($email)) {
                        $_SESSION['errors'][] = "Email must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    if(empty($phone)) {
                        $_SESSION['errors'][] = "Email must be specified";
                    } else {
                        $_SESSION['errors'][] = '';
                    }
                    
                    $valid = true;
                    foreach($_SESSION['errors'] as $error) {
                        if(!empty($error)) {
                            $valid = false;
                            break;
                        }
                    }
                    
                    if($valid) {
                      //or die shows an message when that does not work
                        $dbc = mysqli_connect('localhost', 'webuser', 'webuser', 'registration')
                            or die("Cannot connect to database");
                        
                        //Insertion query
                        $q = "INSERT INTO users (uname,
                                                psword,
                                                fname,
                                                lname,
                                                major,
                                                address,
                                                city,
                                                state,
                                                email,
                                                phone) VALUES
                                               ('$uname',
                                                '$psword',
                                                '$fname',
                                                '$lname',
                                                '$major',
                                                '$address',
                                                '$city',
                                                '$state',
                                                '$email',
                                                '$phone')";
                        
                        //execute the query
                        $r = mysqli_query($dbc, $q);
                        //check to make sure it's there
                        if($r) {
                           echo "Record was inserted to db"; 
                        } else {
                            echo "Something went wrong.";
                        }
                    }
                    
                }
            ?>
            </div>
            
            <!-- we want to create a form here -->
            <!-- method how to transfer data to server
                 post = usually for forms - more secure
                 get = get adds data to URL so it is less secure
                 -->
            <form action="" method="POST">
                <table style = "padding-top: 10px;">
                    <tr>
                        <td>User Name:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="uname" value=
                            <?php echo "\"".(isset($_POST['uname']) ? $_POST['uname']:"")."\""; ?> />
                            <?php
                             if(isset($_SESSION['errors']))
                                echo $_SESSION['errors'][0];
                            ?>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <div style="color: red">
                            <input type="password" name="psword"  />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][1];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="psword2" />
                        </td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="fname" value=
                            <?php echo "\"".(isset($_POST['fname']) ? $_POST['fname']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][2];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <td>Last Name:</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="lname" value=
                            <?php echo "\"".(isset($_POST['lname']) ? $_POST['lname']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][3];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Major:</td>
                        <td>
                            <?php //Drop down in PHP 
                              $majors = array("MA","CS","SE","EN","HS","BM");
                              echo "<select name=\"major\" >";
                              $maj = (isset($_POST['major']) ? $_POST['major']: '');
                              foreach ($majors as $major) {
                                echo '<option value="'.$major.'"';
                                if($maj == $major) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$major.'</option>';
                              }
                              echo "</select>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="address" value=
                            <?php echo "\"".(isset($_POST['address']) ? $_POST['address']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][4];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="city" value=
                            <?php echo "\"".(isset($_POST['city']) ? $_POST['city']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][5];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        
                        <td><?php //Drop down in PHP 
                              $states = array("NJ","PA","FL","MN","MO","NY");
                              echo "<select name=\"state\">";
                              $stat = (isset($_POST['state']) ? $_POST['state']: '');
                              foreach ($states as $state) {
                                echo '<option value="'.$state.'"';
                                if($stat == $state) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$state.'</option>';
                              }
                              echo "</select>";
                            ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="email" value=
                            <?php echo "\"".(isset($_POST['email']) ? $_POST['email']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][6];
                            ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <div style="color: red">
                            <input type="text" name="phone" value=
                            <?php echo "\"".(isset($_POST['phone']) ? $_POST['phone']:"")."\""; ?> />
                            <?php
                                if(isset($_SESSION['errors']))
                                    echo $_SESSION['errors'][7];
                            ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <div style="padding: 5px 180px;">
                    <table>
                        <tr>
                            <td>
                              <input type="button" onclick="parent.location='index_1.php'" value='Back' />
                            </td>
                            <td>
                                <input type="submit" name="button" value="Register"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>