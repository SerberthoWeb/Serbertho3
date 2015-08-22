

<!--/*
 * Zeigt Formular für den Admin. Möchte der Admin einen User in der 
 * view_all_users-Sicht editieren. Gleich wie new_user, ausser dass der 
 * Admin eine Email dem User senden kann um sein Password zurückzusetzen.
 */-->


<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('kosten_form_instruction_new');?></p>

	<div class="span8"> 
		<?php echo form_open('kosten/edit_kosten','role="form" class="form"') ; ?>
    <div class="form-group">
      <?php echo form_error('kostenstelle_id'); ?>
      <label for="kostenstelle_id"><?php echo $this->lang->line('kostenstelle_id');?></label>
      <select name="kostenstelle_id" class="form-control">
      <?php foreach ($kostenstelle->result() as $row) : ?>
        <option value="<?php echo $row->kostenstelle_id ; ?>"><?php echo $row->kostenstelle_name ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>    
	    <div class="form-group">
	      <?php echo form_error('kosten'); ?>
	      <label for="kosten"><?php echo $this->lang->line('kosten');?></label>
	      <?php echo form_input($kosten); ?>
	    </div>        
    <div class="form-group">
      <?php echo form_error('tour_id'); ?>
      <label for="tour_id"><?php echo $this->lang->line('tour_id');?></label>
      <select name="tour_id" class="form-control">
      <?php foreach ($tour->result() as $row) : ?>
        <option value="<?php echo $row->tour_id ; ?>"><?php echo $row->tour_title ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>    
	    <div class="form-group">
	    	<?php echo form_error('r_nummer'); ?>
	      <label for="r_nummer"><?php echo $this->lang->line('r_nummer');?></label>
	      <?php echo form_input($r_nummer); ?>
	    </div>

     
            

	    

	       <?php echo form_hidden($id); ?>

	    <div class="form-group">
                <br/>
	      <button type="submit" class="btn btn-primary" ><?php echo $this->lang->line('common_form_elements_go');?></button>  <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
	    </div>
		<?php echo form_close() ; ?>
	</div>

