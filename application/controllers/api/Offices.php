<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Offices extends REST_Controller {

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
        $offices = $this->Offices_model->get_offices();
        foreach ($offices as $key => $office) {
            $employees = $this->Employees_model->get_Employees(['officeCode'=> $office['officeCode']]);
            $offices[$key]['employees'] = $employees;
        }

        $this->response($offices, REST_Controller::HTTP_OK);
	}
      
}