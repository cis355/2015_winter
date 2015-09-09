<?php
// adapted from PHPEveryDay
// http://www.phpeveryday.com/articles/CodeIgniter-Creating-and-Sending-Parameters-Between-Controller-and-View-P151.html
  
class Hello extends CI_Controller {

   var $name;
   var $color;

   function __construct() { // use this instead of "function Hello()"
      parent::__construct();
	  $this->name = 'Andi';
	  $this->color = 'green';
   }

   function you($firstname='',$lastname='') {
      $data['name'] = 
	      ($firstname) ? $firstname . ' ' . $lastname : $this->name;
	  $data['color'] = $this->color;
      $this->load->view('you_view', $data);
   }
}

?>