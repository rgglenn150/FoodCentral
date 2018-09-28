<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Product_Model');#
    }


    public function index(){
       
    }

    public function getProduct($id){
       echo json_encode($this->Product_Model->getProduct($id));
    }



}