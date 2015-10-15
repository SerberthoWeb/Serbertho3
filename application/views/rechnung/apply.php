
<!--/*
 * Detailansicht einer Reise mit den Attributen:
*Reisedetails
*Rechnungsübersicht
*Reiseteilnehmerübersicht
 */-->


 <?php if ($this->session->flashdata('flash_message')) : ?>
    <div class="alert alert-info" role="alert"><?php echo $this->session->flashdata('flash_message');?></div>
   <?php endif ; ?>
   

    
    <!--Detailsicht-->
    
    
<div class="row">
    <div class="col-sm-12 blog-main">
      <div class="blog-post">
        	<?php if ($query->num_rows() > 0) : ?>
          <?php $row = $query->result()[0];?>
          <h3><b><?php echo $row->tour_title ; ?></b></h3>
        
          <table class="table">
            <tr>
              <td>Abfahrtsdatum
              </td>
              <td><?php echo $row->reiseabfahrt ; ?>
              </td>
              <td>Reiseleiter
              </td>
              <td><?php echo $row->usr_lname . ' ' . $row->usr_fname ; ?>
              </td>                            
            </tr>
            <tr>
               <td>Rückreiseankunft
              </td>
              <td><?php echo $row->reiseankunft ; ?>
              </td> 
              <td>Mobiltelefon
              </td>
              <td><?php echo $row->usr_phone ; ?>
              </td>               
            </tr>
            <tr>
               <td>Reiseort
              </td>
              <td><?php echo $row->reiseort ; ?>
              </td>
              <td>Email
              </td>
              <td><?php echo $row->usr_email ; ?>
              </td>           
            </tr>
          </table>
          <?php endif; ?>
      </div>
    </div>
  </div>
    
 
                
        <!--Kostenübersicht-->        
                
        <br/>
<h3>Kostenübersicht</h3>
<table class="table table-bordered">
     <thead class="thead-inverse">
        <tr class="info">
          <th>Kostenstelle</th>
           <th>Erfassungsdatum</th>
           <th>Rechnungsnummer</th>
          <th>Kosten</th>        
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
                              <?php //echo $row->kosten_id ; ?></td>
		          <td><?php echo $row->kostenstelle_name ; ?></td>
                          <td><?php echo $row->datum ; ?></td>
                          <td><?php echo $row->r_nummer ; ?></td>
                          <td><?php echo $row->kosten ; ?></td>
               	        </tr> 
                        <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="12" class="info">Keine Kosten erfasst!</td>
	        </tr>			
		<?php endif; ?>
	</tbody>
</table>
    
   
<!--Gesamtkosten/Gesamteinnahmen und Differenz-->
        <br/>
<h3>Gewinn-/Verlustrechnung</h3>
<table class="table table-bordered">
    <tbody>
        <?php if ($querykosten->num_rows() > 0) : ?>
            <?php foreach ($querykosten->result() as $row) : ?>
                <tr> 
                    <td colspan="8">Gesamtkosten</td>
                    <td colspan="4"><?php echo $row->TotalKosten; ?></td>   
                </tr>
            <?php endforeach; ?>
        <?php else : ?>		
        <?php endif; ?>

        <?php if ($queryeinnahmen->num_rows() > 0) : ?>
            <?php $row = $queryeinnahmen->result()[0]; ?>
            <tr>
                <td colspan="8">Gesamteinnahmen</td>
                <td colspan="4"><?php echo $row->TotalEinnahmen; ?></td>  
            </tr>          
        <?php endif; ?>
        <tr>
            <td colspan="8">Differenz</td>
            <td colspan="4"><?php echo($row->TotalEinnahmen - $row->TotalKosten); ?></td>  
        </tr>         

    </tbody>
</table>


    
     


<!-- Reiseteilnehmerübersicht -->

    <br/>
    <h3>Reiseteilnehmerübersicht</h3> 
    <table class="table table-bordered">
    <thead>
        <tr class="info">
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Strasse</th>
          <th>PLZ</th>
          <th>Ort</th>
          <th>Telefonnummer</th>
          <th>Email</th>           
        </tr>
    </thead>	
    <tbody>
    	<?php if ($querykunden->num_rows() > 0) : ?>
			<?php foreach ($querykunden->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->fname ; ?></td>
		          <td><?php echo $row->lname ; ?></td>
                          <td><?php echo $row->strasse ; ?></td>
                          <td><?php echo $row->plz ; ?></td>
                          <td><?php echo $row->ort ; ?></td>
                          <td><?php echo $row->telnr ; ?></td>
		          <td><?php echo $row->email ; ?></td>
		        </tr>	        
                        <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="12" class="info">Keine Kunden erfasst!</td>
	        </tr>			
		<?php endif; ?>
	</tbody>
        <br/>
</table>
 
    <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/users';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button> 
