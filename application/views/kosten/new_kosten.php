

<!--/*
 * Zeigt ein Formulat für den Admin um einen User zu erstellen.
 * Dem neuen User wird eine Email gesendet welchen ihn Willkommen heisst und
 * informiert ihn über sein Password. EMail-Script ist unter /views/email_scripts/welcome.txt
 */-->

<?php echo validation_errors() ; ?>
<div class="page-header">
 <h1><?php echo $page_heading ; ?></h1>
</div> 
  <p class="lead"><?php echo $this->lang->line('kosten_form_instruction_save');?></p>
  <div class="span8"> 
<?php echo form_open('kosten/new_kosten','role="form" class="form"') ; ?> 

      
          <div class="form-group">
      <?php echo form_error('kostenstelle_id'); ?>
      <label for="kostenstelle_id"><?php echo $this->lang->line('type');?></label>
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
      <label for="tour_id"><?php echo $this->lang->line('type');?></label>
      <select name="tour_id" class="form-control">
      <?php foreach ($tour->result() as $row) : ?>
        <option value="<?php echo $row->tour_id ; ?>"><?php echo $row->tour_title ; ?></option>
      <?php endforeach ; ?>
      </select>
    </div>    
      
       <label for="start_d"><?php echo $this->lang->line('datum');?></label>
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

    <div class="form-group">
      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>   <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/kosten';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
    </div> 
<?php echo form_close() ; ?>
  </div>
</div>




        