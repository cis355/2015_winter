<?php
  $arr = array_keys($_POST);
  # echo $arr[0]; 
  
  define("hostname","localhost");
  define("username","student");
  define("password","learn");
  define("dbname","gpcorser");
  define("tableName","gpc_upload");

  //connect to mysql
  $con = mysql_connect(hostname, username, password) or die(mysql_error());
  //select the db
  
  $db = mysql_select_db(dbname, $con);
  	if($db){
		//the query to execute on the DB
		$query = "DELETE FROM ".tableName." WHERE id=".$arr[0];
		//execute or die
		mysql_query($query) or die('Error, query failed'); 
		//close the connection
		mysql_close();
		echo "<br>File deleted<br>";
	}
	else 
	{ 
		echo "file delete failed: ".mysql_error(); 
	}

?>