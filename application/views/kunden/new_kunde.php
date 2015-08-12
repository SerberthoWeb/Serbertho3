

<!--/*
 * Zeigt ein Formulat für den Admin um einen User zu erstellen.
 * Dem neuen User wird eine Email gesendet welchen ihn Willkommen heisst und
 * informiert ihn über sein Password. EMail-Script ist unter /views/email_scripts/welcome.txt
 */-->

<?php echo validation_errors() ; ?>
<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('kunde_form_instruction_edit');?></p>
  <div class="span8"> 
<?php echo form_open('kunden/new_kunde','role="form" class="form"') ; ?>
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
      <label for="strasse"><?php echo $this->lang->line('strasse');?></label>
      <?php echo form_input($strasse); ?>
    </div>   
    <div class="form-group">
      <label for="plz"><?php echo $this->lang->line('plz');?></label>
      <?php echo form_input($plz); ?>
    </div>   



    <div class="form-group">
      <label for="telnr"><?php echo $this->lang->line('telnr');?></label>
      <?php echo form_input($telnr); ?>
    </div>          
    <div class="form-group">
      <?php echo form_error('email'); ?>
      <label for="email"><?php echo $this->lang->line('email');?></label>
      <?php echo form_input($email); ?>
    </div>   


    <div class="form-group">
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>   <button class="btn btn-success" onClick="window.location.href = '<?php echo base_url();?>index.php/kunden';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
    </div> 
<?php echo form_close() ; ?>
  </div>
</div>




        