

<!--/*
 * Formular um einen Kunden zu editieren.
 */-->


<div class="page-header">
    <h1><?php echo $page_heading; ?></h1>
</div> 
<p class="lead"><?php echo $this->lang->line('kunde_form_instruction_new'); ?></p>

<div class="span8"> 
    <?php echo form_open('kunden/edit_kunde', 'role="form" class="form"'); ?>
    <div class="form-group">
        <?php echo form_error('fname'); ?>
        <label for="fname"><?php echo $this->lang->line('fname'); ?></label>
        <?php echo form_input($fname); ?>
    </div>
    <div class="form-group">
        <?php echo form_error('lname'); ?>
        <label for="lname"><?php echo $this->lang->line('lname'); ?></label>
        <?php echo form_input($lname); ?>
    </div>        
    <div class="form-group">
        <?php echo form_error('strasse'); ?>
        <label for="strasse"><?php echo $this->lang->line('strasse'); ?></label>
        <?php echo form_input($strasse); ?>
    </div>  
    <div class="form-group">
        <?php echo form_error('plz'); ?>
        <label for="plz"><?php echo $this->lang->line('plz'); ?></label>
        <?php echo form_input($plz); ?>
    </div>
    <div class="form-group">
        <?php echo form_error('ort'); ?>
        <label for="ort"><?php echo $this->lang->line('ort'); ?></label>
        <?php echo form_input($ort); ?>
    </div> 
    <div class="form-group">
        <?php echo form_error('telnr'); ?>
        <label for="telnr"><?php echo $this->lang->line('telnr'); ?></label>
        <?php echo form_input($telnr); ?>
    </div> 
    <div class="form-group">
        <?php echo form_error('email'); ?>	    	
        <label for="email"><?php echo $this->lang->line('email'); ?></label>
        <?php echo form_input($email); ?>
    </div>   


    <div class="form-group">
        <?php echo form_error('tour_id'); ?>
        <label for="tour_id"><?php echo $this->lang->line('reise'); ?></label>
        <select name="tour_id" class="form-control">
            <?php foreach ($tour->result() as $row) : ?>
              <option value="<?php echo $row->tour_id ; ?>"<?php if( $tour_id['value']==$row->tour_id){ echo 'selected'; } ?>><?php echo $row->tour_title ; ?></option>
            <?php endforeach; ?>
        </select>
    </div>    


    <?php echo form_hidden($id); ?>

    <div class="form-group">
        <br/>
        <button type="submit" class="btn btn-primary" ><?php echo $this->lang->line('common_form_elements_go'); ?></button>  <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/kunden';
                return false;"><?php echo $this->lang->line('common_form_elements_cancel'); ?></button> 
    </div>
<?php echo form_close(); ?>
</div>

