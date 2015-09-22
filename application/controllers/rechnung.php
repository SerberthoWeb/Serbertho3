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

      $page_data['page_heading'] = 'Reiseübersicht';
      $page_data['query'] = $this->Rechnung_model->get_rechnung($this->input->post('search_string'));
      
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('rechnung/view', $page_data);
      $this->load->view('common/footer');
      
    } else {
        
      $page_data['page_heading'] = 'Reiseübersicht';
      $this->load->view('common/header');
      $this->load->view('nav/top_nav');
      $this->load->view('rechnung/view', $page_data);
      $this->load->view('common/footer');      
    }    
  }

  
  //----------------------------------------------------------------------------
   
     public function apply() { 
         
         
    if ($this->input->post()) {
      $data['tour_id'] = $this->input->post('tour_id');
      
    } else {
      $data['tour_id'] = $this->uri->segment(3);
      
    }

    $data['query'] = $this->Rechnung_model->get_uebersicht_kosten($data['tour_id']);
    $data['querykunden'] = $this->Rechnung_model->get_uebersicht_kunden($data['tour_id']);
    $data['querykosten'] = $this->Rechnung_model->get_gesamtkosten($data['tour_id']);
    $data['queryeinnahmen'] = $this->Rechnung_model->get_einnahmen($data['tour_id']);

    if ($data['query']->num_rows() != 0) {
      foreach ($data['query']->result() as $row) {
        $data['tour_title'] = $row->tour_title;
        $data['tour_id'] = $row->tour_id;
     
      }
      
    } 
   
   $data['page_heading'] = 'Reiseübersicht';
    $this->load->view('common/header', $data);
    $this->load->view('nav/top_nav', $data);
    $this->load->view('rechnung/apply', $data); 
    $this->load->view('common/footer', $data);  
  }

  
  
  //----------------------------------------------------------------------------
  
  public function past() {
    $this->form_validation->set_rules('search_string', $this->lang->line('search_string'), 'required|min_length[1]|max_length[125]');
    $data['query'] = $this->Rechnung_model->get_past_rechnung($this->input->post('search_string'));

    if ($this->form_validation->run() == FALSE) {
      $data['search_string'] = array('name' => 'search_string', 'class' => 'form-control', 'id' => 'search_string', 'value' => set_value('search_string', $this->input->post('search_string')), 'maxlength'   => '100', 'size' => '35');

      $data['page_heading'] = 'Reiseübersicht vergangener Reisen';
      $data['query'] = $this->Rechnung_model->get_past_rechnung($this->input->post('search_string'));
      
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('rechnung/past', $data);
      $this->load->view('common/footer', $data);
      
    } else {
        
      $data['page_heading'] = 'Reiseübersicht vergangener Reisen';
      $this->load->view('common/header', $data);
      $this->load->view('nav/top_nav', $data);
      $this->load->view('rechnung/past', $data);
      $this->load->view('common/footer', $data);      
    }    
  }
  
  //----------------------------------------------------------------------------
   
}
/* End of file rechnung.php */
/* Location: ./application/controllers/rechnung.php */
  
  
