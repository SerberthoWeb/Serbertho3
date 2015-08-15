<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen für die CRUD-Operationen für Users an Admin-Funktionen.
 */



class Reise_model extends CI_Model { 
    
    function __construct() {    
        parent::__construct();  
}

//----------------------------------------------------------------------------


  function get_all_reisen() {    
      return $this->db->get('reiseort');  
      
  } 
  
 //----------------------------------------------------------------------------
  
  
  function process_create_reise($data) {    
      if ($this->db->insert('reiseort', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   

   //----------------------------------------------------------------------------
   
   
  function process_update_reise($id, $data) {    
      $this->db->where('reiseort_id', $id);    
      if ($this->db->update('reiseort', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
  //----------------------------------------------------------------------------
  
  
  function get_reise_details($id) {    
      $this->db->where('reiseort_id', $id);   
      $result = $this->db->get('reiseort');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }
    
 }
 
 //----------------------------------------------------------------------------
 
 

 
  function delete_reise($id) {
    if($this->db->delete('reiseort', array('reiseort_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }
  

  
  //----------------------------------------------------------------------------
      
      
  function count_results($reiseort) {
    $this->db->where('reiseort', $reiseort);
    $this->db->from('reiseort');
    return $this->db->count_all_results();
  } 

//----------------------------------------------------------------------------





}



