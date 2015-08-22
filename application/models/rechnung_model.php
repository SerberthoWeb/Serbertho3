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

      //Reiseansicht in rechnung/view
      
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

  //---------------------------------------------------------------------------- 
  
      //vergangene Reisenansicht in rechnung/past
  
  function get_past_rechnung($search_string) {
if ($search_string == null) {
      $query = "SELECT * FROM `tour` WHERE DATE(NOW()) > DATE(`reiseankunft`) ";
    } else {
      $query = "SELECT * FROM `tour` WHERE `tour_title` LIKE ? 
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
  
  
  //Datenübersicht der ausselektierten Reise in rechnung/apply
    
      function get_uebersicht($tour_id) {
  $query = "SELECT * FROM `tour`, `reiseort`, `users`, `kosten`, `kostenstelle`  WHERE 
      `reiseort`.`reiseort_id` = `tour`.`reiseort_id` AND 
      `users`.`usr_id` = `tour`.`usr_id` AND 
      `kosten`.`tour_id` = `tour`.`tour_id` AND 
      `kostenstelle`.`kostenstelle_id` = `kosten`.`kostenstelle_id` AND 
      `tour`.`tour_id` =  ".$tour_id ;  //anfällig für hacken - mit ? geschützt - abklären
       
    $result = $this->db->query($query, array($tour_id));   
     
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  } 
     //---------------------------------------------------------------------------- 
  
  //Kundenübersicht in der ausselektierten Reise in rechnung/apply
  
      function get_uebersicht_kunden($tour_id) {

  $query = "SELECT * FROM `tour`, `kunde` WHERE 
      
      `kunde`.`tour_id` = `tour`.`tour_id` AND 
     

      `tour`.`tour_id` =  ".$tour_id ;  //anfällig für hacken - mit ? geschützt - abklären
                    
 $result = $this->db->query($query, array($tour_id));

     
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  } 

      //---------------------------------------------------------------------------- 

    
  //Gesamtkosten der ausselektierten Reise in rechnung/apply
  
  function get_gesamtkosten($tour_id) {

$query = "SELECT `kosten`,
            SUM(`kosten`) AS TotalKosten
            FROM `kosten`
            WHERE `kosten`.`tour_id` = ?
            GROUP BY `tour_id`";
   
      
$result = $this->db->query($query, array($tour_id));

     
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  } 
   

  
   //---------------------------------------------------------------------------- 
  
  //Gesamteinnahmen der ausselektieren Reise in rechnung/apply
  
     function get_einnahmen($tour_id) {

        $query = "SELECT `preis`, 
                 SUM(`preis`) AS TotalEinnahmen   
                 FROM `tour`, `kunde`
                 WHERE
                `tour`.`tour_id` =  `kunde`.`tour_id` AND
                `tour`.`tour_id` =  ".$tour_id ;


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
  

  function get_kostenstelle() {
    return $this->db->get('kostenstelle');
  }
  
  
   //---------------------------------------------------------------------------- 

  
 // Gesamtkosten aller Reisen
  
   function get_gesamtkosten_all($tour_id) {

$query = "SELECT `kosten`,
            SUM(`kosten`) AS TotalKostenAll
            FROM `kosten`, `tour`
            WHERE `tour`.`tour_id` = ".$tour_id ;
            
   
      
$result = $this->db->query($query, array($tour_id));

     
    if ($result) {
      return $result;
    } else {
      return false;
    }    
  }

  //---------------------------------------------------------------------------- 
  
  
}