<?php

class Sales_report_model extends CI_Model {
	
	public function __construct(){
	   	parent::__construct();
  	}

  	public function get_sales_report($employeeNumber = null)
  	{	
  		//get total sales summary per employee
  		if($employeeNumber != null){
  			$where = "employees.employeeNumber = '{$employeeNumber}'";
  		}else{
  			$where = null;
  		}

  		$employeeTotalSalesSummary =  $this->get_sales("
	  			employees.employeeNumber, 
		  		CONCAT(employees.firstName,' ', employees.lastName) as name,
		  		employees.jobTitle,
		  		employees.officeCode,
		  		offices.city,
		  		ROUND(SUM((orderdetails.quantityOrdered * orderdetails.priceEach) * FLOOR(REPLACE(products.productScale, ':', '.')) / FLOOR((REPLACE(products.productScale, ':', '.') - 
		  		FLOOR(REPLACE(products.productScale, ':', '.')))  * 100) ),2)  as totalCommision,
		  		SUM(orderdetails.quantityOrdered * orderdetails.priceEach) as totalSales
		  		
	  		", 
	  		"employees.employeeNumber",
	  		$where
	  	);


  		foreach ($employeeTotalSalesSummary as $key => $employeeSales) {
  			//get total sales summary per productline
  			$employeeTotalSalesSummary[$key]['productLines'] = $this->get_sales("
		  			products.productLine, 
			  		productlines.textDescription,
			  		ROUND(SUM((orderdetails.quantityOrdered * orderdetails.priceEach) * FLOOR(REPLACE(products.productScale, ':', '.')) / FLOOR((REPLACE(products.productScale, ':', '.') - 
			  		FLOOR(REPLACE(products.productScale, ':', '.')))  * 100) ),2)  as commision,
			  		SUM(orderdetails.quantityOrdered) as quantity,
			  		SUM(orderdetails.quantityOrdered * orderdetails.priceEach) as sales,
			  	",
			  	"employees.employeeNumber, products.productLine",
			  	"employees.employeeNumber = '{$employeeSales['employeeNumber']}'"
	  		);
  			//get total sales summary per products
  			foreach ($employeeTotalSalesSummary[$key]['productLines'] as $key2 => $productline) {
  				$employeeTotalSalesSummary[$key]['productLines'][$key2]['products'] = $this->get_sales("
			  			products.productCode, 
				  		products.productName,
				  		SUM(orderdetails.quantityOrdered) as quantity,
				  		SUM(orderdetails.quantityOrdered * orderdetails.priceEach) as sales,
				  		COUNT(DISTINCT orders.customerNumber) as numberOfCustomerBought,
				  	",
				  	"employees.employeeNumber, products.productLine, products.productCode",
				  	"employees.employeeNumber = '{$employeeSales['employeeNumber']} ' AND products.productLine = '{$productline['productLine']}'"
		  		);

  			}
	  		
  		}

  		$data = $employeeTotalSalesSummary;
  		return $data;
  	}

    public function get_sales($select = '*', $group_by = null, $where = null)
    {
       
     	$data = $this->db->select($select)
            ->from('orders')
            ->join('orderdetails', 'orderdetails.orderNumber = orders.orderNumber')
            ->join('products', 'products.productCode = orderdetails.productCode')
            ->join('productlines', 'productlines.productLine = products.productLine')
            ->join('customers', 'customers.customerNumber = orders.customerNumber')
            ->join('employees', 'employees.employeeNumber = customers.salesRepEmployeeNumber')
            ->join('offices', 'offices.officeCode = employees.officeCode');

            if($where != null){
            	$data->where($where);
            }

            if($group_by != null){
	            $data->group_by($group_by);
            }

            $data = $data->get()->result_array();

        return $data;
    }
}
