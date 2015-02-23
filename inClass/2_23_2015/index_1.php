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
        #main {background-color: white; height: 300px}
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
                  if($_POST['button'] == 'Login') {
                    #the form was submitted!
                    #isset makes sure its there so we don't get a bunch of errors
                    $uname = (isset($_POST['uname']) ? $_POST['uname'] : '');
                    $psword = (isset($_POST['psword']) ? $_POST['psword'] : '');
                    
                    $errors = array();
                    if (empty($uname)) {
                      //= adds to the end of the array
                      // += doesn't do that correct
                      $errors[] = "You forgot to enter the user name.";
                    } else {
                      $errors[] = '';
                    }
                    if (empty($psword)) {
                      $errors[] = "You forgot to enter the password.";
                    } else {
                      $errors[] = '';
                    }
                    
                    $valid = true;
                    foreach ($errors as $err) {
                        if(!empty($err)) {
                            $valid = false;
                        }
                    }
                    if ($valid) {
                       //alls good so do good things
                       //we can log in.
                       //Connect DB
                       $dbc = mysqli_connect('localhost', 'webuser', 'webuser', 'registration')
                                             or die("Cannot connect to database");
                        // search user table to find the user
                        $q = "SELECT * FROM users WHERE uname = '$uname'";
                        //perform select
                        $result = mysqli_query($dbc, $q);
                        //how many rows did we get?
                        $num = mysqli_num_rows($result);
                        if($num == 1) { //found the user
                            //will only be one user/record returned
                            $row = mysqli_fetch_array($result);
                            if ($row['psword'] == SHA1($psword)) {
                                //pass match so we can do things
                                echo "Password matches";
                                //jump to another user page and such
                                //But! we do session control FIRST!
                                //we can use $_SESSION var
                                // or we use a cookie
                                session_start();//the session started
                                $_SESSION['uname'] = $uname;//set session vars here
                                $_SESSION['fname'] = $row['fname']; //for a welcome msg or whater
                                $_SESSION['role'] = $row['role'];
                                
                                if ($row['role'] === "Student") {
                                    header("LOCATION: student.php");
                                } else { //It's an admin!
                                    header("LOCATION: admin.php");
                                }                                
                            } else {
                                $errors[0] = '';
                                $errors[1] = "Password is incorrect";
                            }
                        } else { //unknown user
                            $errors[0] = "Could not find user.";
                            $errors[1] = '';
                        }
                        //if found
                            // if password is correct, do some things
                            //else report incorrect pass
                    }
                  } else {
                    // We are registering
                    $role = (isset($_POST['role']) ? $_POST['role'] : '');
                    if(empty($role)) {
                      echo "You must select a role.<br>";
                    } else {
                      //display a new page for registration
                      //This is a GET call since info is held in the URL
                      header('LOCATION: register.php?role='.$role);
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
                <table style = "padding-top: 75px;">
                    <tr>
                        
                        <td>User Name:</td>
                        <td>
                            <div style ="color: red;">
                                <input type="text" name="uname">
                                <?php
                                  if (isset($errors)) {
                                    echo $errors[0];
                                  }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        
                        <td>Password:</td>
                        <td>
                            <div style ="color: red;">
                                <input type="password" name="psword" />
                                <?php
                                  if (isset($errors)) {
                                    echo $errors[1];
                                  }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <div style="padding: 5px 410px;">
                    <input type="submit" name="button" value="Login"/>
                </div>
            </form>
            <form  action="" method="POST">
                <table>
                    <tr>
                    <td>Role:</td>
                    <td>
                        <input type="radio" name="role" value="Admin">Admin</input>
                        <input type="radio" name="role" value="Student">Student</input>
                    </td>
                    </tr>
                </table>
                <div style="padding: 5px 320px;"> <!-- same name as the other button
                                                       so we can see the value on submit
                                                       to determine which form was submitted
                                                  -->
                    <input type="submit" name="button" value="Register"/>
                </div>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>