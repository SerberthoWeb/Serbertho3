<?php if (!defined('BASEPATH')) exit('No direct script access  
  allowed');

/*
 *Methoden um einen User in seinen Account einzuloggen und startet eine Session.
 * Falls ein User sich ausloggen will in der top_nav-php wird der signin controller aufgerufen.
 * EInmal weitergeleitet, der signin controller erkennt dass nicht länger eingeloggt ist 
 * und zeigt das sign-in Formular.
 */



class Signin extends CI_Controller {
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->lang->load('de_admin', 'deutsch'); 
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>'); 
  }


  
  //--------------------------------------------------------------------------


//Index() Funktion zeigt de User ein Formular, welches ihm erlaubt seine Email Adresse
  //und Psswort anzugeben sowie das abarebiten der Bestätigung des Sign-in Formulars.
//Zuerst wird geschaut ob der User schon eingeloggt ist. Dazu wird der Wert der logged_in
 //userdata item gecheckt. Existiert der WErt und ist gleich TRUE, ist der User bereits
  //eingeloggt. Ist das der Fall, wird der Userlevel ausgleesen ob er ein normaler User ist, oder ein
  //Admin. Ist er ein Admin, wird er zur amdin area weitergeleitet, welches der users controller ist.
  //Ist er ein normaler User wird zum me-controller geleitet.

  
  public function index() {
    if ($this->session->userdata('logged_in') == TRUE) {
      if ($this->session->userdata('usr_access_level') == 1) {
        redirect('users');
      } else {
        redirect('me');
      }  
    } else {


//Kommt er an diesen Punkt des Codes, ist er nicht eingeloggt. Kein Formular existiert 
//damit er heir einloggen kann. Es wird eine Bestätigungsregel definiert für
//ein singin Formular.
      
      // Setzt Bestätigungsregeln für die Viewfilter
      $this->form_validation->set_rules('usr_email', $this->lang->line('signin_email'), 'required|valid_email|min_length[5]|max_length[125]');
      $this->form_validation->set_rules('usr_password', $this->lang->line('signin_password'), 'required|min_length[5]|max_length[30]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('common/login_header');
        $this->load->view('users/signin');
       //$this->load->view('common/footer');   
      } else {
          
       
//Unter der Annahme, dass die Bestätigung passiert wurde, wird Email und Passwort in
//einer lokalen Variable gespeicher im Signin_model, und ruft die does_user_exist()
//Funktion auf. Bestätigt wenn vom User die Email Adresse gesendet wird.
//Wird keine Aufzeichnung des Users gefunden, leitet das Formular weiter zum signin controller, um
//nochmals zu probieren.
          
          
        $usr_email = $this->input->post('usr_email');
        $password = $this->input->post('usr_password');

        $this->load->model('Signin_model');
        $query = $this->Signin_model->does_user_exist($usr_email);

//Falls ein record gefunden wird, wird versucht ihn einzuloggen
        if ($query->num_rows() == 1) { //Eine passende Zeile gefunden
          foreach ($query->result() as $row) {
            //Ruft die Encryptbiblio von CodeIgniter auf
            $this->load->library('encrypt');
          
          
//Ein Hash wrd generiert vom Passwort welches vom User geleifert wird und vergleichen es
//mit dem Hash-Wert in der Datenbankresultatobjekt, welches von does_user_exist() gerufen wird:
    
// Generiert Hashwert vom password
            $hash = $this->encrypt->sha1($password);

            if ($row->usr_is_active != 0) { //Schaut ob der User aktiv gesetzt ist
              // Vergleicht den generierten Hash mit dem in der Datenbank
              if ($hash != $row->usr_hash) {
          
//Der Hash-Wert passt nicht, also wird die sign-in view aufgerufen mit
//einer error-Nachricht.
      
//Passt es nicht, zurück zum Login
                $data['login_fail'] = true;
                $this->load->view('common/login_header');
                $this->load->view('users/signin', $data);
               //$this->load->view('common/footer'); 
              } else {
    
//Der Hashwert passt, das Passwort des Users ist korrekt. 
                $data = array(
                    'usr_id' => $row->usr_id,
                    'acc_id' => $row->acc_id,
                    'usr_email' => $row->usr_email,
                    'usr_access_level' => $row->usr_access_level,
                    'logged_in' => TRUE
                );
    
//EIne Session wird kreiert mit $this->session->set_userdata(). Speichert data in die Session
                $this->session->set_userdata($data);

                if ($data['usr_access_level'] == 2) {
                  redirect('home');
                } elseif ($data['usr_access_level'] == 1) {
                  redirect('home');
                } else {
                  redirect('home');
                }
              }
            } else {
              // User ist zurzeit inaktiv
              redirect('signin');
            }
          }
        } 
      }
    }
  }
  
  
  //--------------------------------------------------------------------------

  public function signout() {
    $this->session->sess_destroy();
    redirect ('signin');
  }
  
  
  //--------------------------------------------------------------------------

  
}

/* End of file signin.php */
/* Location: ./application/controllers/signin.php */



