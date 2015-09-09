<?php
  $fileAsString = file_get_contents("gpc_notes.txt");
  $f = fopen("gpc_notes.txt","r");
  $ln = 0;
  while ($line = fgets($f))
  {
    $ln++;
    printf("%2d: ", $ln);
    echo $line;
  }
  print_r($_SERVER);
?>
