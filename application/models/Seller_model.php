<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

     /*
        @Author  :  Lakshmi Tamminana
        Date     :  15/05/2018
        Method   :  GET
        Input    :  id (Vehicle id) Mandatory
        Output   :  getting particular seller details
    */

    public function getSellerDetails($id)
    {
         $seller = $this->db->select('s.id,st.type as seller_type,s.name,s.address,s.contact,s.email,s.website')
            ->from('vehicles v')
            ->join('vehicle_seller vs', 'v.id = vs.vehicle_id', 'inner')
            ->join('sellers s', 's.id = vs.seller_id', 'inner')
            ->join('seller_types st', 's.seller_type_id = st.id', 'inner')
            ->where("v.id",$id)
            ->get()
            ->row_array();
         $data['seller_details'] = $seller;
         $data['seller_reviews'] = $this->db->select('review')->from('seller_reviews')->where("seller_id",$seller['id'])->get()->result_array();

        return $data;
    }

    /*
        @Author  :  Lakshmi Tamminana
        Date     :  15/05/2018
        Method   :  GET
        Input    :  seller_id Mandatory
        Output   :  return sender email based on seller id
    */

    public function getSellerEmail($seller_id)
    {
        $result = $this->db->select('email')->from('sellers')->where("id",$seller_id)->get()->row();
        if($result)
        {
            return $result->email;
        }
       
    }
}

?>