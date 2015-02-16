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
                  #the form was submitted!
                  $uname = $_POST['uname'];
                  $psword = $_POST['psword'];
                  
                  $errors = array();
                  if (empty($uname)) {
                    //= adds to the end of the array
                    // += doesn't do that correct
                    $errors[] = "You forgot to enter the user name.";
                  }
                  if (empty($uname)) {
                    $errors[] = "You forgot to enter the password.";
                  }
                  
                  if (empty($errors)) {
                     //alls good so do good things
                  } else {
                    //print error information
                    foreach ( $errors as $error) {
                        echo "$error";
                        echo "<br>";
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
                        <td><input type="text" name="uname"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="psword" /></td>
                    </tr>
                </table>
                <div style="padding: 5px 410px;">
                    <input type="submit" value="Login"/>
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
                <div style="padding: 5px 320px;">
                    <input type="submit" value="Register"/>
                </div>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>