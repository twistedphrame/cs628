<!DOCTYPE html PUBLIC "-//W3C// DTD XHTML 1/- Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"?
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="eng" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Concatination</title>
    </head>
    <body>
        <?php # Script 1.6 concat.php
    
          //Create variables
          $first_name = 'Melissa';
          $last_name = 'Bank';
          $author = $first_name . ' ' . $last_name;
          
          $book = 'The Girls\' Guide to Hunting and Fishing';
          
          //Print the values:
          echo "<p>The book <em>$book</em> was written by $author.</p>";
        
        ?>
    </body>
</html>