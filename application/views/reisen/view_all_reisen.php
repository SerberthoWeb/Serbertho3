

<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->


<h2><?php echo $page_heading ; ?></h2>
<table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr class="info">
          <th>Reiseort</th>
          <th>Kurzbeschreibung</th>
	  <th>Aktion</th>                     
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->reiseort; ?></td>
		          <td><?php echo $row->kzbeschreib ; ?></td>
                          <td style="float: right;"><?php echo anchor('reisen/edit_reise/'.
		                    $row->reiseort_id, '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit')); ?> </button>
                            
                              <?php echo anchor('reisen/delete_reise/'.
		                    $row->reiseort_id, '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete')); ?> </button> 
                           </td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="12" class="info">Keine Reisen vorhanden!</td>
	        </tr>			
		<?php endif; ?>
                
    <div class="form-group">
      <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/reisen/new_reise';return false;"><?php echo $this->lang->line('common_form_elements_new_reise');?></button>         
    </div>
    
	</tbody>
</table>
