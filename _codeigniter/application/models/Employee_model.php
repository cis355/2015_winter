<?php

class Employee_model extends CI_Model {

    // omit: function Employee_model() 

     function employee_getall() {
	     $this->load->database();
		 $query=$this->db->get('employee');
		 return $query->result();
	 }
	 
     function employee_get() {
	     $this->load->database();
		 $query=$this->db->get_where('employee',array('id'=>1));
		 # $query=$this->db->query('SELECT * FROM employee WHERE id=1');
		 return $query->row_array();
	 }

}
?>