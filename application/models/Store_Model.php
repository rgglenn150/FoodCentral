<?php

class Store_Model extends CI_Model
{

    public function get_store($store_hash=''){
        if($store_hash == ''){
          return  $this->db->from('stores')->get()->result();
        }
    }

}