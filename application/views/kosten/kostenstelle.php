<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
      
          <th>Kostenstelle</th>
          <th>Aktion</th>
	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->kostenstelle_name ; ?></td>
                          <td><?php echo anchor('kosten/delete_kostenstelle/'.
		            $row->kostenstelle_id, '<span class="glyphicon glyphicon-remove"></span>', $this->lang->line('common_form_elements_action_delete')); ?> </button> 
		      	  </td>
                        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="8" class="info">Keine Kostenstelle erfasst!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">
      
 
    
       <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/new_kostenstelle';return false;"><?php echo $this->lang->line('common_form_elements_kostenstelle');?></button>               
       <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button>              
                    
                    </div>
	</tbody>
</table>
