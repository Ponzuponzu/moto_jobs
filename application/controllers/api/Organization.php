<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Organization extends REST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        $data = $this->Employees_model->get_organization();
        
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
    
    	
}