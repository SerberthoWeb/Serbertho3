<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Erlaubt einem Admin alle User zu managen welche sich angemeldet haben und
 * die Daten in der Benutzer-Tabelle gespeichert sind. 
 */


//Es wird getestet welcher access-level der User hat (users.usr_access_level).
//Ist er nicht gleich 1, ist er kein Admin, also hat er keinen Zugriff auf diesen Controller

class Users extends MY_Controller {
    
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
    $this->load->helper('file'); // für html-Emails
    $this->load->model('Users_model');
    $this->load->model('Password_model');

        if ( ($this->session->userdata('logged_in') == FALSE) || 
       ($this->session->userdata('usr_access_level') != 1) ) {
        redirect('signin');
    }  
  }
  
  //-----------------------------------------------------------------------------
  
  //Lädt die get_all_users() Funktion des Users_model, welche alle User in
  //der User-Tabelle zeigt. Das Resultat wird $data Array Query gespeichert und 
  //wird zu users/view_all_users.php geleitet. Zeigt alle Users in einem Tabellenformat an
  //mit zwei Optionen: Edit und Delete.
  
  public function index() {
  $data['page_heading'] = 'Userübersicht';
  $data['query'] = $this->Users_model->get_all_users();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('users/view_all_users', $data);
  $this->load->view('common/footer', $data);
} 

//-----------------------------------------------------------------------------

//Handelt die Usererstellung innerhalb des Systems. 

public function new_user() {
   // Setzt Validationsregeln
    $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
    $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
    $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_access_level'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[1]|integer|is_natural');
  
    $data['page_heading'] = 'Neuen User anlegen';
    
    
  //Nachdem die Bestätigungsregeln gesetzt wurden, wird der return Wert von $this->form->validation() 
  //getestet. Ist es das erste mal, dass die Seite zugreift oder ein Formitem scheitert an
  //der Bestätigung wird ein FALSE zurück gegeben. Es werden Einstellungen für die HTML Elemente 
  //in users/new_user.php.
    
    if ($this->form_validation->run() == FALSE) { 
      $data['usr_fname'] = array('name' => 'usr_fname', 'class' => 'form-control', 'id' => 'usr_fname', 'value' => set_value('usr_fname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_lname'] = array('name' => 'usr_lname', 'class' => 'form-control', 'id' => 'usr_lname', 'value' => set_value('usr_lname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_uname'] = array('name' => 'usr_uname', 'class' => 'form-control', 'id' => 'usr_uname', 'value' => set_value('usr_uname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_email'] = array('name' => 'usr_email', 'class' => 'form-control', 'id' => 'usr_email', 'value' => set_value('usr_email', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_confirm_email'] = array('name' => 'usr_confirm_email', 'class' => 'form-control', 'id' => 'usr_confirm_email', 'value' => set_value('usr_confirm_email', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add1'] = array('name' => 'usr_add1', 'class' => 'form-control', 'id' => 'usr_add1', 'value' => set_value('usr_add1', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_town_city'] = array('name' => 'usr_town_city', 'class' => 'form-control', 'id' => 'usr_town_city', 'value' => set_value('usr_town_city', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_zip_pcode'] = array('name' => 'usr_zip_pcode', 'class' => 'form-control', 'id' => 'usr_zip_pcode', 'value' => set_value('usr_zip_pcode', ''), 'maxlength'   => '100', 'size' => '35');
      $data['usr_access_level'] = array(1=>1, 2=>2);
     

      
      
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/new_user',$data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
  
  
  //Falls die Formulardaten die Bestätigung bestehen, wird das Passwort für den User generiert.
  //Dazu wird die random_string Funktion von Codeigniter benutzt, welche einen Zeichenstring von 
  //der Länge 8 digits generiert.
  //Dann wird eine Hash generiert für das Passwort mit Hilfe von $this->encrypt->sha1()
  //von COdeIgniter. Und der Code wird per Email an den User gesandt.
    
      $password = random_string('alnum', 8);
      $hash = $this->encrypt->sha1($password);  

      $data = array(
        'usr_fname' => $this->input->post('usr_fname'),
        'usr_lname' => $this->input->post('usr_lname'),
        'usr_uname' => $this->input->post('usr_uname'),
        'usr_email' => $this->input->post('usr_email'),
        'usr_hash' => $hash,
        'usr_add1' => $this->input->post('usr_add1'),
        'usr_town_city' => $this->input->post('usr_town_city'),
        'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
        'usr_access_level' => $this->input->post('usr_access_level'),
        'usr_is_active' => $this->input->post('usr_is_active')
      );


//Wenn es in $data array gespeichert ist, wird versucht der Hashwert in der Datenbank
//zu speichern mit process_create_user() des users_model.
      if ($this->Users_model->process_create_user($data)) {
        $file = read_file('/application/views/email_scripts/welcome.txt');
        $file = str_replace('%usr_fname%', $data['usr_fname'], $file);
        $file = str_replace('%usr_lname%', $data['usr_lname'], $file);
        $file = str_replace('%password%', $password, $file);
        redirect('users');
      } else {

      }
    }        
  }


//--------------------------------------------------------------------------



//Wenn der Admin die Edit Funktion wählt wird die edit_user() Funktion aufgerufen.

public function edit_user() {
  //Validationsregeln setzen
    $this->form_validation->set_rules('usr_id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email');
    $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
    $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_zip_pcode', $this->lang->line('usr_zip_pcode'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_access_level', $this->lang->line('usr_access_level'), 'min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_is_active', $this->lang->line('usr_is_active'), 'min_length[1]|max_length[2]');
  
  //Der Primärschlüssel des Users (users.usr_id) wird an den Edit link angehängt und an
  //die edit_user() Funktion angehängt, um nachzuschauen dass der user in der User-Tabelle ist.
  //Die get_user_details($id) Funktion des users_model nimmt einen PArameterwert von $id -
  //und schaut nach dem User. Ist diese gefunden, werden die Details der Abfrage in eine lokale
  //variable geschrieben und im ädata array gespeichert. Wird an edit_user.php weitergegeben,
  //wo dies gebarucht wird um die Formitems mit den korrekten Daten zu bevölkern.
  
    if ($this->input->post()) {
      $id = $this->input->post('usr_id');
    } else {
      $id = $this->uri->segment(3); 
    }
    
    $data['page_heading'] = 'User bearbeiten';                
    //Bestätigung beginnt
    if ($this->form_validation->run() == FALSE) {          
      $query = $this->Users_model->get_user_details($id);
      foreach ($query->result() as $row) {
        $usr_id = $row->usr_id;
        $usr_fname = $row->usr_fname;
        $usr_lname = $row->usr_lname;
        $usr_uname = $row->usr_uname;
        $usr_email = $row->usr_email;
        $usr_add1 = $row->usr_add1;
        $usr_town_city = $row->usr_town_city;
        $usr_zip_pcode = $row->usr_zip_pcode;
        $usr_access_level = $row->usr_access_level;
        $usr_is_active = $row->usr_is_active;
      }
      
      
      $data['usr_fname'] = array('name' => 'usr_fname', 'class' => 'form-control', 'id' => 'usr_fname', 'value' => set_value('usr_fname', $usr_fname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_lname'] = array('name' => 'usr_lname', 'class' => 'form-control', 'id' => 'usr_lname', 'value' => set_value('usr_lname', $usr_lname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_uname'] = array('name' => 'usr_uname', 'class' => 'form-control', 'id' => 'usr_uname', 'value' => set_value('usr_uname', $usr_uname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_email'] = array('name' => 'usr_email', 'class' => 'form-control', 'id' => 'usr_email', 'value' => set_value('usr_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_confirm_email'] = array('name' => 'usr_confirm_email', 'class' => 'form-control', 'id' => 'usr_confirm_email', 'value' => set_value('usr_confirm_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add1'] = array('name' => 'usr_add1', 'class' => 'form-control', 'id' => 'usr_add1', 'value' => set_value('usr_add1', $usr_add1), 'maxlength'   => '100', 'size' => '35');
      $data['usr_town_city'] = array('name' => 'usr_town_city', 'class' => 'form-control', 'id' => 'usr_town_city', 'value' => set_value('usr_town_city', $usr_town_city), 'maxlength'   => '100', 'size' => '35');
      $data['usr_zip_pcode'] = array('name' => 'usr_zip_pcode', 'class' => 'form-control', 'id' => 'usr_zip_pcode', 'value' => set_value('usr_zip_pcode', $usr_zip_pcode), 'maxlength'   => '100', 'size' => '35');
      $data['usr_access_level_options'] = array(1=>1, 2=>2);
      $data['usr_access_level'] = array('value' => set_value('usr_access_level', $usr_access_level));
      $data['usr_is_active'] = array('value' => set_value('usr_is_active', $usr_is_active));;
      $data['id'] = array('usr_id' => set_value('usr_id', $usr_id));
      
      
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/edit_user', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
//Falls die Formulareingaben stimmen, werden die Userinformationen im $data array
//gespeichert.
      $data = array(
        'usr_fname' => $this->input->post('usr_fname'),
        'usr_lname' => $this->input->post('usr_lname'),
        'usr_uname' => $this->input->post('usr_uname'),
        'usr_email' => $this->input->post('usr_email'),
        'usr_add1' => $this->input->post('usr_add1'),
        'usr_town_city' => $this->input->post('usr_town_city'),
        'usr_zip_pcode' => $this->input->post('usr_zip_pcode'),
        'usr_access_level' => $this->input->post('usr_access_level'),
        'usr_is_active' => $this->input->post('usr_is_active')
      );
    
    //Sobald alles hinzugefügt wurde, werden die Userdetails geupdatet durch
    //process_update_user() Funktion des users_model.

        if ($this->Users_model->process_update_user($id, $data)) {
            redirect('users');
    }
  }
}

//--------------------------------------------------------------------------



//Wenn Delete benutz wird in users/view_all_users.php, wird der users controller gerufen
//und darin die Funktion delete_user() genutzt. Gebraucht die users_usr_id Primärschlüssel 
//und wird am Ende des URL Links angefügt und an delete_user($id) Funktion des users_model 
//weitergegeben
    
    
     public function delete_user() {
    //Setzen Validationsregeln
   $this->form_validation->set_rules('id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Users_model->get_user_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('users/delete_user', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Users_model->delete_user($id)) {
        redirect('users');
      }
    }
  }
  
  //----------------------------------------------------------------
  
  public function pwd_email() {
    $id = $this->uri->segment(3);
    send_email($data, 'reset');
    redirect('users');
  }
    
  
  //--------------------------------------------------------------------------


  
}

