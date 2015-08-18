 <h2><?php echo $page_heading ; ?></h2> 

<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kunden/new_kunde';return false;"><?php echo $this->lang->line('common_form_elements_new_kunde');?></button>         
 <button class="btn btn-primary"  onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/kunden';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>
    
     
     
     <?php echo form_open('kunden/index') ; ?>
      <br/>
      
        <div class="col-lg-12">
          <div class="input-group">
            <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kunden_view_search'); ?>">
            <span class="input-group-btn" style="float: left;"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                 <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
          </div><!-- /input-group --><br/>
        </div>
      
          <?php echo form_close() ; ?>
      
<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->

<table class="table table-bordered">
    <thead>
        <tr>
          <th>#</th>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>Strasse</th>
          <th>PLZ</th>
          <th>Ort</th>
          <th>Telefonnummer</th>
          <th>Email</th>
          <th>Reise</th>
	      <td>Aktionen</td>                     
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
		          <td><?php echo $row->kunde_id ; ?></td>
		          <td><?php echo $row->fname ; ?></td>
		          <td><?php echo $row->lname ; ?></td>
                          <td><?php echo $row->strasse ; ?></td>
                          <td><?php echo $row->plz ; ?></td>
                          <td><?php echo $row->ort ; ?></td>
                          <td><?php echo $row->telnr ; ?></td>
		          <td><?php echo $row->email ; ?></td>
                          <td><?php echo $row->tour_title ; ?></td>
		          <td><?php echo anchor('kunden/edit_kunde/'.
		            $row->kunde_id,$this->lang->line('common_form_elements_action_edit')) . 
		            ' ' . anchor('kunden/delete_kunde/'.
		            $row->kunde_id,$this->lang->line('common_form_elements_action_delete')) ; ?>		           

		      	  </td>
		        </tr>	        
		    <?php endforeach ; ?>
		<?php else : ?>
	        <tr>
	          <td colspan="5" class="info">Keine Kunden hier!</td>
	        </tr>			
		<?php endif; ?>
                    <div class="form-group">
      
 
   
                    </div>
	</tbody>
</table>
