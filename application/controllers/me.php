<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Bietet eine Location für einen normalen User (nicht Admin), um seine
 * Account-Einstellungen zu sehen. Der Wert von users.usr_access_level ist
 * auf 2 gesetzt
 */


class Me extends CI_Controller {

 //--------------------------------------------------------------------------

    //Ceckt ob der User eingeloggt ist und dann welcher Zugangslevel (users.usr_access_level)
    //er hat. Ist er nicht grösser oder gleich 2 (normaler Userlevel), wird er zu signin/signout
    //weitergeleitet.

function __construct() {
  parent::__construct();
  $this->load->helper('form');
  $this->load->helper('url');
  $this->load->helper('security');
  $this->load->helper('file'); // for html emails
  $this->load->model('Users_model');
  $this->load->library('session');
  
  // Load language file
  $this->lang->load('de_admin', 'deutsch');
  $this->load->library('form_validation');
  $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
  
  if ( ($this->session->userdata('logged_in') == FALSE) || 
       (!$this->session->userdata('usr_access_level') >= 2) ) {
          redirect('signin/signout');
  }
}

//--------------------------------------------------------------------------



//Erlaubt einem User seine Details zu updaten in der Datenbank.


  public function index() {
    // Setzen der Bestätigungsregeln
    $this->form_validation->set_rules('usr_fname', $this->lang->line('usr_fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_lname', $this->lang->line('usr_lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_uname', $this->lang->line('usr_uname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('usr_email'), 'required|min_length[1]|max_length[255]|valid_email');
    $this->form_validation->set_rules('usr_confirm_email', $this->lang->line('usr_confirm_email'), 'required|min_length[1]|max_length[255]|valid_email|matches[usr_email]');
    $this->form_validation->set_rules('usr_add1', $this->lang->line('usr_add1'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_plz', $this->lang->line('usr_plz'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_town_city', $this->lang->line('usr_town_city'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('usr_phone', $this->lang->line('usr_phone'), 'required|min_length[1]|max_length[125]');
    $data['id'] = $this->session->userdata('usr_id');
  
    $data['page_heading'] = 'Mein Profil';

// Beginn der Validation
//Falls das Formular zum ersten mal angeschaut wird oder die vorangegangene Bestätigungsregeln
//sind gescheitert, die $this->form_validation() von Codeigniter gibt FALSE zurück und
//lädt users/me.php.
    
    if ($this->form_validation->run() == FALSE) { 
        $query = $this->Users_model->get_user_details($data['id']);
            foreach ($query->result() as $row) {
                 $usr_fname = $row->usr_fname;
                 $usr_lname = $row->usr_lname;
                 $usr_uname = $row->usr_uname;
                 $usr_email = $row->usr_email;
                 $usr_add1 = $row->usr_add1;
                 $usr_plz = $row->usr_plz;
                 $usr_town_city = $row->usr_town_city;
                 
                 $usr_phone = $row->usr_phone;
}


//Nachdem die details des Users geholt wurden und in einer lokalen Variabl gesepcihert, 
//wird er auf die Formitems angewendet. Dazu wird set_value() von COdeigniter verwendet.
//dabei ist der erste Parameter der name des Formelements (<input type="text" name="das-ist-der-Name" />)
//und der zweite Parameter ist der aktulle Wert des Formelements
 
      $data['usr_fname'] = array('name' => 'usr_fname', 'class' => 'form-control', 'id' => 'usr_fname', 'value' => set_value('usr_fname', $usr_fname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_lname'] = array('name' => 'usr_lname', 'class' => 'form-control', 'id' => 'usr_lname', 'value' => set_value('usr_lname', $usr_lname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_uname'] = array('name' => 'usr_uname', 'class' => 'form-control', 'id' => 'usr_uname', 'value' => set_value('usr_uname', $usr_uname), 'maxlength'   => '100', 'size' => '35');
      $data['usr_email'] = array('name' => 'usr_email', 'class' => 'form-control', 'id' => 'usr_email', 'value' => set_value('usr_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_confirm_email'] = array('name' => 'usr_confirm_email', 'class' => 'form-control', 'id' => 'usr_confirm_email', 'value' => set_value('usr_confirm_email', $usr_email), 'maxlength'   => '100', 'size' => '35');
      $data['usr_add1'] = array('name' => 'usr_add1', 'class' => 'form-control', 'id' => 'usr_add1', 'value' => set_value('usr_add1', $usr_add1), 'maxlength'   => '100', 'size' => '35');
      $data['usr_plz'] = array('name' => 'usr_plz', 'class' => 'form-control', 'id' => 'usr_plz', 'value' => set_value('usr_plz', $usr_plz), 'maxlength'   => '100', 'size' => '35');
      $data['usr_town_city'] = array('name' => 'usr_town_city', 'class' => 'form-control', 'id' => 'usr_town_city', 'value' => set_value('usr_town_city', $usr_town_city), 'maxlength'   => '100', 'size' => '35');
    
      $data['usr_phone'] = array('name' => 'usr_phone', 'class' => 'form-control', 'id' => 'usr_phone', 'value' => set_value('usr_phone', $usr_phone), 'maxlength'   => '100', 'size' => '35');
      
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('users/me', $data);
  $this->load->view('common/footer', $data);
  
} else {   // Validation bestanden
    
  //Die Bestätigung ist nun bestanden. Die gepostetetn Daten werden im $data Array
    //gespeicher und vorbereitet um in der process_update_user Funktion im user_model
    //zu speichern.
    
  $data = array(
        'usr_fname' => $this->input->post('usr_fname'),
        'usr_lname' => $this->input->post('usr_lname'),
        'usr_uname' => $this->input->post('usr_uname'),
        'usr_email' => $this->input->post('usr_email'),
        'usr_add1' => $this->input->post('usr_add1'),
        'usr_plz' => $this->input->post('usr_plz'),  
        'usr_town_city' => $this->input->post('usr_town_city'),
        'usr_phone' => $this->input->post('usr_phone')
    );
  
  
    if ($this->Users_model->process_update_user($id, $data)) {
        redirect('users');
    }
  }
}

//--------------------------------------------------------------------------


//Change_password() Funktion erlaubt dem User wem erlaubt ist auf den Controller zuzugreifen um
//das Passwort zu ändern. EInmal Zugriff, die users/change_password.php view zeigt ein Formular 
//welches nach einem neuen Passwort fragt. Wenn das Formular übermittelt und bestätigt ist, 
//wird ein Hash generiert welcher das neue Passwort verseht und speichert es im logged-in users record.

  public function change_password() {

    $this->load->library('form_validation');
    $this->form_validation->set_rules('usr_new_pwd_1', $this->lang->line('signin_new_pwd_pwd'), 'required|min_length[5]|max_length[125]');
    $this->form_validation->set_rules('usr_new_pwd_2', $this->lang->line('signin_new_pwd_confirm'), 'required|min_length[5]|max_length[125]|matches[usr_new_pwd_1]');
        
    if ($this->form_validation->run() == FALSE) {
      $data['usr_new_pwd_1'] = array('name' => 'usr_new_pwd_1', 'class' => 'form-control', 'type' => 'password', 'id' => 'usr_new_pwd_1', 'value' => set_value('usr_new_pwd_1', ''), 'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('signin_new_pwd_pwd'));
      $data['usr_new_pwd_2'] = array('name' => 'usr_new_pwd_2', 'class' => 'form-control', 'type' => 'password', 'id' => 'usr_new_pwd_2', 'value' => set_value('usr_new_pwd_2', ''), 'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('signin_new_pwd_confirm'));
      $data['submit_path'] = 'me/change_password';

      $this->load->view('common/login_header', $data);
      $this->load->view('users/change_password', $data);      
      $this->load->view('common/footer', $data);
      
    } else {
        
      $hash = $this->encrypt->sha1($this->input->post('usr_new_pwd_1')); 

      $data = array(
        'usr_hash' => $hash,
        'usr_id' => $this->session->userdata('usr_id')
      );

      if ($this->Users_model->update_user_password($data)) {
        redirect('signin/signout');
      }
    }
  }
 
  
  //--------------------------------------------------------------------------
  
}


/* End of file me.php */
/* Location: ./application/controllers/me.php */