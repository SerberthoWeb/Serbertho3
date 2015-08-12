<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechnung_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  //---------------------------------------------------------------------------- 

//    // ohne deutsches Datum
//    $mysql = "SELECT datum FROM tabelle;";
//    // mit deutschem Datum
//    $mysql = "SELECT DATE_FORMAT (datum, „%e.%m.%y”) AS datum FROM tabelle;";

      
      
    function get_rechnung($search_string) {
if ($search_string == null) {
      $query = "SELECT * FROM `tour` WHERE DATE(NOW()) < DATE(`reiseankunft`) ";
    } else {
      $query = "SELECT * FROM `tour` WHERE `tour_title` LIKE ? 
                 AND DATE(NOW()) < DATE(`reiseankunft`)";
    }

    $result = $this->db->query($query, array($search_string, $search_string));
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }   


  
   
        
    
      function get_uebersicht($tour_id) {
    $query = "SELECT * FROM `tour`, `reiseort`, `users` WHERE 
              `reiseort`.`reiseort_id` = `tour`.`reiseort_id` AND
              `users`.`usr_id` = `tour`.`usr_id` AND
              `tour_id` = ? 
              ";

        
    $result = $this->db->query($query, array($tour_id));
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  } 
  

    
      //---------------------------------------------------------------------------- 

  
    function get_reiseort() {
    return $this->db->get('reiseort');
  }
 

   //----------------------------------------------------------------------------  
  
  
  function get_users() {
    return $this->db->get('users');
  }

  //---------------------------------------------------------------------------- 
  

  function get_gesamtkosten() {
    $query = "SELECT * FROM `tour`,  `kosten`, `kostenstelle` WHERE 
                `kosten`.`tour_id` = `tour`.`tour_id`  AND
                `kosten`.`kostenstelle_id` = `kostenstelle`.`kostenstelle_id`
                "; 
    
    $result = $this->db->query($query, array());
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
  
  
  
  
}