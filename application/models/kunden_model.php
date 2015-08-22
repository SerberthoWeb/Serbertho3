<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen für die CRUD-Operationen für Users an Admin-Funktionen.
 */



class Kunden_model extends CI_Model { 
    
    function __construct() {    
        parent::__construct();  
}


//----------------------------------------------------------------------------


  function get_all_kunden($search_string) {    
 if ($search_string == null) {
      $query = "SELECT * FROM `kunde`, `tour` WHERE 
              `tour`.`tour_id` = `kunde`.`tour_id` "; 
       } else {
      $query = "SELECT * FROM `kunde`, `tour` WHERE 
                `lname` LIKE ? AND 
              `tour`.`tour_id` = `kunde`.`tour_id`
              
               
             "; 
      
    }
    $result = $this->db->query($query, array($search_string, $search_string));
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  }
  
  
 //----------------------------------------------------------------------------
  
  
  function process_create_kunde($data) {    
      if ($this->db->insert('kunde', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   
  
   
   //----------------------------------------------------------------------------
   
   
  function process_update_kunde($id, $data) {    
      $this->db->where('kunde_id', $id);    
      if ($this->db->update('kunde', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
  
  
  //----------------------------------------------------------------------------
  
  
  function get_kunde_details($id) {    
      $this->db->where('kunde_id', $id);   
      $result = $this->db->get('kunde');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }
    
 }
 
   
 //----------------------------------------------------------------------------
 
 

 
  function delete_kunde($id) {
    if($this->db->delete('kunde', array('kunde_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }
  

  
  //----------------------------------------------------------------------------
      
      
  function count_results($email) {
    $this->db->where('email', $email);
    $this->db->from('kunde');
    return $this->db->count_all_results();
  } 

//----------------------------------------------------------------------------

  function get_tour() {
    return $this->db->get('tour');
  }
  

//----------------------------------------------------------------------------

}



