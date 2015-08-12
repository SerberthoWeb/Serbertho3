

<!--/*
 * Bereit die Daten auf um sie auf einem PDF anzeigen zu können.
 */-->

<table class="table table-bordered">
    <thead>
        <tr>
          <th>#</th>
          <th>Reiseort</th>
          <th>Reiseabfahrt</th>
          <th>Reiseankunft</th>
     
          

	                         
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->tour_id ; ?></td>
		          <td><?php echo $row->reiseort ; ?></td>
		          <td><?php echo $row->reiseabfahrt ; ?></td>
                          <td><?php echo $row->reiseankunft ; ?></td>
                     
                     
		          
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
			
		<?php endif; ?>
	</tbody>
</table>
