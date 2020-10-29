<?php
     
class Paint_jobs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();    
        $this->load->helper('url');
    }
       

    public function index()
    {

        
        $this->load->view('paint_jobs');
    }

    public function get_active_jobs()
    {
     
        $jobs = $this->paint_jobs_model->get_jobs();
        $arr = [];
        foreach ($jobs as $key => $job) {
            $arr[] = [
                $job['plate_no'], 
                $job['current_color'], 
                $job['target_color'],
                "<a class='complete_job' href='complete_job' data-plate_no='{$job['plate_no']}'>Mark as Complete</a>"
            ];
        }
        $data = array('data'=> $arr);

        echo json_encode($data);

        exit();
    }

    public function get_queue_jobs()
    {
     
        $jobs = $this->paint_jobs_model->get_queue_jobs();
        $arr = [];
        foreach ($jobs as $key => $job) {
            $arr[] = [
                $job['plate_no'], 
                $job['current_color'], 
                $job['target_color'],
            ];
        }
        $data = array('data'=> $arr);

        echo json_encode($data);

        exit();
    }

    public function complete_job()
    {
     
        $plate_no = $_POST['plate_no'];
        $this->paint_jobs_model->set_complete_status($plate_no);

    }

    public function get_summary()
    {
     
        $data = $this->paint_jobs_model->get_summary();
        echo json_encode($data);

    }
}