<?php
     
class Create_job extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();    
        $this->load->helper('url');
    }
       

    public function index()
    {
        $this->load->view('create_job');
    }

    public function add_job()
    {
        $data = $_POST;

        
        $this->paint_jobs_model->add_job($data);

        redirect('Create_job');
       
    }

    
}