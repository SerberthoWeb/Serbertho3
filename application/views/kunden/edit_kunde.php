

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
		<?php echo form_open('kunden/edit_kunde','role="form" class="form"') ; ?>
	    <div class="form-group">
	      <?php echo form_error('fname'); ?>
	      <label for="fname"><?php echo $this->lang->line('fname');?></label>
	      <?php echo form_input($fname); ?>
	    </div>
	    <div class="form-group">
	      <?php echo form_error('lname'); ?>
	      <label for="lname"><?php echo $this->lang->line('lname');?></label>
	      <?php echo form_input($lname); ?>
	    </div>        
	    <div class="form-group">
	    	<?php echo form_error('strasse'); ?>
	      <label for="strasse"><?php echo $this->lang->line('strasse');?></label>
	      <?php echo form_input($strasse); ?>
	    </div>  
	    <div class="form-group">
	    	<?php echo form_error('plz'); ?>
	      <label for="plz"><?php echo $this->lang->line('plz');?></label>
	      <?php echo form_input($plz); ?>
	    </div>
	    <div class="form-group">
	    	<?php echo form_error('ort'); ?>
	      <label for="ort"><?php echo $this->lang->line('ort');?></label>
	      <?php echo form_input($ort); ?>
	    </div> 
	    <div class="form-group">
	    	<?php echo form_error('telnr'); ?>
	      <label for="telnr"><?php echo $this->lang->line('telnr');?></label>
	      <?php echo form_input($telnr); ?>
	    </div> 
	    <div class="form-group">
	      <?php echo form_error('email'); ?>	    	
	      <label for="email"><?php echo $this->lang->line('email');?></label>
	      <?php echo form_input($email); ?>
	    </div>   
	    

	  

	    <div class="form-group">
	      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button> oder <?php echo anchor('kunden',$this->lang->line('common_form_elements_cancel'));?>
	    </div>
		<?php echo form_close() ; ?>
	</div>

</div>