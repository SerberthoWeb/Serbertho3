

<!--/*
 * Bereit die Daten auf um sie auf einem PDF anzeigen zu können.
 */-->

<table class="table table-bordered">
    <thead>
        <tr>
       
          <th>Kostenstelle</th>
          <th>Tour</th>
          <th>Kosten</th>
 
	                         
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          
                            
		          <td><?php echo $row->bezeichnung ; ?></td>
		          <td><?php echo $row->tour_id ; ?></td>
                          <td><?php echo $row->kosten ; ?></td>

		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
			
		<?php endif; ?>
	</tbody>
</table>
