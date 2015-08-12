<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen um einen User zu registrieren
 */



class Register_model extends CI_Model {  
    function __construct() {    
        parent::__construct();  
        
    }
    
 //----------------------------------------------------------------------------

    
//Nimmt die ActiveRecord insert() Klasse von CodeIgniter um den Inhalt der Variable
//$data-Array in die Tabelle "User" einzufügen.
    
  public function register_user($data) {    
      if ($this->db->insert('users', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
      
   }
   
 //----------------------------------------------------------------------------
   
   
}
      
      
     
   
   
   
      
      
