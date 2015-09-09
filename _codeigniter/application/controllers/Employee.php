<?php

class employee extends CI_Controller {

    function GetAll(){
	    $this->load->model('employee_model');
		$data['query']=$this->employee_model->employee_getall();
		$this->load->view('employee_viewall',$data);
	}
	
    function Get(){
	    $this->load->model('employee_model');
		$data['query']=$this->employee_model->employee_get();
		$this->load->view('employee_view',$data);
	}
	
}
?>