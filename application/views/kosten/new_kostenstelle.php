<?php echo validation_errors() ; ?>
<div class="page-header">
 <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('kosten_form_instruction_save');?></p>
  <div class="span8"> 
<?php echo form_open('kosten/new_kostenstelle','role="form" class="form"') ; ?> 

      
  <div class="form-group">
      <?php echo form_error('kostenstelle_name'); ?>
      <label for="kostenstelle_name"><?php echo $this->lang->line('kostenstelle_name');?></label>
      <?php echo form_input($kostenstelle_name); ?>
    </div>    
      
          <div class="form-group">
      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>   <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten/kostenstelle';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
    </div> 
<?php echo form_close() ; ?>
  </div>
</div>


