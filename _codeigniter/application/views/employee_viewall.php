<?php 
foreach($query as $row){
    print $row->id;
	print " ";
    print $row->name;
	print " ";
    print $row->city;
    print "<br>";
}
?>