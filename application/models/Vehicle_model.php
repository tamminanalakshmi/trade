<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model
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
        Method   :  POST
        Input    :  conditions , like and type is array
        Output   :  vehicles list according to filter data
    */

    public function getVehicles($conditions = array(),$like=array())
    {
        return $this->db->select('vt.vehicle_type,v.primary_image as image,v.registered_year,v.make,v.model,v.description,v.price,v.metadata')
            ->from('vehicles v')
            ->join('vehicle_types vt', 'v.vehicle_type_id = vt.id', 'inner')
            ->where($conditions)
            ->like($like)
            ->get()
            ->result_array();
    }

     /*
        @Author  :  Lakshmi Tamminana
        Date     :  15/05/2018
        Method   :  GET
        Input    :  id (vehicle id) mandatory
        Output   :  getting particular vehicle details
    */

    public function getVehicleDetails($id)
    {
        $data['vehicle_details'] = $this->db->select('vt.vehicle_type,v.registered_year,v.make,v.model,v.primary_image,v.description,v.price,v.metadata')
            ->from('vehicles v')
            ->join('vehicle_types vt', 'v.vehicle_type_id = vt.id', 'inner')
            ->where("v.id",$id)
            ->get()
            ->row_array();

        return $data;
    }

    /*
        @Author  :  Lakshmi Tamminana
        Date     :  15/05/2018
        Method   :  GET
        Input    :  no input
        Output   :  vehicle types list for select box options
    */

    public function getVehicleTypes()
    {
        $data = $this->db->select('id,vehicle_type')
                ->from('vehicle_types')
                ->get()
                ->result_array();

        return $data;
    }
}

?>