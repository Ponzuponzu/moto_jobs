<?php

class Employees_model extends CI_Model {
	
    public function __construct(){
       parent::__construct();
    }
    
    public function get_organization()
    {
    	$organization_data = array();
    	$heads = $this->get_employees(['reportsTo' => null]);

    	$data = $this->get_under($heads);
        
        return $data;
    }

    public function get_employees($condition = null)
    {
        $employees = $this->db->select('employeeNumber, CONCAT(firstName, " ", lastName) as name, jobTitle')->get_where("employees", $condition)->result_array();

        return $employees;
    }


    public function get_under($heads)
    {   
        $allUnders = [];
        if(count($heads) > 0){
            foreach ($heads as $key => $employee) {
                $unders = $this->get_employees(['reportsTo' => $employee['employeeNumber']]);
                if(count($unders) > 0){
                    $heads[$key]['employeeUnder'] = $this->get_under($unders);
                    
                }else{
                    $heads[$key]['employeeUnder'] = [];
                }
                $allUnders = $heads;
            }
        }

        return $allUnders;
    }
}
