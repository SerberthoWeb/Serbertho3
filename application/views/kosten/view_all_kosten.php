<h2><?php echo $page_heading ; ?></h2>
<br/>    
 <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/new_kosten';return false;"><?php echo $this->lang->line('common_form_elements_new_kosten');?></button>         
             <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/kostenstelle';return false;"><?php echo $this->lang->line('common_form_elements_kostenstelle');?></button>          
            <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/kosten';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>


            

            <div>
    <?php echo form_open('kosten/index') ; ?><br/>
      <div class="row" style="float: left; position: relative; left: 0px;">
        <div class="col-lg-12">
          <div class="input-group">
              <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_ks'); ?>">
            <span class="input-group-btn" style="float: left;">
                 <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    <?php echo form_close() ; ?>
  

   <?php echo form_open('rechnung/past') ; ?>
      <div class="row" style="float: left; position: relative; left: 25px;">
        <div class="col-lg-12">
          <div class="input-group">
              <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_reisename'); ?>">
            <span class="input-group-btn" style="float: left;">
                 <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    <?php echo form_close() ; ?>
  
  
    <?php echo form_open('kosten/rn') ; ?>
      <div class="row" style="float: left; position: relative; left: 50px;">
        <div class="col-lg-12">
          <div class="input-group">
              <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_rn'); ?>">
            <span class="input-group-btn" style="float: left;">
                 <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    <?php echo form_close() ; ?>
  

      
        

  
 
</div><br/><br/>
<!--/*
 * Listet alle User die im System sind und erlaubt dem Admin User zu
 * editieren und zu löschen.
 */-->



<table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr class="info">
<!--          <th>#</th>-->
          <th>Kostenstelle</th>
          <th>Reisename</th>
          <th>Kosten</th>
          <th>Rechnungsnummer</th>
           <th>Erfassungsdatum</th>
                    <th>Aktion</th>    
	              
        </tr>
    </thead>	
    <tbody>
    	<?php if ($query->num_rows() > 0) : ?>
			<?php foreach ($query->result() as $row) : ?>
		        <tr >
<!--		          <td><?php echo $row->kosten_id ; ?></td>-->
		          <td><?php echo $row->kostenstelle_name ; ?></td>
		          <td><?php echo $row->tour_title ; ?></td>
                          <td><?php echo $row->kosten ; ?></td>
                          <td><?php echo $row->r_nummer ; ?></td>
                          <td><?php echo $row->datum ; ?></td>
                          <td>&nbsp;&nbsp;&nbsp;<?php echo anchor('kosten/edit_kosten/'.
		            $row->kosten_id, '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit')); ?> </button>
		           &nbsp;&nbsp;&nbsp;
                           <?php echo anchor('kosten/delete_kosten/'.
		            $row->kosten_id, '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete')); ?> </button> 
                          </td>
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
</div>