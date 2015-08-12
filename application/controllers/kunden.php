<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Erlaubt einem Admin alle User zu managen welche sich angemeldet haben und
 * die Daten in der Benutzer-Tabelle gespeichert sind. 
 */


//Es wird getestet welcher access-level der User hat (users.usr_access_level).
//Ist er nicht gleich 1, ist er kein Admin, also hat er keinen Zugriff auf diesen Controller

class Kunden extends MY_Controller {
    
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
   
    $this->load->model('Kunden_model');
     
  }
  
  //-----------------------------------------------------------------------------
  
  //Lädt die get_all_kunden() Funktion des Kunden_model, welche alle Kunden in
  //der Kundentabelle zeigt. Das Resultat wird als $data Arrayquery gespeichert und 
  //zu kunden/view_all_kunden.php geleitet. Zeigt alle Kunden in einem Tabellenformat an
  //mit zwei Optionen: Edit und Löschen.
  
  public function index() {
  $data['page_heading'] = 'Kundenübersicht';
  $data['query'] = $this->Kunden_model->get_all_kunden();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('kunden/view_all_kunden', $data);
  $this->load->view('common/footer', $data);
} 

//-----------------------------------------------------------------------------

//Kümmert sich um die Kundenerstellung innerhalb des Systems. 

public function new_kunde() {
   // Setzt Validationsregeln
    $this->form_validation->set_rules('fname', $this->lang->line('fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('lname', $this->lang->line('lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('strasse', $this->lang->line('strasse'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('plz', $this->lang->line('plz'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('ort', $this->lang->line('ort'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('telnr', $this->lang->line('telnr'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[kunde.email]');
    
    $data['page_heading'] = 'Neuen Kunden anlegen';
    
    
  //Nachdem die Bestätigungsregeln gesetzt wurden, wird der return Wert von $this->form->validation() 
  //getestet. Ist es das erste mal, dass die Seite aufgerufen wird oder ein Formitem scheitert an
  //der Bestätigung wird ein FALSE zurück gegeben. Es werden Einstellungen für die HTML Elemente 
  //in kunden/new_kunde.php erstellt.
    
    if ($this->form_validation->run() == FALSE) {
      $data['fname'] = array('name' => 'fname', 'class' => 'form-control', 'id' => 'fname', 'value' => set_value('fname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['lname'] = array('name' => 'lname', 'class' => 'form-control', 'id' => 'lname', 'value' => set_value('lname', ''), 'maxlength'   => '100', 'size' => '35');
      $data['strasse'] = array('name' => 'strasse', 'class' => 'form-control', 'id' => 'strasse', 'value' => set_value('strasse', ''), 'maxlength'   => '100', 'size' => '35');
      $data['plz'] = array('name' => 'plz', 'class' => 'form-control', 'id' => 'plz', 'value' => set_value('plz', ''), 'maxlength'   => '100', 'size' => '35');
      $data['ort'] = array('name' => 'ort', 'class' => 'form-control', 'id' => 'ort', 'value' => set_value('ort', ''), 'maxlength'   => '100', 'size' => '35');
      $data['telnr'] = array('name' => 'telnr', 'class' => 'form-control', 'id' => 'telnr', 'value' => set_value('telnr', ''), 'maxlength'   => '100', 'size' => '35');
      $data['email'] = array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email', ''), 'maxlength'   => '100', 'size' => '35');
    

      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kunden/new_kunde',$data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
        

      $data = array(
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'strasse' => $this->input->post('strasse'),
        'plz' => $this->input->post('plz'),
        'ort' => $this->input->post('ort'),
        'telnr' => $this->input->post('telnr'),
        'email' => $this->input->post('email'),

      );

      if ($this->Kunden_model->process_create_kunde($data)) {
        redirect('kunden');
      } else {

      }
    }        
  }

//--------------------------------------------------------------------------



//Wenn die Edit Funktion gewählt wird, wird die edit_kunde() Funktion aufgerufen.

public function edit_kunde() {
  //Validationsregeln setzen
     $this->form_validation->set_rules('fname', $this->lang->line('fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('lname', $this->lang->line('lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('strasse', $this->lang->line('strasse'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('plz', $this->lang->line('plz'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('ort', $this->lang->line('ort'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('telnr', $this->lang->line('telnr'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
  
  //Der Primärschlüssel des Kunden (kunden.kunde_id) wird an den Edit link angehängt und an
  //die edit_kunde() Funktion angehängt, um nachzuschauen dass der kunde in der Tabelle ist.
  //Die get_kunde_details($id) Funktion des kunden_model nimmt einen Parameterwert von $id -
  //und schaut nach dem Kunden. Ist diese gefunden, werden die Details der Abfrage in eine lokale
  //variable geschrieben und im data array gespeichert. Wird an edit_kunde.php weitergegeben,
  //wo dies gebarucht wird um die Formitems mit den korrekten Daten zu füllen.
  
    if ($this->input->post()) {
      $id = $this->input->post('kunde_id');
    } else {
      $id = $this->uri->segment(3); 
    }
    
    $data['page_heading'] = 'Kunde bearbeiten';                
    //Bestätigung beginnt
    if ($this->form_validation->run() == FALSE) {      
      $query = $this->Kunden_model->get_kunde_details($id);
      foreach ($query->result() as $row) {
        $kunde_id = $row->kunde_id;
        $fname = $row->fname;
        $lname = $row->lname;
        $strasse = $row->strasse;
        $plz = $row->plz;
        $ort = $row->ort;
        $telnr = $row->telnr;
        $email = $row->email;
      
      }
      
      
  $data['fname'] = array('name' => 'fname', 'class' => 'form-control', 'id' => 'fname', 'value' => set_value('fname', $fname), 'maxlength'   => '100', 'size' => '35');
      $data['lname'] = array('name' => 'lname', 'class' => 'form-control', 'id' => 'lname', 'value' => set_value('lname', $lname), 'maxlength'   => '100', 'size' => '35');
      $data['strasse'] = array('name' => 'strasse', 'class' => 'form-control', 'id' => 'strasse', 'value' => set_value('strasse', $strasse), 'maxlength'   => '100', 'size' => '35');
      $data['plz'] = array('name' => 'plz', 'class' => 'form-control', 'id' => 'plz', 'value' => set_value('plz', $plz), 'maxlength'   => '100', 'size' => '35');
      $data['ort'] = array('name' => 'ort', 'class' => 'form-control', 'id' => 'ort', 'value' => set_value('ort', $ort), 'maxlength'   => '100', 'size' => '35');
      $data['telnr'] = array('name' => 'telnr', 'class' => 'form-control', 'id' => 'telnr', 'value' => set_value('telnr', $telnr), 'maxlength'   => '100', 'size' => '35');
      $data['email'] = array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email', $email), 'maxlength'   => '100', 'size' => '35');
      $data['id'] = array('kunde_id' => set_value('kunde_id', $kunde_id));
      
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kunden/edit_kunde', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
//Falls die Formulareingaben stimmen, werden die Kundeninformationen im $data array
//gespeichert.
      $data = array(
        'fname' => $this->input->post('fname'),
        'lname' => $this->input->post('lname'),
        'strasse' => $this->input->post('strasse'),
        'plz' => $this->input->post('plz'),
        'ort' => $this->input->post('ort'),
        'telnr' => $this->input->post('telnr'),
        'email' => $this->input->post('email'),
      );
    
    //Sobald alles hinzugefügt wurde, werden die Kundendetails geupdatet durch
    //process_update_kunde() Funktion des Kunden_model.

        if ($this->Kunden_model->process_update_kunde($id, $data)) {
            redirect('kunden');
    }
  }
}

//--------------------------------------------------------------------------



//Wenn Delete benutz wird in users/view_all_users.php, wird der users controller gerufen
//und darin die Funktion delete_user() genutzt. Gebraucht die users_usr_id Primärschlüssel 
//und wird am Ende des URL Links angefügt und an delete_user($id) Funktion des users_model 
//weitergegeben
    
    
     public function delete_kunde() {
    //Setzen Validationsregeln
   $this->form_validation->set_rules('id', $this->lang->line('kunde_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Kunden_model->get_kunde_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kunden/delete_kunde', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Kunden_model->delete_kunde($id)) {
        redirect('kunden');
      }
    }
  }
  
  //----------------------------------------------------------------
  

}
