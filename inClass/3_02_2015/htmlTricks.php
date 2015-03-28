<?php
  /**
   * Creates a drop down with name $name, containing
   * the items in the array $items.  And sets the
   * item matching $selected as the selected item.
   */
  function createDropDown($name, $items, $selected) {
    echo "<select id=\"$name\" name=\"$name\" >";
    foreach ($items as $item) {
      echo '<option value="'.$item.'"';
      if($item === $selected) {
        echo ' selected = "selected"';
      }
      echo '>'.$item.'</option>';
    }
    echo "</select>";
  }
  
  /**
   * Returns an array of the various course types
   */
  function concentrations() {
    return array("MA","CS","SE","EN","HS","BM");
  }
  
  /**
   * Returns an array of the states.
   */
  function states() {
    return array("NJ","PA","FL","MN","MO","NY");
  }
  
?>