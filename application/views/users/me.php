
<!--/*
 *Zeigt dem zurzeit eingeloggten User. Ist gleich wie edit_user Formulat und
 * erlaubt dem eingeloggten User seine Accountdetails zu editieren.
 */-->


<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('usr_form_instruction');?></p>

	<div class="span8"> 
		<?php echo form_open('me/index','role="form"') ; ?>
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
	      <label for="usr_email"><?php echo $this->lang->line('usr_email');?></label>
	      <?php echo form_input($usr_email); ?>
	    </div>   
	    <div class="form-group">
	      <label for="usr_confirm_email"><?php echo $this->lang->line('usr_confirm_email');?></label>
	      <?php echo form_input($usr_confirm_email); ?>
	    </div>   

	    <div class="form-group">
	      <label for="usr_add1"><?php echo $this->lang->line('usr_add1');?></label>
	      <?php echo form_input($usr_add1); ?>
	    </div>  
            	    <div class="form-group">
	      <label for="usr_plz"><?php echo $this->lang->line('usr_plz');?></label>
	      <?php echo form_input($usr_plz); ?>
	    </div>        
	    <div class="form-group">
	      <label for="usr_town_city"><?php echo $this->lang->line('usr_town_city');?></label>
	      <?php echo form_input($usr_town_city); ?>
	    </div>         
            	    <div class="form-group">
	      <label for="usr_phone"><?php echo $this->lang->line('usr_phone');?></label>
	      <?php echo form_input($usr_phone); ?>
	    </div>     
	    <?php echo form_hidden($id); ?>

	    <div class="form-group">

	   
         <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users/new_user';return false;"><?php echo $this->lang->line('common_form_elements_go');?></button>     
         <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button>     
         <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/me/change_password';return false;"><?php echo $this->lang->line('common_form_elements_change_pw');?></button>     
            
            
            
            </div>
		<?php echo form_close() ; ?>
	</div>

  