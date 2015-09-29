<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kosten_model extends CI_Model {
    
 //----------------------------------------------------------------------------    
    
  function __construct() {
    parent::__construct();
  }
  
 //---------------------------------------------------------------------------- 

  function get_kostenstellen($search_string) {
      if ($search_string == null) {
    $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour` WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND  
              `tour`.`tour_id` = `kosten`.`tour_id`           
              ";
    } else {
      $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour`  WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND
             `kostenstelle`.`kostenstelle_name` LIKE ? AND
             
             `tour`.`tour_id` = `kosten`.`tour_id`
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
    
    function kostendata($order_by=null, $order=null, $limit=0, $offset='') {
         if(isset($order_by) && !is_null($order_by)){
          $this->db->order_by($order_by, $order);
      }
      if($limit!=0){
          $this->db->limit($limit, $offset);
      }
        $this->db->join('kostenstelle', 'kostenstelle.kostenstelle_id = kosten.kostenstelle_id');
        $this->db->join('tour', 'tour.tour_id = kosten.tour_id');
        return $this->db->get('kosten'); 
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
  
  function get_kosten_rechnungsnummer($search_string) {
      if ($search_string == null) {
    $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour` WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND  
              `tour`.`tour_id` = `kosten`.`tour_id`           
              ";
    } else {
      $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour`  WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND
             `kosten`.`r_nummer` LIKE ? AND
             
             `tour`.`tour_id` = `kosten`.`tour_id`
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
  
           function get_kosten_reisename($search_string) {
      if ($search_string == null) {
    $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour` WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND  
              `tour`.`tour_id` = `kosten`.`tour_id`           
              ";
    } else {
      $query = "SELECT * FROM `kosten`, `kostenstelle`, `tour`  WHERE 
              `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND
             `kosten`.`r_nummer` LIKE ? AND
             
             `tour`.`tour_id` = `kosten`.`tour_id`
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
    
            function process_create_kosten($data) {    
      if ($this->db->insert('kosten', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   
   
   //---------------------------------------------------------------------------- 
  

  function get_kostenstelle() {
    return $this->db->get('kostenstelle');
  }
  
  
   //---------------------------------------------------------------------------- 
  function save_kosten($save_data) {
    if ($this->db->insert('kosten', $save_data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }
  
 
      //----------------------------------------------------------------------------  
    
    function get_tour() {
    return $this->db->get('tour');
  }
  
  
  //----------------------------------------------------------------------------
  
    function save_kostenstelle($save_data) {
    if ($this->db->insert('kostenstelle', $save_data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }
  
  
  //----------------------------------------------------------------------------
  
  
    function delete_kostenstelle($id) {
    if($this->db->delete('kostenstelle', array('kostenstelle_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }
  
  
   //---------------------------------------------------------------------------- 
  
  
    function get_kostenstelle_details($id) {    
      $this->db->where('kostenstelle_id', $id);   
      $result = $this->db->get('kostenstelle');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }
    
 }
 
 
    //---------------------------------------------------------------------------- 
 
 
   function get_kosten_details($id) {    
      $this->db->where('kosten_id', $id);   
      $result = $this->db->get('kosten');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }
    
 }
 
    //---------------------------------------------------------------------------- 
 
 
   function delete_kosten($id) {
    if($this->db->delete('kosten', array('kosten_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }

      //---------------------------------------------------------------------------- 
  
  
    function process_update_kosten($id, $data) {    
      $this->db->where('kosten_id', $id);    
      if ($this->db->update('kosten', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
      //---------------------------------------------------------------------------- 
  
}
