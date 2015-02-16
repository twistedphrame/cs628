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
                    $uname = (isset($_POST['uname']) ? $_POST['uname'] : '');
                    $psword = (isset($_POST['psword']) ? $_POST['psword'] : '');
                    $psword2 = (isset($_POST['psword2']) ? $_POST['psword2'] : '');
                    $fname = (isset($_POST['fname']) ? $_POST['fname'] : '');
                    $lname = (isset($_POST['$lname']) ? $_POST['$lname'] : '');
                    $major = (isset($_POST['major']) ? $_POST['major'] : '');
                    $address = (isset($_POST['address']) ? $_POST['address'] : '');
                    $city = (isset($_POST['city']) ? $_POST['city'] : '');
                    $state = (isset($_POST['state']) ? $_POST['state'] : '');
                    $email = (isset($_POST['email']) ? $_POST['email'] : '');
                    $phone = (isset($_POST['$phone']) ? $_POST['$phone'] : '');
                    
                    //1) make sure that everything has a value
                    //2) psword and psword2 match
                    //3) psword is 'good' A-Za-Z0-9 etc
                    //4) validate email
                    //5) validate phone                    
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
                            <input type="text" name="uname" value=
                            <?php echo "\"".(isset($_POST['uname']) ? $_POST['uname']:"")."\""; ?> />
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="psword"  />
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
                            <input type="text" name="fname" value=
                            <?php echo "\"".(isset($_POST['fname']) ? $_POST['fname']:"")."\""; ?> />
                        </td>
                    </tr>
                    <tr>
                    <td>Last Name:</td>
                        <td>
                            <input type="text" name="lname" value=
                            <?php echo "\"".(isset($_POST['lname']) ? $_POST['lname']:"")."\""; ?> />
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
                            <input type="text" name="address" value=
                            <?php echo "\"".(isset($_POST['address']) ? $_POST['address']:"")."\""; ?> />
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <input type="text" name="city" value=
                            <?php echo "\"".(isset($_POST['city']) ? $_POST['city']:"")."\""; ?> />
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
                            <input type="text" name="email" value=
                            <?php echo "\"".(isset($_POST['email']) ? $_POST['email']:"")."\""; ?> />
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" name="phone" value=
                            <?php echo "\"".(isset($_POST['phone']) ? $_POST['phone']:"")."\""; ?> />
                        </td>
                    </tr>
                </table>
                <div style="padding: 5px 410px;">
                    <input type="submit" name="button" value="register"/>
                </div>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>