<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kosten extends MY_Controller {
    
    
  function __construct() {
  parent::__construct();
  
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->model('Tour_model');
    $this->load->model('Kosten_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  //---------------------------------------------------------------------------------
  
  public function index() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Kosten_model->get_kosten($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

    
      
      
      

  $page_data['query'] = $this->Kosten_model->get_kosten($this->input->post('search_string'));
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
    $this->form_validation->set_rules('start_d', $this->lang->line('start_d'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_m', $this->lang->line('start_m'), 'min_length[1]|max_length[2]');
    $this->form_validation->set_rules('start_y', $this->lang->line('start_y'), 'min_length[1]|max_length[4]');
    
    
    $page_data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
    $page_data['tour'] = $this->Kosten_model->get_tour();
    $page_data['page_heading'] = 'Kosten';
   
     
    if ($this->form_validation->run() == FALSE) {
        $page_data['kosten'] = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', ''), 'maxlength'   => '100', 'size' => '35');
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
  
  
    public function uebersicht() {
  $data['page_heading'] = 'Tourübersicht';
  $data['query'] = $this->Kosten_model->get_reisen();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('kosten/uebersicht', $data);
  $this->load->view('common/footer', $data);
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









}

/* End of file jobs.php */
/* Location: ./application/controllers/jobs.php */