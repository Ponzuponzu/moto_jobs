<?php

class Offices_model extends CI_Model {
	
	public function __construct(){
	   	parent::__construct();
  	}


    public function get_offices($condition = null)
    {
        $offices = $this->db->select('officeCode, city')->get_where("offices", $condition)->result_array();

        return $offices;
    }

}
