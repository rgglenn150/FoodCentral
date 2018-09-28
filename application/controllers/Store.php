<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Store_Model');
    }

    public function index()
    {
        $storeHashes= json_decode($this->input->post('storeHashes'));
        $data = new stdClass();
        $data->storeObjects = $this->Store_Model->get_store($storeHashes);
        $data->received = $storeHashes;
        echo json_encode($data);
        exit();
    }

    public function view($store_hash){
       $data['storeObj']=$this->Store_Model->get_store([$store_hash])[0];
       $data['products'] =$this->Store_Model->get_products($store_hash);

      
       $this->load->view('storePage',$data);
    }

   

}
