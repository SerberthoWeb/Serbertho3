Pagination funktionsfähig

<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
          <th>Tourname</th>
          <th>Reiseort</th>
          <th>Reiseabfahrt</th>
     
	      <th>Aktion</th>                     
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->usr_id ; ?></td>
		          <td><?php echo $row->usr_fname ; ?></td>
		          <td><?php echo $row->usr_lname ; ?></td>
                     
                          <td>&nbsp;&nbsp;&nbsp;<?php echo anchor('tour/edit_tour/'.
		            $row->usr_id, '<span class="glyphicon glyphicon-pencil"></span>', $this->lang->line('common_form_elements_action_edit')); ?> </button>
		           &nbsp;&nbsp;&nbsp;
                           <?php echo anchor('tour/delete_tour/'.
		            $row->usr_id, '<span class="glyphicon glyphicon-remove"></span>', $this->lang->line('common_form_elements_action_delete')); ?> </button> 
		      	  </td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Kunden hier!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">
      
 
     <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/tour/new_tour';return false;"><?php echo $this->lang->line('common_form_elements_new_tour');?></button>         
           
             <button class="btn btn-primary" style="float: right;" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/tour';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>
                    </div>
	</tbody>
</table>


<div class="dropdown-menue">
<li>
    <a href="<?php echo base_url(); ?>index.php/users/index/2"  class="pPage" data-tableid="smpl_tbl">
    2 records per page
    </a>
</li>
<li>
    <a href="<?php echo base_url(); ?>index.php/users/index/10"  class="pPage" data-tableid="smpl_tbl">
    10 records per page
    </a>
</li>
<li><a href="<?php echo base_url(); ?>index.php/users/index/25"  class="pPage" data-tableid="smpl_tbl">
    25 records per page
    </a>
</li>
<li>
    <a href="<?php echo base_url(); ?>index.php/users/index/9999" id="all" class="pPage" data-tableid="smpl_tbl">
    Alle Einträge
    </a>
</li>
</div>

<?php echo $this->pagination->create_links(); ?>



Controller:
public function index() {	

$this->load->model('Users_model');
$this->db->order_by('usr_id');
//$recordsPerPage = 5;
//$limit = $recordsPerPage;
if ($this->uri->segment(3) !="") {
$limit = $this->uri->segment(3);
} else {
$limit = 5;
}


$offset = 4;

$offset = $this->uri->segment(4);
$this->db->limit($limit, $offset);

$data['query'] = $this->Users_model->usersdata();

$totalresults = $this->db->get('users')->num_rows();

//initializing & configuring paging
$this->load->library('pagination');
//$config['base_url'] = site_url('/backOfficeUsers/displayAllUsers');
$config['base_url'] = site_url('/users/index/'.$limit.'/');
$config['total_rows'] = $totalresults;
$config['per_page'] = $limit;
$config['uri_segment'] = 4;
$config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
$config['full_tag_close'] = '</ul></div>';
$config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$this->pagination->initialize($config);




$data['title'] = 'Back Office Users';
$errorMessage = FALSE;


$this->load->vars($data,$errorMessage);




   
  $data['page_heading'] = 'Userübersicht';
  $this->load->view('common/header', $data);
  $this->load->view('nav/top_nav', $data);
  $this->load->view('users/view_all_users', $data);
  $this->load->view('common/footer', $data);
}



Model:

  function usersdata() {
      
  return $this->db->get('users');  }

  
      



