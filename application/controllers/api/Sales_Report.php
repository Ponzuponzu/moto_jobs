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
        // $salesReps = $this->Employees_model->get_Employees(['jobTitle'=> 'Sales Rep']);



        // $data = $this->db->get("orders")->result();
        // $offices = $this->Offices_model->get_offices();
        // foreach ($offices as $key => $office) {
        //     $employees = $this->Employees_model->get_Employees(['officeCode'=> $office['officeCode']]);
        //     $offices[$key]['employees'] = $employees;
        // }

        $this->response($data, REST_Controller::HTTP_OK);
	}

    
      
}