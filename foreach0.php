<?php
$arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
    echo $value . "\n";
}
// $arr is now array(2, 4, 6, 8)
print_r($arr);
?>
