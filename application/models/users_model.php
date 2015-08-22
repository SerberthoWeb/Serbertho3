<?php if ( ! defined('BASEPATH')) exit('No direct script access    allowed');

/*
 * Beinhaltet Funktionen für die CRUD-Operationen für Users an Admin-Funktionen.
 */



class Users_model extends CI_Model { 
    
    function __construct() {    
        parent::__construct();  
}

//----------------------------------------------------------------------------


  function usersdata($per_page,$offset,$sortfield,$order) {
      

		
		$this->db->select('*')->from('users');
		$this->db->order_by("$sortfield", "$order");
		$this->db->limit($per_page,$offset);
		$query_result = $this->db->get();		
		
		if($query_result->num_rows() > 0) {
			foreach ($query_result->result_array() as $row)
			{
                            $sdata[] = array('usr_fname' => $row['usr_fname'],
                                             'usr_lname' => $row['usr_lname'],
                                             'usr_email' => $row['usr_email'],
                                             'usr_id' => $row['usr_id']);
			}				
			return $sdata;
		} else {
			return false;	
		}
	}

  
      
   
  
 //----------------------------------------------------------------------------

// Count all record of table "contact_info" in database.
    public function record_count() {
        return $this->db->count_all("users");
}

//----------------------------------------------------------------------------


  function process_create_user($data) {    
      if ($this->db->insert('users', $data)) {      
          return $this->db->insert_id();    
          
      } else {     
          return false;    
          
      }  
   }
   
   //----------------------------------------------------------------------------
   
   
  function process_update_user($id, $data) {    
      $this->db->where('usr_id', $id);   
      
      if ($this->db->update('users', $data)) {      
          return true;    
          
      } else {      
          return false;    
          
      }  
  }
  
  //----------------------------------------------------------------------------
  
  
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



