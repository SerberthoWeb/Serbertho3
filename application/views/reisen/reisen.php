

<!--/*
 * Listet alle Kunden die im System gespeichert sind und erlaubt diese zu erfassen
*oder zu editieren
 */-->


<h2><?php echo $page_heading ; ?></h2>
<table class="table table-bordered">
    <thead>
        <tr>
          <th>#</th>
          <th>#</th>
          <th>Reiseort</th>
          <th>Kurzbeschreibung</th>
          <th>Preis</th>
	      <td>Aktionen</td>                    
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->reiseort_id ; ?></td>
		          <td><?php echo $row->ort; ?></td>
		          <td><?php echo $row->kzbeschreib ; ?></td>
                          <td><?php echo $row->preis ; ?></td>
		          <td><?php echo anchor('reiseort/edit_reise/'.
		            $row->reiseort_id,$this->lang->line('common_form_elements_action_edit')) . 
		            ' ' . anchor('reiseort/delete_reise/'.
		            $row->reiseort_id,$this->lang->line('common_form_elements_action_delete')) ; ?>
		      	  </td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Reisen hier!</td>
	        </tr>			
		<?php endif; ?>
	</tbody>
</table>
