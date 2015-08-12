<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * Beinhaltet Funktionen um Passwörter zu kreieren und diese auch zurückzusetzen
 */


class Password_model extends CI_Model {  
    
    function __construct() {      
        parent::__construct(); 
 } 

//----------------------------------------------------------------------------

 //Überprüft ob der Passwort-Code welcher von der URL geliefert wird mit dem in der Datenbank übereinstimmt.
 //Stimmt er wird true zurück gegeben, sonst false.
 
 function does_code_match($code, $email) {    
     
     $query = "SELECT COUNT(*) AS `count`               
                FROM `users`               
                WHERE `usr_pwd_change_code` = ?              
                AND `usr_email` = ? ";
     
        $res = $this->db->query($query, array($code, $email));    
        
        foreach ($res->result() as $row) {      
            $count = $row->count;    
            
        }
        
    if ($count == 1) {      
        return true;    
        
    } else {      
        return false;    
        
    }  
    
  } 
   
  
 //---------------------------------------------------------------------------- 
  
   
}


