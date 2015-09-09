<?php

// Step 0: ----- Set variables from HTML form 
$name = $_POST["name"];
$email = $_POST["email"];

// Step 1: ----- Connect to database -----
$hostname="localhost";
$username="gpcorser";
$password="remember";
$dbname="gpcorser";
$usertable="table01";
$con = mysql_connect($hostname,$username, $password) 
  or die ("<html><script language='JavaScript'>alert('Cannot connect.'),history.go(-1)</script></html>");
mysql_select_db($dbname);

// Step 2: ----- Check if any records in table -----
$query = "SELECT * FROM $usertable";
$result = mysql_query($query);

// Step 3: ----- If records, print name field and add another random record
if($result) { // if $result is empty there is no output and no message
  while($row = mysql_fetch_array($result)){
    $val1 = $row[1];
	$val2 = $row[2];
    echo "Name: ".$val1." Email: ".$val2."<br>"; // generates html code
  }

  $query = "INSERT INTO $dbname.$usertable (`id`, `name`, `email`) VALUES (NULL, '$name', '$email')";
  $result2 = mysql_query($query);
  printf("Last inserted record has id %d\n", mysql_insert_id());
  echo "<br>Done<br>";
}
?>