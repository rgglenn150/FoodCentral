<?php 

class Product_Model extends CI_Model{

    public function getProduct($id){
        $query= $this->db->from('products')->where('id',$id)->get();
        if(!empty($query)){
            return  $query->row();
        }
        else{
            return false;
        }
    }


}