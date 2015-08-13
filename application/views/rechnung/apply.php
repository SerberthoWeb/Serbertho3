<h2><?php echo $page_heading ; ?></h2>     

 <?php if ($this->session->flashdata('flash_message')) : ?>
    <div class="alert alert-info" role="alert"><?php echo $this->session->flashdata('flash_message');?></div>
   <?php endif ; ?>
   

<div class="row">
    <div class="col-sm-12 blog-main">
      <div class="blog-post">



                      

     
        	<?php if ($query->num_rows() > 0) : ?>
          <?php $row = $query->result()[0];?>
          <h2 class="blog-post-title"><?php echo $row->tour_title ; ?></h2>
        
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
              <td>Natelnummer
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
            <tr>
           
              <td>Gesamtkosten
              </td>
              <td>
              </td>   
              </tr>
          </table>
      
        <?php// endforeach ; ?>
          <?php endif; ?>
      </div>
    </div>
    
    
  </div>
    


<table class="table table-bordered">
    <thead>
        <tr>
<!--          <th>#</th>-->
          <th>Kostenstelle</th>
          <th>Reise</th>
          <th>Kosten</th>
           <th>Datum</th>

	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
    <?php //echo $row->kosten_id ; ?></td>
		          <td><?php echo $row->kostenstelle_name ; ?></td>
		          <td><?php echo $row->tour_title ; ?></td>
                          <td><?php echo $row->kosten ; ?></td>
                          <td><?php echo $row->datum ; ?></td>

		        </tr>	        
                        <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Kosten erfasst!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">      
                    </div>
	</tbody>
</table>
    
    
    
    
    <table class="table table-bordered">
    <thead>
        <tr>
<!--          <th>#</th>-->
       <th>#</th>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Strasse</th>
          <th>PLZ</th>
          <th>Ort</th>
          <th>Telefonnummer</th>
          <th>Email</th>
          <th>Reise</th>

	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
    <?php //echo $row->kosten_id ; ?></td>
		          <td><?php echo $row->kunde_id ; ?></td>
		          <td><?php echo $row->fname ; ?></td>
		          <td><?php echo $row->lname ; ?></td>
                          <td><?php echo $row->strasse ; ?></td>
                          <td><?php echo $row->plz ; ?></td>
                          <td><?php echo $row->ort ; ?></td>
                          <td><?php echo $row->telnr ; ?></td>
		          <td><?php echo $row->email ; ?></td>
                          <td><?php echo $row->tour_title ; ?></td>

		        </tr>	        
                        <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Kosten erfasst!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">      
                    </div>
	</tbody>
</table>
