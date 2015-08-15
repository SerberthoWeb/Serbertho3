<h2><?php echo $page_heading ; ?></h2>
<br/>    
 <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/new_kosten';return false;"><?php echo $this->lang->line('common_form_elements_new_kosten');?></button>         
             <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/kostenstelle';return false;"><?php echo $this->lang->line('common_form_elements_kostenstelle');?></button>          
            <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/kosten';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>


      
    <?php echo form_open('kosten/index') ; ?>
      <br/>
        <div class="col-lg-12">
          <div class="input-group">
            <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('jobs_view_search'); ?>">
            <span class="input-group-btn" style="float: left;">
              <button class="btn btn-default" type="submit"><?php echo $this->lang->line('jobs_view_search'); ?></button>
            </span>
          </div><!-- /input-group -->
        </div>

    <?php echo form_close() ; ?>
     


<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->



<table class="table table-bordered">
    <br/><br/>
    <thead>
        <tr>
<!--          <th>#</th>-->
          <th>Kostenstelle</th>
          <th>Reise</th>
          <th>Kosten</th>
           <th>Erfassungsdatum</th>

	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr>
<!--		          <td><?php echo $row->kosten_id ; ?></td>-->
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
