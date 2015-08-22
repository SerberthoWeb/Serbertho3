<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Muss nicht von MY_Controller erben, weil ein eingeloggter User nicht zugriff 
 * darauf braucht, es genpgt der default CI_Controller.
 * Erlaubt dem User ein neues Passwort anzufordern.
 */

class Password extends CI_Controller {
    

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('file');
    $this->load->model('Users_model');
    $this->lang->load('de_admin', 'deutsch'); 
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="bs-callout bs-callout-error">', '</div>'); 
  }
  
  //--------------------------------------------------------------------------
  
  
  public function index() {
    redirect('password/forgot_password');
  }
  
   //--------------------------------------------------------------------------
  
  
  public function forgot_password() {
     $this->form_validation->set_rules('usr_email', $this->lang->line('signin_new_pwd_email'), 'required|min_length[5]|max_length[125]|valid_email');
  
//Beim Aufruf des Formulars beim ersten Mal oder die vorstehende Validierung versagt,
//dann die $this->form_validation() Funktion von Codeigniter returnt FALSE und ladet
//users/forgot_password.php-->
  
  if ($this->form_validation->run() == FALSE) {
  $this->load->view('common/login_header');
  $this->load->view('users/forgot_password');
 // $this->load->view('common/footer');

//Wenn die Email de Users die Validierung besteht, wird versucht einen einzigartigen
//Code zu generieren und sendet ihm eine Mail.-->
  
} else {
  $email = $this->input->post('usr_email');
  $num_res = $this->Users_model->count_results($email);
  
//Zuerst wird geschaut, ob die Email Adresse die im Formular eingetragen wurde
//in der Datenbank existiert. Wenn nicht, dann wird $num_res nicht gleich 1. 
//Falls dies der Fall ist, dann wird der User auf forgot_password() umgeleitet. 
//Wenn sie existiert, wird weiter mit dem Reuqest-Prozess mit einem if-Statement weitergefahren.-->
 
  if ($num_res == 1) {
  
//Es wird die make_code Funktion des users_model aufgerufen, welche einen einzigartigen Code 
//generiert und returnt diesen als $code Variable. Diese wird dem $data Array hinzugefügt und sendet
//es dem update_user_code() Funktion des users_model, wleche den code schreibt der genertiert wurde 
//von users.usr_pwd_change_code in Vorbereitung für die new_password() Funktion. 
//(new_password() l$uft wenn der Use auf die URL in der EMail klickt, die ihm gesendet wurde.-->
  
    $code = $this->Users_model->make_code();
    $data = array(
        'usr_pwd_change_code' => $code,
        'usr_email' => $email
);
    
if ($this->Users_model->update_user_code($data)) { // Update okay, EMail senden
  $result = $this->Users_model->get_user_details_by_email($email);
  
  foreach ($result->result() as $row) {
    $usr_fname = $row->usr_fname;
    $usr_lname = $row->usr_lname;
  }
  
  
//Der Code wurde generiert und gespeichert zum dazugehörigen Account in der Datenbank
//Nun kann die Email gestartet werden.-->
  
  $link = "http://www.serbertho3.square7.ch/Serbertho3/password/new_password/".$code;
  
//Es wird die reset_password.txt file geladen. Diese enthält ein Templatetext für
//den body der Email die gesendet wird. Der Filename wird der read_file() Codeigniter Funktion weitergegeben.
//Welche das File öffnet und seinen Content zurück gibt. Der COntent, Text im File, 
//ist als String in der Variable $file gespeciehrt.
  
    $path = 'http://www.serbertho3.square7.ch/Serbertho3/application/views/email_scripts/reset_password.txt';
    $file = read_file($path);

//Die str_replace() PHP Funktion ersetzt die Variable in $file mit den korrekten Werten

    $file = str_replace('%usr_fname%', $usr_fname, $file);
    $file = str_replace('%usr_lname%', $usr_lname, $file);
    echo $file = str_replace('%link%', $link, $file);

//Nun wird die Mail dem User gesendet, mithilfe der PHP mail() Funktion. Ist sie gesendet,
//wird der User weitergeleitet zur signin-Seite. Wen nicht, wird die Funkttion aufgerufen.

          if (mail ($email, $this->lang->line('email_subject_reset_password'),$file, 'From: straitjack@bluewin.ch')) {
            redirect('signin');
        }
      } else {
              // Falls Fehler auftreten, weiterleiten des Users.
        redirect('password/forgot_password');
      }
    } else {  
              // Falls Fehler auftreten, weiterleiten des Users.
      redirect('password/forgot_password');
    } 
  }
  
} //--------------------------------------------------------------------------

//Die new_password() Funktion hat Zugang wnn ein User auf die URL in der Mail klickt,
//welche gesendet wurde während der Ausführung der vorhergehenden Funktion forgot_password().
//Dem User wird ein Formular gezeigt um sein neus PAsswort einzugeben.
//Zuerst werden Bestätigungsregeln für das Formular in users/new_password.php definiert.

  public function new_password() {
    
 $this->form_validation->set_rules('code', $this->lang->line('signin_new_pwd_code'), 'required|min_length[4]|max_length[8]');
    $this->form_validation->set_rules('usr_email', $this->lang->line('signin_new_pwd_email'), 'required|min_length[5]|max_length[125]');
    $this->form_validation->set_rules('usr_password1', $this->lang->line('signin_new_pwd_email'), 'required|min_length[5]|max_length[125]');
    $this->form_validation->set_rules('usr_password2', $this->lang->line('signin_new_pwd_email'), 'required|min_length[5]|max_length[125]|matches[usr_password1]');
   
    if ($this->input->post()) {
      $data['code'] = xss_clean($this->input->post('code'));
      
    } else { 
        
    
      $data['code'] = xss_clean($this->uri->segment(3));
    }

    
//Wird das Formular das erste mal besucht oder die vorangehenden Bestätigugnsregeln 
//hatten einen Fehler, wird die $this->form_validation von CodeIgniter FALSE zurück geben. 
//public function new_password() {Users/new_password wird geladen, welche drei Formularelemente enthält: Email des Users,
//und zwei für das neue Passwort.

    if ($this->form_validation->run() == FALSE) {
      $data['usr_email']     = array('name' => 'usr_email',     'class' => 'form-control', 'id' => 'usr_email',     'type' => 'text',     'value' => set_value('usr_email', ''),     'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('signin_new_pwd_email'));
      $data['usr_password1'] = array('name' => 'usr_password1', 'class' => 'form-control', 'id' => 'usr_password1', 'type' => 'password', 'value' => set_value('usr_password1', ''), 'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('signin_new_pwd_pwd'));
      $data['usr_password2'] = array('name' => 'usr_password2', 'class' => 'form-control', 'id' => 'usr_password2', 'type' => 'password', 'value' => set_value('usr_password2', ''), 'maxlength'   => '100', 'size' => '35', 'placeholder' => $this->lang->line('signin_new_pwd_confirm'));
      
      $this->load->view('common/login_header', $data);
      $this->load->view('users/new_password', $data);      
      $this->load->view('common/footer', $data);
      
    } else {
    
    
//Hat das Formular die Bestätigung bestanen, wird versucht den Code der URL mit 
//der Email zu finden 

        $email = xss_clean($this->input->post('usr_email'));

//Wenn die does_code:match() Funktion des users_model einen falschen Wert zurück gibt, ist
//keine Aufzeichnung in der Datenbank in welcher die Email Adresse und CODE mit der
//EMail im Formular und dem Code in der URL übereinstimmt. Ist das der Fall, wird der User
//zur forgot_password() Funktion weitergeleitet um den Prozess erneut zu starten. Stimmt es überein
//ist es eine Originalanfrage.

      if (!$this->Users_model->does_code_match($data, $email)) { //Code stimmt nicht überrein
        redirect ('users/forgot_password');
        
      } else {  // Code stimmt überrein
       
      
      //Hash generieren vom gelieferten Passwort
      
        $hash = $this->encrypt->sha1($this->input->post('usr_password1'));   

//Speichert den Hash im $data Array mit der geleiferten Email.

        $data = array(
            'usr_hash' => $hash,
            'usr_email' => $email
        );

//Nimmt Email und Hash und gibt sie dem update_user_password() des users_model weiter.

        if ($this->Users_model->update_user_password($data)) {


//Der User hat nun sein Passwort geupdatet und erählt eine Email um zu bestätigen

        $link = 'http://www.serbertho3.square7.ch/Serbertho3/signin';
        $result = $this->Users_model->get_user_details_by_email($email);
        
        foreach ($result->result() as $row) {
          $usr_fname = $row->usr_fname;
          $usr_lname = $row->usr_lname;
        }

//Dazu wird die new_passwort.txt file gebraucht. Sie enthält das Template für den Text. 
//Filename wird der read_file() von Codeigniter weitergegeben, welche das File
//öffnet und den Content zurückgibt. Der Content ist als String in $file gepseichert.

        $path = 'http://www.serbertho3.square7.ch/Serbertho3/application/views/email_scripts/new_password.txt';
        $file = read_file($path);

//Die str_replace() PHP Funktion ersetzt die Variablen im $file mit den korrekten WErten.
//Wurde die Mail gesendet, wird weitergeleitet zum signin controller wo der User sich
//mit dem neuen Password einloggen kann.
        
          $file = str_replace('%usr_fname%', $usr_fname, $file);
          $file = str_replace('%usr_lname%', $usr_lname, $file);
          $file = str_replace('%password%', $password, $file);
          $file = str_replace('%link%', $link, $file);
          
          if (mail ($email, $this->lang->line(' 
            email_subject_new_password'),$file, 'From:  
            me@domain.com') ) {
            redirect ('signin');
          }
        }
      }
    }
  }
    
    
    //--------------------------------------------------------------------------
    
  }


/* End of file password.php */
/* Location: ./application/controllers/password.php */





  
  
