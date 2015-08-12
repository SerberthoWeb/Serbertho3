

<!--/*
 * Zeigt ein Formulat für den Admin um einen User zu erstellen.
 * Dem neuen User wird eine Email gesendet welchen ihn Willkommen heisst und
 * informiert ihn über sein Password. EMail-Script ist unter /views/email_scripts/welcome.txt
 */-->

<?php echo validation_errors() ; ?>
<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('reise_form_instruction_edit');?></p>
  <div class="span8"> 
<?php echo form_open('reisen/new_reise','role="form" class="form"') ; ?>
    <div class="form-group">
      <?php echo form_error('reiseort'); ?>
      <label for="reiseort"><?php echo $this->lang->line('reiseort');?></label>
      <?php echo form_input($reiseort); ?>
    </div>
    <div class="form-group">
      <?php echo form_error('kzbeschreib'); ?>
      <label for="kzbeschreib"><?php echo $this->lang->line('kzbeschreib');?></label>
      <?php echo form_textarea($kzbeschreib); ?>
    </div>     
    <div class="form-group">
      <?php echo form_error('preis'); ?>
      <label for="preis"><?php echo $this->lang->line('preis');?></label>
      <?php echo form_input($preis); ?>
    </div> 


    <div class="form-group">
        <br/>
      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>    <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/reisen';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
    </div>
<?php echo form_close() ; ?>
  </div>





        