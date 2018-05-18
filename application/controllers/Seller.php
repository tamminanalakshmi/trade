<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Seller_model');
        header('Content-Type: application/json');
    }

	/*
    	@Author  :  Lakshmi Tamminana
    	Date     :  16/05/2018
    	Method   :  POST
    	Input    :  seller_id,message Mandatory
    	Output   :  json array with vehicles list
    */

	public function sendMailToSeller()
    {
        if($this->input->post('seller_id') && $this->input->post('message')){
          $seller_id    = $this->input->post('seller_id');
          try{
                $seller_email = $this->Seller_model->getSellerEmail($seller_id);
                if(!$seller_email)
                {
                   throw new Exception('Seller email is not available');
                }

          	       $message      = $this->input->post('message');
                   $this->email->from('tamminana.lakshmi@dreamorbit.com', 'Lakshmi');
                   $this->email->to($seller_email);
                   $this->email->subject('Buyer Interest for vehicle');
                   $this->email->message($message);
                   if($this->email->send()) {
	                  $data['success'] = true;
	                  $data['message'] = "Your interest sent to concern seller,soon you will get reply";
                    }
                   else {
	                 $data['success'] = false;
	                 $data['message'] = "Unable to send mail to seller,Please try again";
                   }
              } catch (Exception $e) {
  	            $data['success'] = false;
                $data['message'] = $e->getMessage();
           }
    	}
        else {
          $data['success'] = false;
          $data['message'] = "Please enter some message to express your interest to seller";
        }

        echo json_encode($data);
    }

}

?>