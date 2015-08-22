

<!--/*
 * Bereitet die Daten für die PDF-Ausgabe vor.
 */-->
<style type="text/css">
    
    thead{
        background-color: #666666;
        text-font: solid;
    }
    
    tbody{
        background-color: #cccccc;
    }
  
    
    .page{
        margin: 1.5em 1.5em 1.5em 2em;
        
    }
    .head{
        text-align: center;
        background-color: black;
        color: white;
        padding: 20px;        
    }
    
    .body{
        
    }
    .table-pdf{
        border: 1px grey ridge;
        width: 100%;
        
        
    }
    

</style>
<div class="page">
       <table width="100%">
        <tr>
            <td align="left"><?php echo date('g:i:s');?></td>
            <td align="center">Serbertho Reisen. Alle Rechte vorbehalten. &copy; Copyright <?=date('Y')?></td>
            <td align="right"><?php echo date('j.n.Y');?></td>
        </tr>
    </table>
<div class="head">
    <?php echo $page_heading ; ?>
</div>
<h2></h2>

<div class="body">
<table class="table-pdf">
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

</div>

