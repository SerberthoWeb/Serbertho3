<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kosten extends MY_Controller {
    
  //---------------------------------------------------------------------------------
    
  function __construct() {
  parent::__construct();
  
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->model('Tour_model');
    $this->load->model('Kosten_model');
    $this->load->helper('date');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  //---------------------------------------------------------------------------------
  
  public function index($per_page=5, $order_by='kosten_id', $order='asc', $offset=0) {

   
    $data['per_page'] = $per_page;
    $data['offset'] = $offset;
    $data['order']['kosten_id'] = 'asc';
    $data['order']['kostenstelle_id'] = 'asc';
    $data['order']['kosten'] = 'asc';
    $data['order']['tour_id'] = 'asc';
    $data['order']['r_nummer'] = 'asc';
    $data['order']['datum'] = 'asc';
    if($order=='asc'){
        $data['order'][$order_by] = 'desc';
    } else {
        $data['order'][$order_by] = 'asc';
    }
   $data['total_rows'] = $this->Kosten_model->kostendata()->num_rows();
    $data['query'] = $this->Kosten_model->kostendata($order_by, $order, $per_page, $offset);

    //initializing & configuring paging
    $this->load->library('pagination');
    $config['base_url'] = site_url('/kosten/index/'.$per_page.'/'.$order_by.'/'.$order);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 6;
    $config['total_rows'] = $data['total_rows'];
    $config['full_tag_open'] = '<div id="pagination">';
    $config['full_tag_close'] = '</div>';		

    $this->pagination->initialize($config);

    $data['page_heading'] = 'Kostenübersicht';
    $this->load->view('common/header', $data);
    $this->load->view('nav/top_nav', $data);
    $this->load->view('kosten/view_all_kosten', $data);
    $this->load->view('common/footer', $data);
}
   
    
     //---------------------------------------------------------------------------------

  
  
  public function kostenstellen() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Kosten_model->get_kostenstellen($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');


  $page_data['query'] = $this->Kosten_model->get_kostenstellen($this->input->post('search_string'));
  $page_data['page_heading'] = 'Kostenübersicht';
  $this->load->view('common/header');
  $this->load->view('nav/top_nav');
  $this->load->view('kosten/view_all_kosten', $page_data);
  $this->load->view('common/footer');
      } else {
          $page_data['page_heading'] = 'Kostenübersicht';
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/view_all_kosten', $page_data);
      $this->load->view('common/footer');      
    }    
  }
    
     //---------------------------------------------------------------------------------
  
  
  public function rechnungsnummer() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Kosten_model->get_kosten_rechnungsnummer($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

 

  $page_data['query'] = $this->Kosten_model->get_kosten_rechnungsnummer($this->input->post('search_string'));
  $page_data['page_heading'] = 'Kostenübersicht';
  $this->load->view('common/header');
  $this->load->view('nav/top_nav');
  $this->load->view('kosten/view_all_kosten', $page_data);
  $this->load->view('common/footer');
      } else {
          $page_data['page_heading'] = 'Kostenübersicht';
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/view_all_kosten', $page_data);
      $this->load->view('common/footer');      
    }    
  }
    
  
      //---------------------------------------------------------------------------------

  public function reisename() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Kosten_model->get_kosten_reisename($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

 

  $page_data['query'] = $this->Kosten_model->get_kosten_reisename($this->input->post('search_string'));
  $page_data['page_heading'] = 'Kostenübersicht';
  $this->load->view('common/header');
  $this->load->view('nav/top_nav');
  $this->load->view('kosten/view_all_kosten', $page_data);
  $this->load->view('common/footer');
      } else {
          $page_data['page_heading'] = 'Kostenübersicht';
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/view_all_kosten', $page_data);
      $this->load->view('common/footer');      
    }    
  }
  
       //--------------------------------------------------------------------------------- 
       
       
  //Nachdem die Bestätigungsregeln gesetzt wurden, wird der return Wert von $this->form->validation() 
  //getestet. Ist es das erste mal, dass die Seite aufgerufen wird oder ein Formitem scheitert an
  //der Bestätigung wird ein FALSE zurück gegeben. Es werden Einstellungen für die HTML Elemente 
  //in kunden/new_kunde.php erstellt.

  
  public function new_kosten() {
    
   
    $this->form_validation->set_rules('kostenstelle_id', $this->lang->line('job_desc'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('kosten', $this->lang->line('kosten'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('tour_id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[125]');
     $this->form_validation->set_rules('r_nummer', $this->lang->line('r_nummer'), 'required|min_length[1]|max_length[20]');
    $this->form_validation->set_rules('start_d', $this->lang->line('start_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_m', $this->lang->line('start_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_y', $this->lang->line('start_y'), 'min_length[1]|max_length[4]');
    
    
    $page_data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
    $page_data['tour'] = $this->Kosten_model->get_tour();
    $page_data['page_heading'] = 'Kosten';
   
     
    if ($this->form_validation->run() == FALSE) {
        $page_data['kosten'] = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', ''), 'maxlength'   => '100', 'size' => '35');
         $page_data['r_nummer'] = array('name' => 'r_nummer', 'class' => 'form-control', 'id' => 'r_nummer', 'value' => set_value('r_nummer', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_d']              = array('name' => 'start_d', 'class' => 'form-control', 'id' => 'start_d', 'value' => set_value('start_d', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_m']              = array('name' => 'start_m', 'class' => 'form-control', 'id' => 'start_m', 'value' => set_value('start_m', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_y']              = array('name' => 'start_y', 'class' => 'form-control', 'id' => 'start_y', 'value' => set_value('start_y', ''), 'maxlength'   => '100', 'size' => '35');
      
        
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/new_kosten', $page_data);
      $this->load->view('common/footer');      
      
    } else {
      $save_data = array(
        'kostenstelle_id' => $this->input->post('kostenstelle_id'),
        'kosten' => $this->input->post('kosten'),
        'r_nummer' => $this->input->post('r_nummer'),
        'tour_id' => $this->input->post('tour_id'),
        'datum' => $this->input->post('start_y').'.'.$this->input->post('start_m').'.'.$this->input->post('start_d'),
        );

      if ($this->Kosten_model->save_kosten($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('kosten'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kosten'); 
      }
    }    
  } 
   //---------------------------------------------------------------------------------
  
  public function umrechnen() {
   
              //ruft Währungsumrechnung auf
        
        $url = "http://currency-api.appspot.com/api/EUR/CHF.json?";

        $resultabc = file_get_contents($url);
        $resultxyz = json_decode($resultabc);
   if ($resultxyz->success) {
    
         $page_data['umrechnen'] = $resultxyz->rate;
}         
  
    $this->form_validation->set_rules('kostenstelle_id', $this->lang->line('job_desc'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('kosten', $this->lang->line('kosten'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('tour_id', $this->lang->line('tour_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('r_nummer', $this->lang->line('r_nummer'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('start_d', $this->lang->line('start_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_m', $this->lang->line('start_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_y', $this->lang->line('start_y'), 'min_length[1]|max_length[4]');
    
    
    $page_data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
    $page_data['tour'] = $this->Kosten_model->get_tour();
    $page_data['page_heading'] = 'Kosten';
   
     
    if ($this->form_validation->run() == FALSE) {
        $page_data['kosten'] = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', ''), 'maxlength'   => '100', 'size' => '35');
         $page_data['r_nummer'] = array('name' => 'r_nummer', 'class' => 'form-control', 'id' => 'r_nummer', 'value' => set_value('r_nummer', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_d']              = array('name' => 'start_d', 'class' => 'form-control', 'id' => 'start_d', 'value' => set_value('start_d', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_m']              = array('name' => 'start_m', 'class' => 'form-control', 'id' => 'start_m', 'value' => set_value('start_m', ''), 'maxlength'   => '100', 'size' => '35');
        $page_data['start_y']              = array('name' => 'start_y', 'class' => 'form-control', 'id' => 'start_y', 'value' => set_value('start_y', ''), 'maxlength'   => '100', 'size' => '35');
      
        
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/new_kosten', $page_data);
      $this->load->view('common/footer');      
      
    } else {
      $save_data = array(
        'kostenstelle_id' => $this->input->post('kostenstelle_id'),
        'kosten' => $this->input->post('kosten'),
        'r_nummer' => $this->input->post('r_nummer'),
        'tour_id' => $this->input->post('tour_id'),
        'datum' => $this->input->post('start_y').'-'.$this->input->post('start_m').'-'.$this->input->post('start_d'),
        );

      if ($this->Kosten_model->save_kosten($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('kosten'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kosten'); 
      }
    }    
  } 
  
    //---------------------------------------------------------------------------------
  
  
  
        public function new_kostenstelle() {
            
            
         $this->form_validation->set_rules('kostenstelle_name', $this->lang->line('kostenstelle_name'), 'required|min_length[1]|max_length[50]');
             
         $page_data['page_heading'] = 'Kostenstelle';
         $page_data['query'] = $this->Kosten_model->get_kostenstelle();
  
         if ($this->form_validation->run() == FALSE) {
         $page_data['kostenstelle_name'] = array('name' => 'kostenstelle_name', 'class' => 'form-control', 'id' => 'kostenstelle_name', 'value' => set_value('kostenstelle_name', ''), 'maxlength'   => '100', 'size' => '35');   
    

      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/new_kostenstelle', $page_data);
      $this->load->view('common/footer');      
    } else {
      $save_data = array(
        'kostenstelle_name' => $this->input->post('kostenstelle_name'),
        );

        if ($this->Kosten_model->save_kostenstelle($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('kosten/kostenstelle'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kosten/kostenstelle'); 
      }
    }    
  } 

  
     //---------------------------------------------------------------------------------
  
    public function kostenstelle() {
  $data['page_heading'] = 'Kostenstellenübersicht';
  $data['query'] = $this->Kosten_model->get_kostenstelle();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('kosten/kostenstelle', $data);
  $this->load->view('common/footer', $data);
} 
   
    //--------------------------------------------------------------------------------- 
       

    public function delete_kostenstelle() {
    //Setzen Validationsregeln
   $this->form_validation->set_rules('id', $this->lang->line('kostenstelle_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Kosten_model->get_kostenstelle_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kosten/delete_kostenstelle', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Kosten_model->delete_kostenstelle($id)) {
        redirect('kosten/kostenstelle');
      }
    }
  }


    //--------------------------------------------------------------------------------- 
       

    public function delete_kosten() {
    //Setzen Validationsregeln
   $this->form_validation->set_rules('id', $this->lang->line('kosten_id'), 'required|min_length[1]|max_length[11]|integer|is_natural');

    if ($this->input->post()) {
      $id = $this->input->post('id');
    } else {
      $id = $this->uri->segment(3);
    }
    

    $data['page_heading'] = 'Wirklich löschen?';
    if ($this->form_validation->run() == FALSE) { //Erstes mal geladen, oder sonstige Probs mit dem Formuar
      $data['query'] = $this->Kosten_model->get_kosten_details($id);
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kosten/delete_kosten', $data);
      $this->load->view('common/footer', $data);
    } else {
      if ($this->Kosten_model->delete_kosten($id)) {
        redirect('kosten');
      }
    }
    }
 //--------------------------------------------------------------------------------- 

    
    public function edit_kosten() {
  //Validationsregeln setzen
     $this->form_validation->set_rules('kosten_id', $this->lang->line('kosten_id'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('kosten', $this->lang->line('kosten'), 'required|min_length[1]|max_length[125]'); 
    $this->form_validation->set_rules('r_nummer', $this->lang->line('r_nummer'), 'required|min_length[1]|max_length[125]');
    $this->form_validation->set_rules('datum', $this->lang->line('datum'), 'required|min_length[1]|max_length[125]');
    
  //Der Primärschlüssel des Kunden (kunden.kunde_id) wird an den Edit link angehängt und an
  //die edit_kunde() Funktion angehängt, um nachzuschauen dass der kunde in der Tabelle ist.
  //Die get_kunde_details($id) Funktion des kunden_model nimmt einen Parameterwert von $id -
  //und schaut nach dem Kunden. Ist diese gefunden, werden die Details der Abfrage in eine lokale
  //variable geschrieben und im data array gespeichert. Wird an edit_kunde.php weitergegeben,
  //wo dies gebarucht wird um die Formitems mit den korrekten Daten zu füllen.
  
    if ($this->input->post()) {
      $id = $this->input->post('kosten_id');
    } else {
      $id = $this->uri->segment(3); 
    }
    
    $data['page_heading'] = 'Kosten';                
    //Bestätigung beginnt
    if ($this->form_validation->run() == FALSE) {      
        
        
      $query = $this->Kosten_model->get_kosten_details($id);
  
      foreach ($query->result() as $row) {
        $kosten_id = $row->kosten_id;
        $kostenstelle_id = $row->kostenstelle_id;
        $kosten = $row->kosten;
        $tour_id = $row->tour_id;
        $r_nummer = $row->r_nummer;
        $datum = $row->datum;
      }
      
      
      $data['kostenstelle_id'] = array('name' => 'kostenstelle_id', 'class' => 'form-control', 'id' => 'kostenstelle_id', 'value' => set_value('kostenstelle_id', $kostenstelle_id), 'maxlength'   => '100', 'size' => '35');
      $data['kosten'] = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', $kosten), 'maxlength'   => '100', 'size' => '35');
      $data['tour_id'] = array('name' => 'tour_id', 'class' => 'form-control', 'id' => 'tour_id', 'value' => set_value('tour_id', $tour_id), 'maxlength'   => '100', 'size' => '35');
      $data['r_nummer'] = array('name' => 'r_nummer', 'class' => 'form-control', 'id' => 'r_nummer', 'value' => set_value('r_nummer', $r_nummer), 'maxlength'   => '100', 'size' => '35');
      $data['datum'] = array('name' => 'datum', 'class' => 'form-control', 'id' => 'datum', 'value' => set_value('datum', $datum), 'maxlength'   => '100', 'size' => '35');
      $data['id'] = array('kosten_id' => set_value('kosten_id', $kosten_id));
      
      $data['tour'] = $this->Kosten_model->get_tour();
      $data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('kosten/edit_kosten', $data);
      $this->load->view('common/footer', $data);
    } else { // Validation bestanden
    
//Falls die Formulareingaben stimmen, werden die Kundeninformationen im $data array
//gespeichert.
      $data = array(
        'kostenstelle_id' => $this->input->post('kostenstelle_id'),
        'kosten' => $this->input->post('kosten'),
        'tour_id' => $this->input->post('tour_id'),
        'r_nummer' => $this->input->post('r_nummer'),
        'datum' => $this->input->post('datum')
      );
    
    //Sobald alles hinzugefügt wurde, werden die Kundendetails geupdatet durch
    //process_update_kunde() Funktion des Kunden_model.

        if ($this->Kosten_model->process_update_kosten($id, $data)) {
            redirect('kosten');
    }
  }
}


 //--------------------------------------------------------------------------------- 
}

/* End of file kosten.php */
/* Location: ./application/controllers/kosten.php */