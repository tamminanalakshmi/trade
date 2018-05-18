<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Vehicle_model');
        $this->load->model('Seller_model');
        header('Content-Type: application/json');
    }

    /*
    	@Author  :  Lakshmi Tamminana
    	Date     :  15/05/2018
    	Method   :  POST
    	Input    :  vehicle_type,keyword,low_range,high_range (can be optional)
    	Output   :  json array with vehicles list
    */

	public function index()
	{
        $conditons = array();
        $like      = array();
        // Vehicle type filter condition
        if($this->input->post('vehicle_type')) {
	       $conditons    = array_merge($conditons,array('vt.id' => $this->input->post('vehicle_type'))); 
        }

        // keyword filter condition
        if($this->input->post('keyword')) {
          $like =  array_merge($like,array('v.description' => $this->input->post('keyword')));
        }

        // price low range filter condition
       if($this->input->post('low_range')) {
	      $conditons    = array_merge($conditons,array('v.price >=' =>$this->input->post('low_range'))); 
        }

       // price high range filter condition
       if($this->input->post('high_range')) {
	      $conditons    = array_merge($conditons,array('v.price <=' =>$this->input->post('high_range'))); 
        }

       try{
            $vehicles = $this->Vehicle_model->getVehicles($conditons,$like);
            if (!$vehicles) {
            	throw new Exception('Vehicles not available with filter data');
            }
	        $data['success'] = true;
	        $data['message'] = "Success";
	        $data['vehicles'] = $vehicles;
  	     } catch (Exception $e) {
  	       $data['success'] = false;
           $data['message'] = $e->getMessage();
         }


       // output vehicles list using json array
       echo json_encode($data);
	}

	/*
    	@Author  :  Lakshmi Tamminana
    	Date     :  15/05/2018
    	Method   :  GET
    	Input    :  no input master data 
    	Output   :  return vehicle type for select box options
    */

	public function vehicleTypes()
	{
		try{
           $details = $this->Vehicle_model->getVehicleTypes();
           if(!$details) {
            	throw new Exception('Vehicle types not available');
            }
            $data['success']    = true;
            $data['message']    = "Success";
            $data['result']     = $details;
          } catch (Exception $e) {
  	       $data['success'] = false;
           $data['message'] = $e->getMessage();
         }
       echo json_encode($data);
	}


	/*
    	@Author  :  Lakshmi Tamminana
    	Date     :  15/05/2018
    	Method   :  GET
    	Input    :  id (vehicle id) Mandatory 
    	Output   :  return details of particular vehicle
    */

	public function vehicleDetails($id)
	{
		try{
             if($id <= 0){
             	throw new Exception('Wrong parameter given as input');
             }
             $details = $this->Vehicle_model->getVehicleDetails($id);
             if(!$details['vehicle_details']) {
            	throw new Exception('Vehicle details not available');
             }
               $data['success']    = true;
               $data['message']    = "Success";
               $reviews = $this->Seller_model->getSellerDetails($id);
               $data['details']  = array_merge($details,$reviews);  
        }catch (Exception $e) {
  	       $data['success'] = false;
           $data['message'] = $e->getMessage();
         }
        echo json_encode($data);
	}
}

?>