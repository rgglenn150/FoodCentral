<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }

    public function myTransactions(){
        $this->load->view('myTransactions');
    }
    
    public function storeTransactions(){
        $this->load->view('storeTransactions');
    }
}