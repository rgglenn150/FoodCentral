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

    }

    public function test()
    {
        $data = new stdClass();
        
        $data->storeObject = $this->Store_Model->get_store();
        $data->received = $this->input->post('storeHashes');
        echo json_encode($data);
        exit();

    }

}
