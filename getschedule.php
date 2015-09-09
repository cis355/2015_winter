<?php
# filename : getschedule.php author : george corser (cis355) overview : 
# print fomatted output from a JSON object get data from SVSU API
$json = file_get_contents('https://api.svsu.edu/courses?prefix=CIS'); 
$json2 = file_get_contents('https://api.svsu.edu/courses?prefix=CS'); 
$json3 = 
file_get_contents('https://api.svsu.edu/courses?prefix=CIS&courseNumber=355');
# echo $json; convert JSON to PHP variable
$obj = json_decode($json); $obj2 = json_decode($json2); $obj3 = 
json_decode($json3);
# print_r($obj); var_dump($obj);
$printall = 1; if ($printall){
  
# print CIS listings
foreach ( $obj->courses as $course ) {
  # print each course listing (prefix, courseNumber, prerequisites)
  echo $course->prefix . " " . $course->courseNumber .
    "... REQ: " . $course->prerequisites. $course->term . "-";
    
    # print each course listing (days, startTime)
    foreach($course->meetingTimes as $mtimes)
      echo $mtimes->days. "-". $mtimes->startTime.  " \n";
}
# print CS listings
foreach ( $obj2->courses as $course ) {
  # print each course listing (prefix, courseNumber, prerequisites)
  echo $course->prefix . " " . $course->courseNumber .
    "... REQ: " . $course->prerequisites. $course->term . "-";
    
    # print each course listing (days, startTime)
    foreach($course->meetingTimes as $mtimes)
      echo $mtimes->days. "-". $mtimes->startTime.  " \n";
}
# print CIS 355 listings
foreach ( $obj3->courses as $course ) {
  # print each course listing (prefix, courseNumber, prerequisites)
  echo $course->prefix . " " . $course->courseNumber .
    "... REQ: " . $course->prerequisites. $course->term . "-";
    
    # print each course listing (days, startTime)
    foreach($course->meetingTimes as $mtimes)
      echo $mtimes->days. "-". $mtimes->startTime.  " \n";
}
} # end if(printall)
?>
