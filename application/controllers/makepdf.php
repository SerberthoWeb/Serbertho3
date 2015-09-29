<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Makepdf extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->helper('dompdf'); 
        $this->load->model('Makepdf_model');
    }

    //-------------------------------------------------------------------------
    
    
    function kunden() {
        $data['query'] = $this->Makepdf_model->get_all_kunden();
        $filename = 'Kundenliste';
        $html = $this->load->view('kunden/kunden', $data, true);
        pdf_create($html, $filename);
    }
    
    //-------------------------------------------------------------------------
    
        function users() {
        $data['query'] = $this->Makepdf_model->get_all_users();
        $filename = 'Userliste';
        
          $data['page_heading'] = 'Useruebersicht';
         $html = $this->load->view('common/header', $data, true);
         $html = $this->load->view('nav/top_nav', $data, true);
         $html = $this->load->view('common/footer', $data, true);
        $html = $this->load->view('users/users', $data, true);
        pdf_create($html, $filename);
    }
    
     //-------------------------------------------------------------------------
    
            function tour() {
        $data['query'] = $this->Makepdf_model->get_all_tour();
        $filename = 'Tourliste';
        $html = $this->load->view('tour/tour', $data, true);
        pdf_create($html, $filename);
    }
     //-------------------------------------------------------------------------
    
    
                function kosten() {
        $data['query'] = $this->Makepdf_model->get_all_kosten();
        $filename = 'Kostenliste';
        $html = $this->load->view('pdf/kosten_pdf', $data, true);
        pdf_create($html, $filename);
    }
    
    
    
    
    
     //-------------------------------------------------------------------------
    
    
    
    
    
    
    
    
    
     //-------------------------------------------------------------------------
    
    
}
