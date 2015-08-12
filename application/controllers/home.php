<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 
 * Die Homeview in der Neuigkeiten zu sehen sind.
 * 
 */




class Home extends MY_Controller {
    
    
    //--------------------------------------------------------------------------

    
  function __construct() {
    parent::__construct();
   
   
    
  }
  
   //--------------------------------------------------------------------------
  
    public function index() {
       
        $this->load->view('common/header');
        $this->load->view('nav/top_nav');
        $this->load->view('home_view');
        $this->load->view('common/footer');
        
  }
  
  //--------------------------------------------------------------------------
  
}