<?php

class Store_Model extends CI_Model
{

    public function get_store($store_hashes){
        $storeObjects=[];
      
        foreach($store_hashes as $store_hash){
            $query= $this->db->from('stores')->where('store_hash',$store_hash)->get();
            if(!empty($query)){
                $storeObjects[]=( $query->row());
            }
        }
          return $storeObjects ;
       
    }

    public function get_products($store_hash){
        $query=$this->db->from('products')->where('store_hash',$store_hash)->get();
        if(!empty($query)){
            return $query->result();
        }else{
            return false;
        }
    }

}