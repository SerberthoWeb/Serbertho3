

<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->


<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
          <th>Tourname</th>
          <th>Reiseort</th>
          <th>Reiseabfahrt</th>
          <th>Reiseankunft</th>
          <th>Preis</th>
	      <th>Aktion</th>                     
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->tour_title ; ?></td>
		          <td><?php echo $row->reiseort ; ?></td>
		          <td><?php echo $row->reiseabfahrt ; ?></td>
                          <td><?php echo $row->reiseankunft ; ?></td>
                          <td><?php echo $row->preis ; ?></td>
                          <td>&nbsp;&nbsp;&nbsp;<?php echo anchor('tour/edit_tour/'.
		            $row->tour_id, '<span class="glyphicon glyphicon-pencil"></span>', $this->lang->line('common_form_elements_action_edit')); ?> </button>
		           &nbsp;&nbsp;&nbsp;
                           <?php echo anchor('tour/delete_tour/'.
		            $row->tour_id, '<span class="glyphicon glyphicon-remove"></span>', $this->lang->line('common_form_elements_action_delete')); ?> </button> 
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
