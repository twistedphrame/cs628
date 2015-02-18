<html>
    <!--
        Jordan Apgar
        s0626532@monmouth.edu
        CS 628 - HW 1 - Spring 2015
    -->
    <head>
        <title>Calculator</title>
    </head>
    <!-- body is a keyword in the style -->
    <!-- don't put comments inside the style -->
    <style>        
        body {background-color: grey;}
        #container {width: 800px; background-color: white;}
        #header {height: 70px; line-height: 70px; background-color: blue; color: white;}
        #main {background-color: white; height: 300px}
        #footer {height: 30px; line-height: 30px; background-color: blue; color: white;}
        table { padding-left: 300px;}
    </style> <!-- height == line-height vertically centers the text -->
    <body>
      <div id="container">
        <div id="header" >
            <!-- inside the header you could also use
            style="padding:20px 100px" -->
            <h1 align="center"> A Simple Calculator </h1>
        </div>
        
        <div id="main">
            <form action="" method="POST">
                <table style = "padding-top: 50px;">
                    <tr>
                        <td><?php
                          $first = (isset($_POST['first']) ? $_POST['first'] : '');
                          $array = range(0,100);
                          echo "<select name=\"first\" >";
                          foreach ($array as $num) {
                            echo '<option value="'.$num.'"';
                                if($first == $num) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$num.'</option>';
                          }
                          echo "</select>";
                        ?></td>
                        <td><?php
                          $operator = (isset($_POST['operator']) ? $_POST['operator'] : '');
                          $opps = array("+","-","*","/");
                          echo "<select name=\"operator\" >";
                          foreach ($opps as $opp) {
                            echo '<option value="'.$opp.'"';
                                if($operator == $opp) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$opp.'</option>';
                          }
                          echo "</select>";
                        ?></td>
                        <td><?php
                          $second = (isset($_POST['second']) ? $_POST['second'] : '');
                          $array = range(0,100);
                          echo "<select name=\"second\" >";
                          foreach ($array as $num) {
                            echo '<option value="'.$num.'"';
                                if($second == $num) {
                                    echo ' selected = "selected"';
                                }
                                echo '>'.$num.'</option>';
                          }
                          echo "</select>";
                        ?></td>
                        <td><input type="submit" name="button" value="="/></td>
                        <td> <!-- result area so handle forms POSTing here -->
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $first = (isset($_POST['first']) ? $_POST['first'] : '');
                                    $operator = (isset($_POST['operator']) ? $_POST['operator'] : '');
                                    $second = (isset($_POST['second']) ? $_POST['second'] : '');
                                    if($operator == "+") {
                                        echo ($first + $second);
                                    } elseif($operator =="-") {
                                        echo ($first - $second);
                                    } elseif($operator == "*") {
                                      echo ($first * $second);
                                    } else {
                                        if($second != "0") {
                                          echo ($first / $second);
                                        } else {
                                            echo '<div style="color: red;" align="center">';
                                            echo "Cannot divide by zero";
                                            echo '</div>';
                                        }
                                        //divide
                                    }
                                    
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="footer">
            <h5 align="center">Copyright 2015 Monmouth University</h5>
        </div>
      </div>
    </body>
</html>