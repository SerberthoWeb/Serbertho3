

<!--/*
 * Bereitet die Daten für die PDF-Ausgabe vor.
 */-->

<h2><?php echo $page_heading ; ?></h2>
<div class="table">
<table class="table">
    <thead>
        <tr>
          <th>#</th>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Email</th>
	                      
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->usr_id ; ?></td>
		          <td><?php echo $row->usr_fname ; ?></td>
		          <td><?php echo $row->usr_lname ; ?></td>
		          <td><?php echo $row->usr_email ; ?></td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
			
		<?php endif; ?>
	</tbody>
</table>
</div>
