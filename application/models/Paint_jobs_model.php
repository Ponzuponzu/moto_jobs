<?php

class Paint_jobs_model extends CI_Model {
	
    public function __construct(){
       parent::__construct();
       $this->load->database(); 
    }

    public function get_jobs($condition = null)
    {
        $jobs = $this->db->get_where('paint_job', ['status' => null], 5)->result_array();

        return $jobs;
    }

    public function get_queue_jobs($condition = null)
    {
        $jobs = $this->db->get_where('paint_job', ['status' => null])->result_array();
        if(isset($jobs[0])) unset($jobs[0]);
        if(isset($jobs[1])) unset($jobs[1]);
        if(isset($jobs[2])) unset($jobs[2]);
        if(isset($jobs[3])) unset($jobs[3]);
        if(isset($jobs[4])) unset($jobs[4]);
        return $jobs;
    }

    public function set_complete_status($plate_no)
    {

        try{
            $this->db->where('plate_no', $plate_no);
            $this->db->update('paint_job',['status' => "Complete"]);
      
        }catch(Exception $e){

        }
    }

    public function get_summary()
    {
        
        $summary = $this->db->select('count(id) as total, sum(case target_color when "Red" then 1 else 0 end) as red, sum(case target_color when "Green" then 1 else 0 end) as green, sum(case target_color when "Blue" then 1 else 0 end)  as blue')->get_where('paint_job', ['status' => 'Complete'], 5)->result_array();

        return $summary;
    }


    public function add_job($data)
    {
        try{
            $this->db->insert('paint_job', $data);
        }catch(Exception $e){

        }
    }
}
