

<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->


<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
<!--          <th>#</th>-->
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Email</th>
	      <td>Aktionen</td>                    
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
<!--		          <td><?php echo $row->usr_id ; ?></td>-->
		          <td><?php echo $row->usr_fname ; ?></td>
		          <td><?php echo $row->usr_lname ; ?></td>
		          <td><?php echo $row->usr_email ; ?></td>
		          <td><?php echo anchor('users/edit_user/'.
		            $row->usr_id,$this->lang->line('common_form_elements_action_edit')) . 
		            ' ' . anchor('users/delete_user/'.
		            $row->usr_id,$this->lang->line('common_form_elements_action_delete')) ; ?>
		      	  </td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine User hier!</td>
	        </tr>			
		<?php endif; ?>
                     <div class="form-group">
    
                <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users/new_user';return false;"><?php echo $this->lang->line('usr_new_user');?></button>     
                  <button class="btn btn-primary" style="float: right;" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/users';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button> 
 </div>
                     </tbody>

</table>

	