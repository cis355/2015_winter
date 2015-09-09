<?php

/* filename: example.php
 * author  : george corser
 * course  : cis 355 (summer 2015)
 * purpose : this program demonstrates the use of reference variable in foreach loop
 * source  : modified from http://php.net/manual/en/control-structures.foreach.php
 * design  : 1. initialize array
 *           2. loop through each array element using a reference variable
 *              2a. multiply each array element by 2, updating array with new value
 *              2b. print the new value
 */

$arr = array(1, 2, 3, 4);   // initialize array
$before = "";
$after  = "";
foreach ($arr as &$value) { // use & to indicate reference variable
    $before = $before . " " . $value;
    $value  = $value * 2;    // now $arr is updated when using $value
    $after  = $after  . " " . $value;
    // echo $value . " ";      // print out new array value
}
echo "before: " . $before . "\n";
echo "after : " . $after;
// $arr is now array(2, 4, 6, 8)

?>

