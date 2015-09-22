<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Erlaubt Reiseorte zu erfassen in der Struktur:
 * - Reiseort
 * - Kurzbeschreibung
 * - Preis
 * Diese können gemanaget werden.
 * 
 */




class Reisen extends MY_Controller {
    
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
   
    $this->load->model('Reise_model');
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->library('form_validation');
     
  }
  
  //-----------------------------------------------------------------------------
  
  //Lädt die get_all_reisen() Funktion des Reiseort_model, welche alle Reisen in
  //der Reisetabelle zeigt. Das Resultat wird als $data Arrayquery gespeichert und 
  //zu reiseort/view_all_reisen.php weiter geleitet. Zeigt alle Reisen in einem Tabellenformat an
  //mit zwei Optionen: Edit und Löschen.
  
  public function index() {
  $data['page_heading'] = 'Reiseortübersicht';
  $data['query'] = $this->Reise_model->get_all_reisen();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('reisen/view_all_reisen', $data);
  $this->load->view('common/footer', $data);
} 

//-----------------------------------------------------------------------------

//Kümmert sich um die Reiseerstellung innerhalb des Systems. 

public function new_reise() {
   // Setzt Validationsregeln
    $this->form_validation->set_rules('reiseort', $this->lang->line('reiseort'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('kzbeschreib', $this->lang->line('kzbeschreib'), 'required|min_length[1]|max_length[125]');

    
    $data['page_heading'] = 'Neuen Reiseort anlegen';
    
    
  //Nachdem die Bestätigungsregeln gesetzt wurden, wird der return Wert von $this->form->validation() 
  //getestet. Ist es das erste mal, dass die Seite aufgerufen wird oder ein Formitem scheitert an
  //der Bestätigung wird ein FALSE zurück gegeben. Es werden Einstellungen für die HTML Elemente 
  //in kunden/new_kunde.php erstellt.
    
    if ($this->form_validation->run() == FALSE) {
      $data['reiseort'] = array('name' => 'reiseort', 'class' => 'form-control', 'id' => 'reiseort', 'value' => set_value('reiseort', ''), 'maxlength'   => '100', 'size' => '35');
      $data['kzbeschreib'] = array('name' => 'kzbeschreib', 'class' => 'form-control', 'id' => 'kzbeschreib', 'value' => set_value('kzbeschreib', ''), 'maxlength'   => '2000', 'rows' => '20', 'cols' => '35');
      

      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('reisen/new_reise',$data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
        

      $data = array(
        'reiseort' => $this->input->post('reiseort'),
        'kzbeschreib' => $this->input->post('kzbeschreib'),

      );

      
      if ($this->Reise_model->process_create_reise($data)) {
        redirect('reisen');
      } else {

      }
    }        
  }

//--------------------------------------------------------------------------



//Wenn die Edit Funktion gewählt wird, wird die edit_reise() Funktion aufgerufen.

public function edit_reise() {
  //Validationsregeln setzen
     $this->form_validation->set_rules('reiseort_id', $this->lang->line('reiseort_id'), 'required|min_length[1]|max_length[125]');
     $this->form_validation->set_rules('reiseort', $this->lang->line('reiseort'), 'required|min_length[1]|max_length[125]');
     $this->form_validation->set_rules('kzbeschreib', $this->lang->line('kzbeschreib'), 'required|min_length[1]|max_length[500]');
   
    
  
  //Der Primärschlüssel des Reiseortes(reiseort.reiseort_id) wird an den Edit link angehängt und an
  //die edit_reise() Funktion angehängt, um nachzuschauen dass die Reise in der Tabelle ist.
  //Die get_reise_details($id) Funktion des kunden_model nimmt einen Parameterwert von $id -
  //und schaut nach den vorhandenen Reisen. Ist diese gefunden, werden die Details der Abfrage in eine lokale
  //Variable geschrieben und im data-Array gespeichert. Wird an edit_reise.php weitergegeben,
  //wo dies gebraucht wird um die Formitems mit den korrekten Daten zu füllen.
  
    if ($this->input->post()) {
      $id = $this->input->post('reiseort_id');
    } else {
      $id = $this->uri->segment(3); 
    }
    
    $data['page_heading'] = 'Reise bearbeiten';                
    //Bestätigung beginnt
    if ($this->form_validation->run() == FALSE) {      
      $query = $this->Reise_model->get_reise_details($id);
      foreach ($query->result() as $row) {
        $reiseort_id = $row->reiseort_id;
        $reiseort = $row->reiseort;
        $kzbeschreib = $row->kzbeschreib;
       
      
      }
      
      
      $data['reiseort'] = array('name' => 'reiseort', 'class' => 'form-control', 'id' => 'reiseort', 'value' => set_value('reiseort', $reiseort), 'maxlength'   => '100', 'size' => '35');
      $data['kzbeschreib'] = array('name' => 'kzbeschreib', 'class' => 'form-control', 'id' => 'kzbeschreib', 'value' => set_value('kzbeschreib', $kzbeschreib), 'maxlength'   => '3000', 'rows' => '6', 'cols' => '35');
      $data['id'] = array('reiseort_id' => set_value('reiseort_id', $reiseort_id));
      
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('reisen/edit_reise', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
//Falls die Formulareingaben stimmen, werden die Kundeninformationen im $data array
//gespeichert.
      $data = array(
        'reiseort' => $this->input->post('reiseort'),
        'kzbeschreib' => $this->input->post('kzbeschreib'),

      );
    
    //Sobald alles hinzugefügt wurde, werden die Kundendetails geupdatet durch
    //process_update_kunde() Funktion des Kunden_model.

        if ($this->Reise_model->process_update_reise($id, $data)) {
            redirect('reisen');
    }
  }
}

//--------------------------------------------------------------------------



//Wenn Delete benutz wird in users/view_all_users.php, wird der users controller gerufen
//und darin die Funktion delete_user() genutzt. Gebraucht die users_usr_id Primärschlüssel 
//und wird am Ende des URL Links angefügt und an delete_user($id) Funktion des users_model 
//weitergegeben
    
    
     public function delete_reise() {
    //Setzen Validationsregeln
   $this->form_validation->set_rules('id', $this->lang->line('reiseort_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Reise_model->get_reise_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('reisen/delete_reise', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Reise_model->delete_reise($id)) {
        redirect('reisen');
      }
    }
  }
  
  //----------------------------------------------------------------
  

}


/* End of file reisen.php */
/* Location: ./application/controllers/reisen.php */