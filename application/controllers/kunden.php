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
    $this->load->helper('string');
    $this->load->helper('text');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
     
  }
  
  //-----------------------------------------------------------------------------
  
  //Lädt die get_all_kunden() Funktion des Kunden_model, welche alle Kunden in
  //der Kundentabelle zeigt. Das Resultat wird als $data Arrayquery gespeichert und 
  //zu kunden/view_all_kunden.php geleitet. Zeigt alle Kunden in einem Tabellenformat an
  //mit zwei Optionen: Edit und Löschen.
  
public function index($per_page=5, $order_by='kunde_id', $order='asc', $offset=0) {
    $data['per_page'] = $per_page;
    $data['offset'] = $offset;
    $data['order']['kunde_id'] = 'asc';
    $data['order']['fname'] = 'asc';
    $data['order']['lname'] = 'asc';
    $data['order']['strasse'] = 'asc';
    $data['order']['plz'] = 'asc';
    $data['order']['ort'] = 'asc';
    $data['order']['telnr'] = 'asc';
    $data['order']['email'] = 'asc';
    $data['order']['tour_id'] = 'asc';
    if($order=='asc'){
        $data['order'][$order_by] = 'desc';
    } else {
        $data['order'][$order_by] = 'asc';
    }
    $data['total_rows'] = $this->Kunden_model->kundendata()->num_rows();
    $data['query'] = $this->Kunden_model->kundendata($order_by, $order, $per_page, $offset);

    //initializing & configuring paging
    $this->load->library('pagination');
    $config['base_url'] = site_url('/kunden/index/'.$per_page.'/'.$order_by.'/'.$order);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 6;
    $config['total_rows'] = $data['total_rows'];
    $config['full_tag_open'] = '<div id="pagination">';
    $config['full_tag_close'] = '</div>';		

    $this->pagination->initialize($config);

    $data['page_heading'] = 'Kundenübersicht';
    $this->load->view('common/header', $data);
    $this->load->view('nav/top_nav', $data);
    $this->load->view('kunden/view_all_kunden', $data);
    $this->load->view('common/footer', $data);
}
//-----------------------------------------------------------------------------
  
  public function search_kunde() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
      $data['query'] = $this->Kunden_model->get_all_kunden($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

    
      
      
      
         $data['query'] = $this->Kunden_model->get_all_kunden($this->input->post('search_string'));
         $data['page_heading'] = 'Kundenübersicht';
  
        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('kunden/view_all_kunden', $data);
        $this->load->view('common/footer');
  
      } else {
          
      $page_data['page_heading'] = 'Kundenübersicht';
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kunden/view_all_kunden', $data);
      $this->load->view('common/footer', $data);      
    }    
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
    $this->form_validation->set_rules('tour_id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[125]');
    
    
  
    $data['tour'] = $this->Kunden_model->get_tour();
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
        'tour_id' => $this->input->post('tour_id'),

      );

      if ($this->Kunden_model->process_create_kunde($data)) {
        redirect('kunden');
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kunden'); 
      }
    }        
  }

//--------------------------------------------------------------------------



//Wenn die Edit Funktion gewählt wird, wird die edit_kunde() Funktion aufgerufen.

public function edit_kunde() {
  //Validationsregeln setzen
    $this->form_validation->set_rules('kunde_id', $this->lang->line('kunde_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('fname', $this->lang->line('fname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('lname', $this->lang->line('lname'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('strasse', $this->lang->line('strasse'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('plz', $this->lang->line('plz'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('ort', $this->lang->line('ort'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('telnr', $this->lang->line('telnr'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|min_length[1]|max_length[255]|valid_email|is_unique[users.usr_email]');
    $this->form_validation->set_rules('tour_id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[125]');   
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
    
    $data['page_heading'] = 'Kunde';                
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
        $tour_id = $row->tour_id;
      }
      
      
      $data['fname'] = array('name' => 'fname', 'class' => 'form-control', 'id' => 'fname', 'value' => set_value('fname', $fname), 'maxlength'   => '100', 'size' => '35');
      $data['lname'] = array('name' => 'lname', 'class' => 'form-control', 'id' => 'lname', 'value' => set_value('lname', $lname), 'maxlength'   => '100', 'size' => '35');
      $data['strasse'] = array('name' => 'strasse', 'class' => 'form-control', 'id' => 'strasse', 'value' => set_value('strasse', $strasse), 'maxlength'   => '100', 'size' => '35');
      $data['plz'] = array('name' => 'plz', 'class' => 'form-control', 'id' => 'plz', 'value' => set_value('plz', $plz), 'maxlength'   => '100', 'size' => '35');
      $data['ort'] = array('name' => 'ort', 'class' => 'form-control', 'id' => 'ort', 'value' => set_value('ort', $ort), 'maxlength'   => '100', 'size' => '35');
      $data['telnr'] = array('name' => 'telnr', 'class' => 'form-control', 'id' => 'telnr', 'value' => set_value('telnr', $telnr), 'maxlength'   => '100', 'size' => '35');
      $data['email'] = array('name' => 'email', 'class' => 'form-control', 'id' => 'email', 'value' => set_value('email', $email), 'maxlength'   => '100', 'size' => '35');
      $data['tour_id'] = array('name' => 'tour_id', 'class' => 'form-control', 'id' => 'tour_id', 'value' => set_value('tour_id', $tour_id), 'maxlength'   => '100', 'size' => '35');
      $data['id'] = array('kunde_id' => set_value('kunde_id', $kunde_id));
      
      $data['tour'] = $this->Kunden_model->get_tour();
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
        'tour_id' => $this->input->post('tour_id'),
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
  
  
  

  //----------------------------------------------------------------

}


/* End of file kunden.php */
/* Location: ./application/controllers/kunden.php */