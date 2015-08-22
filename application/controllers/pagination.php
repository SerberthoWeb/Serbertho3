<?php

class Pagination extends CI_Controller {
    
    public function pagination_users()
    {
        $this->load->library('pagination');

        
        $config['base_url'] = 'http://localhost/Serbertho3/index.php/users';
         $config['total_rows'] = $this->db->get('users')->num_rows();
        $config['per_page'] = 3;
        $config['num_links'] = 5;
                
                
        $this->pagination->initialize($config);
        
        $data['query'] = $this->db->get('users', $config['per_page'], $this->uri->segment(3));
                
        return $data;
                
    }
    
}