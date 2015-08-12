<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
        <th>#</th>
          <th>Kostenstelle</th>
          <th>Aktionen</th>
	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
<td><?php echo $row->kostenstelle_id ; ?></td>
		          <td><?php echo $row->kostenstelle_name ; ?></td>
                           <td><?php echo anchor('kostenstelle/delete_kostenstelle/'.
		            $row->kostenstelle_id,$this->lang->line('common_form_elements_action_delete')); ?>
		      	  </td>

		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Kosten erfasst!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">
      
 
    
       <button class="btn btn-success" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/new_kostenstelle';return false;"><?php echo $this->lang->line('common_form_elements_kostenstelle');?></button>               
                   
                    
                    </div>
	</tbody>
</table>
