<?php
// filename : foreach.php
// author   : george corser
// source: http://php.net/manual/en/control-structures.foreach.php
// date:    : 2015-06-17
// description: demonstrates "assign by reference"
//              in foreach loop
// design (program steps):
//  1. initialize array
//  2. print array
//  3. loop through array elements,
//       multiply by 2 and print each element on new line
//  4. print array again
//  5. unset the reference variable
$arr = array(1, 2, 3, 4); // 1. initialize an array
print_r($arr); // 2. print contents of array
foreach ($arr as &$value) { // 3. loop through each array element
    $value = $value * 2; // multiply each element by 2
    echo $value . "\n"; // print each element on new line
}
// $arr is now array(2, 4, 6, 8)
print_r($arr); // 4. print contents of array
unset($value); // 5. break the reference with the last element
?>
