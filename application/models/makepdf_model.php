<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Makepdf_model extends CI_Model { 

    function __construct() { 
        parent::__construct(); 
    } 

    
    //------------------------------------------------------------------------
    function get_all_users() { 
        $query = $this->db->get('users'); 
        return $query; 
    } 
 
     //------------------------------------------------------------------------
    
    
      function get_all_kunden() {    
      return $this->db->get('kunde');  
      return $query; 
  } 
  
   //------------------------------------------------------------------------
  

  
        function get_all_tour() {    
      return $this->db->get('tour');  
      return $query; 
  } 
  
  
  
  
   //------------------------------------------------------------------------
  
  
 
  
    function get_all_kosten() {
    $query = "SELECT * FROM `kosten`, `kostenstelle` WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` "; 
    
    $result = $this->db->query($query, array());
    if ($result) {
      return $result;
    } else {
      return false;
    }    
    }
  
   //------------------------------------------------------------------------
  
  
  
  
  
  
  
  
  
  
   //------------------------------------------------------------------------
  
  
  
  
  
  
  
  
  
  
   //------------------------------------------------------------------------
  
  
  
  
  
  
  
  
   //------------------------------------------------------------------------
  
  
  
  
  
  
  
  
   //------------------------------------------------------------------------
} 


