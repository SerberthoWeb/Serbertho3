<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen für die CRUD-Operationen für Users an Admin-Funktionen.
 */



class Users_model extends CI_Model { 
    
    function __construct() {    
        parent::__construct();  
}

//----------------------------------------------------------------------------


  
  function usersdata($order_by=null, $order=null, $limit=0, $offset=''){
      if(isset($order_by) && !is_null($order_by)){
          $this->db->order_by($order_by, $order);
      }
      if($limit!=0){
          $this->db->limit($limit, $offset);
      }
      return $this->db->get('users');
  }

//----------------------------------------------------------------------------

    // Zählt alle Einträge in der Tabelle Users
    public function record_count() {
        return $this->db->count_all("users");
}


//----------------------------------------------------------------------------

    //Generiert einen neuen User
  function process_create_user($data) {    
      if ($this->db->insert('users', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   
//----------------------------------------------------------------------------
   
   //Editiert einen bestehenden User
  function process_update_user($id, $data) {    
      $this->db->where('usr_id', $id);   
      
      if ($this->db->update('users', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
//----------------------------------------------------------------------------
  
   //Gibt alle Details eines Users wieder
  function get_user_details($id) {    
      $this->db->where('usr_id', $id);   
      $result = $this->db->get('users');
      
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }

 }
 
 
//----------------------------------------------------------------------------
 
    //Gibt die Userdetails wieder anhand der Email
  function get_user_details_by_email($email) {    
      $this->db->where('usr_email', $email);   
      $result = $this->db->get('users');
    if ($result) {      
        return $result;    
        
    } else {      
        return false;    
        
    }  
 }
 
 
 //----------------------------------------------------------------------------
 
    //Löscht einen bestehenden User
  function delete_user($id) {
    if($this->db->delete('users', array('usr_id' => $id))) {
      return true;
    } else {
      return false;
    }
  }
  
  
//----------------------------------------------------------------------------
 
  
  
  //Erschafft einen einmaligen Code und specihert diesen in die User-Aufzeichnung.
  //Der Code wird verschickt am Ende der URL in einer Email zum User. Wenn der Code in der URL
  //übereinstimmt mit dem Code in der Datenbank, dann kann er geändert werden.
  //Wir nehmen ein do..while Konstrukt als Mittel um einen einzigartigen Code zu schaffen
  //in der Datenbank. Zuerst wird der Code generiert und dann wird in der User-Tabelle gescehaut,
  //ob ein anderer gleicher Code schon vorkommt. Wenn ein gleicher gefunden wird, wird die
  //Anzahl an Zeilen zurückgeschickt welche grösser oder gleich 1 ist. Danach wird ein anderer
  //Code generiert und eine weitere Suche in der User-Tabelle wird gestartet. Solange, bis ein Code 
  //gefunden wird, der noch nicht vorkommt. Der Code wird dann als $url_corde returned.
          
  function make_code() {
    do {
      $url_code = random_string('alnum', 8); 

      $this->db->where('usr_pwd_change_code = ', $url_code);
      $this->db->from('users');
      $num = $this->db->count_all_results();
    } while ($num >= 1);

    return $url_code;
  }
  
  
//----------------------------------------------------------------------------
      
      //Zählt die Anzahl User anhand der eindeutig gegebenen Email
  function count_results($email) {
    $this->db->where('usr_email', $email);
    $this->db->from('users');
    return $this->db->count_all_results();
  } 

//----------------------------------------------------------------------------

  

//Akzeptiert ein Array von Daten, welches den Primärschlüssel des Users enthält
//und das dazugehörige Passwort. Das Array beinhaltet die new_password() Funktion des
//password_model. Die User-ID ist von der Session (die er gerade eingeloggt ist) und
//das neue Passwort ist vom Formulat welches new_password() (views/users/new_password) lädt.

  function update_user_password($data) {
    $this->db->where('usr_id', $data['usr_id']);  
    if ($this->db->update('users', $data)) {
        return true;
    } else {
        return false;
    }
  }
     
//----------------------------------------------------------------------------
  
  
  function does_code_match($data, $email) {
    $query = "SELECT COUNT(*) AS `count` 
                    FROM `users` 
                    WHERE `usr_pwd_change_code` = ?
                    AND `usr_email` = ? ";

    $res = $this->db->query($query, array($data['code'], $email));

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
 
  
  function update_user_code($data) {
    $this->db->where('usr_email', $data['usr_email']);  
    if ($this->db->update('users', $data)) {
        return true;
    } else {
        return false;
    }
  }
//----------------------------------------------------------------------------
  
  
  
}



