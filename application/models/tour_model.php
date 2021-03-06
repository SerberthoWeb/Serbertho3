<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen für die CRUD-Operationen für Users an Admin-Funktionen.
 */



class Tour_model extends CI_Model { 
    
    function __construct() {    
        parent::__construct();  
}

//----------------------------------------------------------------------------


  function get_all_tour() {
    $query = "SELECT * FROM `tour`, `reiseort`, `users`  WHERE 
              `reiseort`.`reiseort_id` = `tour`.`reiseort_id` AND
              `users`.`usr_id` = `tour`.`usr_id` 
          "; 
    
    $result = $this->db->query($query, array());
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  }
      
  //---------------------------------------------------------------------------- 
  
 
    function tourdata($order_by=null, $order=null, $limit=0, $offset='') {
         if(isset($order_by) && !is_null($order_by)){
          $this->db->order_by($order_by, $order);
      }
      if($limit!=0){
          $this->db->limit($limit, $offset);
      }
        $this->db->join('reiseort', 'reiseort.reiseort_id = tour.reiseort_id');
        $this->db->join('users', 'users.usr_id = tour.usr_id');
        return $this->db->get('tour'); 
     /*
      * $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour` WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND  
              `tour`.`tour_id` = `kosten`.`tour_id`"; 

     
                  $result = $this->db->query($query, array());
    if ($result) {
      return $result;
    } else {
      return false;
    }
    */
    }
    
    //---------------------------------------------------------------------------- 
    
  function process_create_tour($data) {    
      if ($this->db->insert('tour', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   
   //----------------------------------------------------------------------------
   
   
  function edit_tour($id, $data) {    
      $this->db->where('tour_id', $id);    
      if ($this->db->update('tour', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
  //----------------------------------------------------------------------------
  
  
  function get_tour_details($id) {    
      $this->db->where('tour_id', $id);   
      $result = $this->db->get('tour');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }
    
 }
 
 //----------------------------------------------------------------------------
 
 

 
  function delete_tour($id) {
    if($this->db->delete('tour', array('tour_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }
  

  
  //----------------------------------------------------------------------------
      
      
  function count_results($tour) {
    $this->db->where('tour', $tour);
    $this->db->from('tour');
    return $this->db->count_all_results();
  } 

//----------------------------------------------------------------------------


  function get_reiseort() {
    return $this->db->get('reiseort');
  }


  
  

  //----------------------------------------------------------------------------
    function save_tour($save_data) {
    if ($this->db->insert('tour', $save_data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }
  
  //----------------------------------------------------------------------------

      function get_users() {
    return $this->db->get('users');
  }
 
    //----------------------------------------------------------------------------
  
  function get_tour() {
        return $this->db->get('tour');
  }
}



