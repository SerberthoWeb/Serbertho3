<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Erlaubt Reiseorte zu erfassen in der Struktur:
 * - Reiseort
 * - Kurzbeschreibung
 * - Preis
 * Diese können gemanaget werden.
 * 
 */




class Tour extends MY_Controller {
    
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
        $this->load->helper('string');
        $this->load->helper('text');
        $this->load->model('Tour_model');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
     
  }
  
  //-----------------------------------------------------------------------------
  
  //Lädt die get_all_reisen() Funktion des Reiseort_model, welche alle Reisen in
  //der Reisetabelle zeigt. Das Resultat wird als $data Arrayquery gespeichert und 
  //zu reiseort/view_all_reisen.php weiter geleitet. Zeigt alle Reisen in einem Tabellenformat an
  //mit zwei Optionen: Edit und Löschen.
  
  public function index() {
      

  $data['page_heading'] = 'Tourübersicht';
  $data['query'] = $this->Tour_model->get_all_tour();

  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('tour/view_all_touren', $data);
  $this->load->view('common/footer', $data);
} 

//-----------------------------------------------------------------------------

//Kümmert sich um die Reiseerstellung innerhalb des Systems. 

public function new_tour() {
   // Setzt Validationsregeln
   $this->form_validation->set_rules('tour_title', $this->lang->line('tour_title'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('reiseort_id', $this->lang->line('reiseort_id'), 'required|min_length[1]|max_length[125]');
   $this->form_validation->set_rules('start_d', $this->lang->line('start_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_m', $this->lang->line('start_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_y', $this->lang->line('start_y'), 'min_length[1]|max_length[4]');
   $this->form_validation->set_rules('sunset_d', $this->lang->line('sunset_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('sunset_m', $this->lang->line('sunset_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('sunset_y', $this->lang->line('sunset_y'), 'min_length[1]|max_length[4]');
    $this->form_validation->set_rules('preis', $this->lang->line('preis'), 'required|min_length[1]|max_length[125]');
   
    $this->form_validation->set_rules('usr_id', $this->lang->line('usr_id'), 'required|min_length[1]|max_length[125]');
    
    
    
     $data['page_heading'] = 'Tour';   
    $data['reiseort'] = $this->Tour_model->get_reiseort();
    $data['users'] = $this->Tour_model->get_users();

    
    
 
    
    
  //Nachdem die Bestätigungsregeln gesetzt wurden, wird der return Wert von $this->form->validation() 
  //getestet. Ist es das erste mal, dass die Seite aufgerufen wird oder ein Formitem scheitert an
  //der Bestätigung wird ein FALSE zurück gegeben. Es werden Einstellungen für die HTML Elemente 
  //in kunden/new_kunde.php erstellt.
    
    if ($this->form_validation->run() == FALSE) {
        $data['tour_title'] = array('name' => 'tour_title', 'class' => 'form-control', 'id' => 'tour_title', 'value' => set_value('tour_title', ''), 'maxlength'   => '100', 'size' => '35');
       $data['preis'] = array('name' => 'preis', 'class' => 'form-control', 'id' => 'preis', 'value' => set_value('preis', ''), 'maxlength'   => '100', 'size' => '35');
     $data['start_d']              = array('name' => 'start_d', 'class' => 'form-control', 'id' => 'start_d', 'value' => set_value('start_d', ''), 'maxlength'   => '100', 'size' => '35');
      $data['start_m']              = array('name' => 'start_m', 'class' => 'form-control', 'id' => 'start_m', 'value' => set_value('start_m', ''), 'maxlength'   => '100', 'size' => '35');
      $data['start_y']              = array('name' => 'start_y', 'class' => 'form-control', 'id' => 'start_y', 'value' => set_value('start_y', ''), 'maxlength'   => '100', 'size' => '35');
          $data['sunset_d']             = array('name' => 'sunset_d', 'class' => 'form-control', 'id' => 'sunset_d', 'value' => set_value('sunset_d', ''), 'maxlength'   => '100', 'size' => '35');
      $data['sunset_m']             = array('name' => 'sunset_m', 'class' => 'form-control', 'id' => 'sunset_m', 'value' => set_value('sunset_m', ''), 'maxlength'   => '100', 'size' => '35');
      $data['sunset_y']             = array('name' => 'sunset_y', 'class' => 'form-control', 'id' => 'sunset_y', 'value' => set_value('sunset_y', ''), 'maxlength'   => '100', 'size' => '35');
     
      
     
    

      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('tour/new_tour', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
      $save_data = array(
        'tour_title' => $this->input->post('tour_title'),
        'reiseort_id' => $this->input->post('reiseort_id'),
        'preis' => $this->input->post('preis'),
        'reiseabfahrt' => $this->input->post('start_d') .'-'.$this->input->post('start_m').'-'.$this->input->post('sunset_y'),
        'reiseankunft' => $this->input->post('sunset_y') .'-'.$this->input->post('sunset_m').'-'.$this->input->post('sunset_d'),
        'usr_id' => $this->input->post('usr_id'),
          );

      if ($this->Tour_model->save_tour($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('tour'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('tour'); 
      }
    }    
  } 

  
//--------------------------------------------------------------------------
//Wenn die Edit Funktion gewählt wird, wird die edit_kunde() Funktion aufgerufen.

public function edit_tour() {
  //Validationsregeln setzen
    $this->form_validation->set_rules('tour_id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('tour_title', $this->lang->line('tour_title'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('reiseabfahrt', $this->lang->line('reiseabfahrt'), 'required|min_length[1]|max_length[125]');   
    $this->form_validation->set_rules('reiseankunft', $this->lang->line('reiseankunft'), 'required|min_length[1]|max_length[125]');  

    $this->form_validation->set_rules('preis', $this->lang->line('preis'), 'required|min_length[1]|max_length[125]');   
  //Der Primärschlüssel des Kunden (kunden.kunde_id) wird an den Edit link angehängt und an
  //die edit_kunde() Funktion angehängt, um nachzuschauen dass der kunde in der Tabelle ist.
  //Die get_kunde_details($id) Funktion des kunden_model nimmt einen Parameterwert von $id -
  //und schaut nach dem Kunden. Ist diese gefunden, werden die Details der Abfrage in eine lokale
  //variable geschrieben und im data array gespeichert. Wird an edit_kunde.php weitergegeben,
  //wo dies gebarucht wird um die Formitems mit den korrekten Daten zu füllen.
  
    if ($this->input->post()) {
      $id = $this->input->post('tour_id');
    } else {
      $id = $this->uri->segment(3); 
    }
    
    $data['page_heading'] = 'Tour editieren';                
    //Bestätigung beginnt
    if ($this->form_validation->run() == FALSE) {      
        
        
      $query = $this->Tour_model->get_tour_details($id);
  
      
      
      foreach ($query->result() as $row) {
        $tour_id = $row->tour_id;
        $tour_title = $row->tour_title;
        $reiseort_id = $row->reiseort_id ;
        $reiseabfahrt = $row->reiseabfahrt ;
        $reiseankunft = $row->reiseankunft;
        $usr_id = $row->usr_id;
        $preis = $row->preis;

      }
      
      
      $data['tour_title'] = array('name' => 'tour_title', 'class' => 'form-control', 'id' => 'tour_title', 'value' => set_value('tour_title', $tour_title), 'maxlength'   => '100', 'size' => '35');
      $data['reiseort_id'] = array('name' => 'reiseort_id', 'class' => 'form-control', 'id' => 'reiseort_id', 'value' => set_value('reiseort_id', $reiseort_id), 'maxlength'   => '100', 'size' => '35');
      $data['reiseabfahrt'] = array('name' => 'reiseabfahrt', 'class' => 'form-control', 'id' => 'reiseabfahrt', 'value' => set_value('reiseabfahrt', $reiseabfahrt), 'maxlength'   => '100', 'size' => '35');
      $data['reiseankunft'] = array('name' => 'reiseankunft', 'class' => 'form-control', 'id' => 'reiseankunft', 'value' => set_value('reiseankunft', $reiseankunft), 'maxlength'   => '100', 'size' => '35');
      $data['usr_id'] = array('name' => 'usr_id', 'class' => 'form-control', 'id' => 'usr_id', 'value' => set_value('usr_id', $usr_id), 'maxlength'   => '100', 'size' => '35');
      $data['preis'] = array('name' => 'preis', 'class' => 'form-control', 'id' => 'preis', 'value' => set_value('preis', $preis), 'maxlength'   => '100', 'size' => '35');

      $data['id'] = array('tour_id' => set_value('tour_id', $tour_id));
      

      $data['reiseort'] = $this->Tour_model->get_reiseort();
      $data['users'] = $this->Tour_model->get_users();
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('tour/edit_tour', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
//Falls die Formulareingaben stimmen, werden die Kundeninformationen im $data array
//gespeichert.
      $data = array(
        'tour_title' => $this->input->post('tour_title'),
        'reiseort_id' => $this->input->post('reiseort_id'),
        'reiseabfahrt' => $this->input->post('reiseabfahrt'),
        'reiseankunft' => $this->input->post('reiseankunft'),
        'usr_id' => $this->input->post('usr_id'),
        'preis' => $this->input->post('preis'),
      );
    
    //Sobald alles hinzugefügt wurde, werden die Kundendetails geupdatet durch
    //process_update_kunde() Funktion des Kunden_model.

        if ($this->Tour_model->edit_tour($id, $data)) {
            redirect('tour');
    }
  }
}

//--------------------------------------------------------------------------




//Wenn Delete benutz wird in users/view_all_users.php, wird der users controller gerufen
//und darin die Funktion delete_user() genutzt. Gebraucht die users_usr_id Primärschlüssel 
//und wird am Ende des URL Links angefügt und an delete_user($id) Funktion des users_model 
//weitergegeben
    
    
     public function delete_tour() {
    //Setzen Validationsregeln
    $this->form_validation->set_rules('id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Tour_model->get_tour_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('tour/delete_tour', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Tour_model->delete_tour($id)) {
        redirect('tour');
      }
    }
  }
  
  //----------------------------------------------------------------
  

}


/* End of file tour.php */
/* Location: ./application/controllers/tour.php */