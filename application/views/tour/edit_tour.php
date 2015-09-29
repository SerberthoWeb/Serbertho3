

<!--/*
 * Zeigt Formular um die ausgewählte Tour zu editieren.
 */-->

<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
	<p class="lead"><?php echo $this->lang->line('tour_edit');?></p>

	<div class="span8"> 
		<?php echo form_open('tour/edit_tour','role="form" class="form"') ; ?>
            
	    <div class="form-group">
	      <?php echo form_error('tour_title'); ?>
	      <label for="tour_title"><?php echo $this->lang->line('tour_title');?></label>
	      <?php echo form_input($tour_title); ?>
	    </div>
            
                <div class="form-group">
      <?php echo form_error('reiseort_id'); ?>
      <label for="reiseort_id"><?php echo $this->lang->line('reiseort');?></label>
      <select name="reiseort_id" class="form-control" >
      <?php foreach ($reiseort->result() as $row) : ?>
        <option value="<?php echo $row->reiseort_id ; ?>"<?php if( $reiseort_id['value']==$row->reiseort_id){ echo 'selected'; } ?>><?php echo $row->reiseort ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>   

            
	    <div class="form-group">
	      <?php echo form_error('reiseabfahrt'); ?>
	      <label for="reiseabfahrt"><?php echo $this->lang->line('reiseabfahrt');?></label>
	      <?php echo form_input($reiseabfahrt); ?>
	    </div>  
            
	    <div class="form-group">
	      <?php echo form_error('reiseankunft'); ?>
	      <label for="reiseankunft"><?php echo $this->lang->line('reiseankunft');?></label>
	      <?php echo form_input($reiseankunft); ?>
	    </div>   
            
    <div class="form-group">
      <?php echo form_error('usr_id'); ?>
      <label for="usr_id"><?php echo $this->lang->line('usr_id');?></label>
      <select name="user_id" class="form-control">
      
      <?php foreach ($users->result() as $row) : ?>
            <option value="<?php echo $row->usr_id ; ?>" <?php if( $usr_id['value']==$row->usr_id){ echo 'selected'; } ?>><?php echo $row->usr_lname . " " .$row->usr_fname ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>   
            
             <div class="form-group">
	      <?php echo form_error('preis'); ?>
	      <label for="preis"><?php echo $this->lang->line('preis');?></label>
	      <?php echo form_input($preis); ?>
	    </div>   
            


	    <?php echo form_hidden($id); ?>

	    <div class="form-group">
                <br/>
	      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>  
              <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/tour';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
	    </div>
		<?php echo form_close() ; ?>
	</div>
     
