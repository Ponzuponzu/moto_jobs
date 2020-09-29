<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Sales_Report extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('api/Sales_Report_model');
       
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->Sales_Report_model->get_sales_report($id);
        }else{
            $data = $this->Sales_Report_model->get_sales_report();
        }

        $this->response($data, REST_Controller::HTTP_OK);
	}

    
      
}