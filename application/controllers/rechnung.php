<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rechnung extends MY_Controller {
    
    
  function __construct() {
  parent::__construct();
    $this->load->helper('string');
    $this->load->helper('text');
    $this->load->model('Rechnung_model');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

    //--------------------------------------------------------------------------
  
  
  public function index() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $page_data['query'] = $this->Rechnung_model->get_rechnung($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $page_data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');
$page_data['page_heading'] = 'Übersicht';
      $page_data['query'] = $this->Rechnung_model->get_rechnung($this->input->post('search_string'));
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('rechnung/view', $page_data);
      $this->load->view('common/footer');
    } else {
        $page_data['page_heading'] = 'Übersicht';
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('rechnung/view', $page_data);
      $this->load->view('common/footer');      
    }    
  }

  
  //----------------------------------------------------------------------------
   
     public function apply() { 
         
         
    if ($this->input->post()) {
      $page_data['tour_id'] = $this->input->post('tour_id');
      
    } else {
      $page_data['tour_id'] = $this->uri->segment(3);
      
    }

    $page_data['query'] = $this->Rechnung_model->get_uebersicht($page_data['tour_id']);
    $page_data['querykunden'] = $this->Rechnung_model->get_uebersicht_kunden($page_data['tour_id']);
     $page_data['querykosten'] = $this->Rechnung_model->get_gesamtkosten($page_data['tour_id']);
    $page_data['queryeinnahmen'] = $this->Rechnung_model->get_preis($page_data['tour_id']);

    if ($page_data['query']->num_rows() != 0) {
      foreach ($page_data['query']->result() as $row) {
        $page_data['tour_title'] = $row->tour_title;
        $page_data['tour_id'] = $row->tour_id;
     
      }
      
    } else {
        
      $this->session->set_flashdata('flash_message', $this->lang->line('app_job_no_longer_exists'));  
      redirect('rechnung');    
    }
   
   $page_data['page_heading'] = 'Übersicht';
    $this->load->view('common/header');
    $this->load->view('nav/top_nav');
    $this->load->view('rechnung/apply', $page_data); 
    $this->load->view('common/footer');  
  }

  
  
  //----------------------------------------------------------------------------
  
  

   public function kosten() { 
  
    $this->form_validation->set_rules('kostenstelle_id', $this->lang->line('job_desc'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('kosten', $this->lang->line('cat_id'), 'required|min_length[1]|max_length[11]');
 

    $page_data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
     $page_data['page_heading'] = 'Kosten';
     
    if ($this->form_validation->run() == FALSE) {
   
    
      $page_data['kosten'] = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', ''), 'maxlength'   => '100', 'size' => '35');
  
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/new_kosten', $page_data);
      $this->load->view('common/footer');      
    } else {
      $save_data = array(
        'kostenstelle_id' => $this->input->post('kostenstelle_id'),
        'kosten' => $this->input->post('kosten'),
       
        );

      if ($this->Kosten_model->save_kosten($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('kosten/apply/'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kosten'); 
      }
    }    
   
   }

   
   
   //----------------------------------------------------------------------------
   
   
   
   
  public function new_kosten() {
    
   $page_data['page_heading'] = 'Kostenübersicht';
    $this->form_validation->set_rules('kostenstelle_id', $this->lang->line('job_desc'), 'required|min_length[1]|max_length[11]');
    $this->form_validation->set_rules('kosten', $this->lang->line('cat_id'), 'required|min_length[1]|max_length[11]');
 

    $page_data['kostenstelle'] = $this->Kosten_model->get_kostenstelle();
     $page_data['page_heading'] = 'Kosten';
     
    if ($this->form_validation->run() == FALSE) {
   

    
      $page_data['kosten']              = array('name' => 'kosten', 'class' => 'form-control', 'id' => 'kosten', 'value' => set_value('kosten', ''), 'maxlength'   => '100', 'size' => '35');
  
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('kosten/new_kosten', $page_data);
      $this->load->view('common/footer');      
    } else {
      $save_data = array(
        'kostenstelle_id' => $this->input->post('kostenstelle_id'),
        'kosten' => $this->input->post('kosten'),
       
        );

      if ($this->Kosten_model->save_kosten($save_data)) {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_okay'));
        redirect ('kosten/apply/'); 
      } else {
        $this->session->set_flashdata('flash_message', $this->lang->line('save_success_fail'));
        redirect ('kosten'); 
      }
    }    
  } 
  
  
  
    //----------------------------------------------------------------------------
  
  
  
   public function view_kosten() {

  $data['query'] = $this->Rechnung_model->get_gesamtkosten();
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('rechnung/view_kosten', $data);
  $this->load->view('common/footer', $data);
} 
       
       
   
}
/* End of file rechnung.php */
/* Location: ./application/controllers/rechnung.php */
  
  
