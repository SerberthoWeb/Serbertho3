

<!--/*
 * Zeigt ein Formulat für den Admin um einen User zu erstellen.
 * Dem neuen User wird eine Email gesendet welchen ihn Willkommen heisst und
 * informiert ihn über sein Password. EMail-Script ist unter /views/email_scripts/welcome.txt
 */-->

<?php echo validation_errors() ; ?>
<div class="page-header">
  <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('tour_form_instruction_edit');?></p>
  <div class="span8"> 
<?php echo form_open('tour/new_tour','role="form" class="form"') ; ?>
      
      
      
     <div class="form-group">
      <?php echo form_error('tour_title'); ?>
      <label for="tour_title"><?php echo $this->lang->line('tour_title');?></label>
      <?php echo form_input($tour_title); ?>
    </div>
      
      
      
    <div class="form-group">
      <?php echo form_error('reiseort_id'); ?>
      <label for="reiseort_id"><?php echo $this->lang->line('reiseort');?></label>
      <select name="reiseort_id" class="form-control">
      <?php foreach ($reiseort->result() as $row) : ?>
        <option value="<?php echo $row->reiseort_id ; ?>"><?php echo $row->reiseort ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>
          
  
    
   <!-- Abfahrt -->   
      
  <label for="start_d"><?php echo $this->lang->line('reiseankunft');?></label>
    <div class="row">
      <div class="form-group">
        <div class="col-md-2">
          <?php echo form_error('start_d'); ?>        
          <select name="start_d" class="form-control">
          <?php for ( $i = 1; $i <= 30; $i++) : ?>
            <?php if (date('j', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>
          <div class="col-md-2">      
          <?php echo form_error('start_m'); ?>
          <select name="start_m" class="form-control">
          <?php for ( $i = 1; $i <= 12; $i++) : ?>
            <?php if (date('m', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>
        <div class="col-md-2">
          <?php echo form_error('start_y'); ?>
          <select name="start_y" class="form-control">
          <?php for ($i = date("Y",strtotime(date("Y"))); $i <= date("Y",strtotime(date("Y").' +3 year')); $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php endfor ; ?>
          </select>
        </div> 
      </div>  
    </div> 
   <br/>           
                
                
       <!-- Ankunft -->          
      
      
    <label for="sunset_d"><?php echo $this->lang->line('job_sunset_date');?></label>
    <div class="row">
      <div class="form-group">
        <div class="col-md-2">
          <?php echo form_error('sunset_d'); ?>        
          <select name="sunset_d" class="form-control">
          <?php for ( $i = 1; $i <= 30; $i++) : ?>
            <?php if (date('j', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('jS', mktime($i,0,0,0, $i, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>
        <div class="col-md-2">      
          <?php echo form_error('sunset_m'); ?>
          <select name="sunset_m" class="form-control">
          <?php for ( $i = 1; $i <= 12; $i++) : ?>
            <?php if (date('m', time()) == $i) : ?> 
              <option selected value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php else : ?>
              <option value="<?php echo $i ; ?>"><?php echo date('F', mktime(0,0,0,$i, 1, date('Y'))) ; ?></option>
            <?php endif ; ?>
          <?php endfor ; ?>
          </select>
        </div>
        <div class="col-md-2">
          <?php echo form_error('sunset_y'); ?>
          <select name="sunset_y" class="form-control">
          <?php for ($i = date("Y",strtotime(date("Y"))); $i <= date("Y",strtotime(date("Y").' +3 year')); $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
          <?php endfor ; ?>
          </select>
        </div> 
      </div>  
    </div>     
   <br/>   
      
   



   
 

   <div class="form-group">
      <?php echo form_error('usr_id'); ?>
      <label for="usr_id"><?php echo $this->lang->line('usr_id');?></label>
      <select name="usr_id" class="form-control">
      <?php foreach ($users->result() as $row) : ?>
        <option value="<?php echo $row->usr_id ; ?>"><?php echo $row->usr_lname . ' ' . $row->usr_fname ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>


    <div class="form-group">
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('common_form_elements_go');?></button>   <button class="btn btn-success" onClick="window.location.href = '<?php echo base_url();?>index.php/tour';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
    </div> 
<?php echo form_close() ; ?>
  </div>
</div>




        