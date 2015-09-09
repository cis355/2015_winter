<?php
foreach (glob("*.php") as $filename)
{
    #include $filename;
    echo $filename;
}
?>
