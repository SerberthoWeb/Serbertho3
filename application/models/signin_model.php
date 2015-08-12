<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen um einen User in das System aufzunehmen
 */

class Signin_model extends CI_Model {    
    
    function __construct() {        
        parent::__construct();    
        
    } 
    
  //----------------------------------------------------------------------------

    
    //Nimmt die EMail welche vom User-Formular übermittelt wird von der Signin-View
    //und returnt die AcriveRecord Abfrage. Die Abfrage ist bewertet im signin-Controller
    //mit der CodeIgniter Datenbankfunktion function num_rows().
    //Wenn der User auf einen passt, durchlüft der signin-Controller eine Schleife über
    //das ActiveRecord Resultat und erlaubt dem User einzuloggen.
    
    
    public function does_user_exist($email) {       
        $this->db->where('usr_email', $email);        
        $query = $this->db->get('users');        
        return $query;    
        
    } 
    
    
    //----------------------------------------------------------------------------
       
    
 }
