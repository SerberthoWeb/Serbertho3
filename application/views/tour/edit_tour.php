

<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('tour_form_instruction_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('tour/edit_kosten','role="form" class="form"') ; ?>
	 
            
	    

	  

	    <div class="form-group">
	      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button> oder <?php echo anchor('kunden',$this->lang->line('common_form_elements_cancel'));?>
	    </div>
		<?php echo form_close() ; ?>
	</div>

</div>