

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        
<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('usr_form_instruction_edit');?></p>
  <div class="span8"> 
<?php echo form_open('users/new_user','role="form" class="form"') ; ?>
    <div class="form-group">
      <?php echo form_error('usr_fname'); ?>
      <label for="usr_fname"><?php echo $this->lang->line('usr_fname');?></label>
      <?php echo form_input($usr_fname); ?>
    </div>
    
<?php echo form_close() ; ?>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        