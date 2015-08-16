

<!--/*
 * Zeigt Formular für den Admin. Möchte der Admin einen User in der 
 * view_all_users-Sicht editieren. Gleich wie new_user, ausser dass der 
 * Admin eine Email dem User senden kann um sein Password zurückzusetzen.
 */-->


<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('kunde_form_instruction_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('kosten/edit_kosten','role="form" class="form"') ; ?>
	 
            
	    

	  

	    <div class="form-group">
	      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button> oder <?php echo anchor('kunden',$this->lang->line('common_form_elements_cancel'));?>
	    </div>
		<?php echo form_close() ; ?>
	</div>

</div>