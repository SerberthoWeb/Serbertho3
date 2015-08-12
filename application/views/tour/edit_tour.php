

<!--/*
 * Zeigt Formular für den Admin. Möchte der Admin einen User in der 
 * view_all_users-Sicht editieren. Gleich wie new_user, ausser dass der 
 * Admin eine Email dem User senden kann um sein Password zurückzusetzen.
 */-->


<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('tour_form_instruction_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('tour/edit_tour','role="form" class="form"') ; ?>
	    <div class="form-group">
      <?php echo form_error('reiseort'); ?>
      <label for="reiseort"><?php echo $this->lang->line('reiseort');?></label>
      <?php echo form_input($reiseort); ?>
    </div>
    <div class="form-group">
      <?php echo form_error('reiseabfahrt'); ?>
      <label for="reiseabfahrt"><?php echo $this->lang->line('reiseabfahrt');?></label>
      <?php echo form_input($reiseabfahrt); ?>
    </div>     
    <div class="form-group">
      <label for="reiseankunft"><?php echo $this->lang->line('reiseankunft');?></label>
      <?php echo form_input($reiseankunft); ?>
    </div>   
   

 

	  

	    <div class="form-group">
	      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button> oder <?php echo anchor('kunden',$this->lang->line('common_form_elements_cancel'));?>
	    </div>
		<?php echo form_close() ; ?>
	</div>

</div>