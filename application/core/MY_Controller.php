<?php if ( ! defined('BASEPATH')) exit('No direct script access  allowed'); 

/*
 * MY_Controller agiert als ein übergreifender Elterncontroller für alle Controller
 * und erlaubt den Usern einzuloggen bevor sie Zugriff erhalten.
 */
 
  
class MY_Controller extends CI_Controller {
    
    
  function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('security');
    $this->load->helper('language');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
    
    
    //Laden des Sprachfiles
    $this->lang->load('de_admin', 'deutsch');
  }
  
  
  
  
}