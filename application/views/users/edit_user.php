

<!--/*
 * Zeigt Formular für den Admin. Möchte der Admin einen User in der 
 * view_all_users-Sicht editieren. Gleich wie new_user, ausser dass der 
 * Admin eine Email dem User senden kann um sein Password zurückzusetzen.
 */-->


<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('usr_form_instruction_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('users/edit_user','role="form" class="form"') ; ?>
	    <div class="form-group">
	      <?php echo form_error('usr_fname'); ?>
	      <label for="usr_fname"><?php echo $this->lang->line('usr_fname');?></label>
	      <?php echo form_input($usr_fname); ?>
	    </div>
	    <div class="form-group">
	      <?php echo form_error('usr_lname'); ?>
	      <label for="usr_lname"><?php echo $this->lang->line('usr_lname');?></label>
	      <?php echo form_input($usr_lname); ?>
	    </div>  
	    <div class="form-group">
	      <?php echo form_error('usr_uname'); ?>
	      <label for="usr_uname"><?php echo $this->lang->line('usr_uname');?></label>
	      <?php echo form_input($usr_uname); ?>
	    </div>   
	    <div class="form-group">
	      <?php echo form_error('usr_email'); ?>	    	
	      <label for="usr_email"><?php echo $this->lang->line('usr_email');?></label>
	      <?php echo form_input($usr_email); ?>
	    </div>   
	    <div class="form-group">
	    	<?php echo form_error('usr_confirm_email'); ?>	
	      <label for="usr_confirm_email"><?php echo $this->lang->line('usr_confirm_email');?></label>
	      <?php echo form_input($usr_confirm_email); ?>
	    </div>   
	    <div class="form-group">
	    	<?php echo form_error('usr_add1'); ?>
	      <label for="usr_add1"><?php echo $this->lang->line('usr_add1');?></label>
	      <?php echo form_input($usr_add1); ?>
	    </div>  
                <div class="form-group">
	    	<?php echo form_error('usr_plz'); ?>
	      <label for="usr_plz"><?php echo $this->lang->line('usr_plz');?></label>
	      <?php echo form_input($usr_plz); ?>
	    </div>   
	    <div class="form-group">
	    	<?php echo form_error('usr_town_city'); ?>
	      <label for="usr_town_city"><?php echo $this->lang->line('usr_town_city');?></label>
	      <?php echo form_input($usr_town_city); ?>
	    </div>         
	     	    <div class="form-group">
	    	<?php echo form_error('usr_phone'); ?>
	      <label for="usr_phone"><?php echo $this->lang->line('usr_phone');?></label>
	      <?php echo form_input($usr_phone); ?>
	    </div>       
	    <div class="form-group">
	    	<?php echo form_error('usr_access_level'); ?>
	      <label id="usr_access_level" for="usr_access_level"><?php echo $this->lang->line('usr_access_level');?></label>
	      <?php echo form_dropdown('usr_access_level', $usr_access_level_options, $usr_access_level); ?> 1 = Admin, 2 = User
	    </div>  
                <div class="form-group">	    	
                <?php echo form_error('usr_is_active'); ?>
	      <label id="usr_is_active" for="usr_is_active"><?php echo $this->lang->line('usr_is_active');?></label>
	      <?php echo form_dropdown('usr_is_active', $usr_is_active_options, $usr_is_active); ?> 1 = Aktiv, 2 = Inaktiv
	    </div>  


	    <?php echo form_hidden($id); ?>

	    <div class="form-group">
                <br/>
	      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>  <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
	    </div>
		<?php echo form_close() ; ?>
	</div>
     
