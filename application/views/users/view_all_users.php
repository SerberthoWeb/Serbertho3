
    <h2><?php echo $page_heading ; ?></h2><br/>	
    <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url();?>index.php/users/new_user';return false;"><?php echo $this->lang->line('common_form_elements_new_user');?></button>         
    <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/tour';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>
       
    
           <!-- Anzeigen der Einträge -->
     
<div class="pagination" align="left">
    &lt;?php echo $pagination;?&gt;    
</div>
&lt;!-- this is the number of records part - an example only --&gt;
<div align="right"><a href="&lt;?=$pbase_url;?&gt;/10">10</a> | <a href="&lt;?=$pbase_url;?&gt;/20">20</a></div>
    
    <br/><br/><br/>
       Anzahl Einträge: <?php echo $total_rows ?> 
       <table class="table table-hover table-striped table-responsive table-bordered">      
         <?php 				  
		$page_num = (int)$this->uri->segment(3);
		if($page_num==0) $page_num=1;
		$order_seg = $this->uri->segment(5,"asc"); // if the 5th segment not present,it will return asc. default value.
		if($order_seg == "asc") $order = "desc"; else $order = "asc";
	?>                             
            <!-- // #main -->
            <div id="test" style="padding-top:5px;">  
            <div style="float:left; margin-left:550px;padding-top:5px;padding-bottom:13px;"></div>
                    <span class="largefont"><?php echo $this->session->flashdata('status_msg'); ?></span>
                    
                            <tr>
                                <td><b><a href="<?php echo base_url();?>index.php/users/index/<?=$page_num?>/usr_id/<?=$order?>">ID</a></b></td>
                                <td><b><a href="<?php echo base_url();?>index.php/users/index/<?=$page_num?>/usr_fname/<?=$order?>">Vorname</a></b></td>
                                <td><b><a href="<?php echo base_url();?>index.php/users/index/<?=$page_num?>/usr_lname/<?=$order?>">Nachname</a></b></td>
                                <td><b><a href="<?php echo base_url();?>index.php/users/index/<?=$page_num?>/usr_email/<?=$order?>">Email</a></b></td>
                                <td class="action"><b>Action</b></td>
                            </tr>
                            <?php 
							$i = 0;					
														
							foreach($usersdata as $val) { ?>
                               <tr class="odd">
                                    <td><?=$val["usr_id"];?></td>
                                    <td><?=$val['usr_fname']?></td>
                                    <td><?=$val['usr_lname']?></td>
                                    <td><?=$val['usr_email']?></td>
                                    
                                    <td >&nbsp;&nbsp;&nbsp;<?php echo anchor('users/edit_user/'.
                                            $val["usr_id"], '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit')); ?> 
                                                 &nbsp;&nbsp;&nbsp;
                                        <?php echo anchor('users/delete_user/'.
                                             $val["usr_id"], '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete')); ?> 
                                    </td>
                               
                               
                               </tr>
                            <?php } ?>
                                         
                        </table>
       
       
         <!-- Pagination Links-->
<br/>
<ul class="tsc_pagination pagination-sm">
 <li><div class="center-block"><?php echo $this->pagination->create_links();  ?>	</div></li> 
</ul>
 <br/><br/> 
 
       


       
       

       
       

  
 
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" >
  Launch demo modal
</button>

<!-- Modal -->
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
        <?php echo form_error('usr_email'); ?>
      <label for="usr_email"><?php echo $this->lang->line('usr_email');?></label>
      <?php echo form_input($usr_email); ?>
    </div>   
    <div class="form-group">
        <?php echo form_error('confirm_email'); ?>
      <label for="usr_confirm_email"><?php echo $this->lang->line('usr_confirm_email');?></label>
      <?php echo form_input($usr_confirm_email); ?>
    </div>   

    <div class="form-group">
        <?php echo form_error('usr_add1'); ?>
      <label for="usr_add1"><?php echo $this->lang->line('usr_add1');?></label>
      <?php echo form_input($usr_add1); ?>
    </div>  
      
          <div class="form-group">
               <?php echo form_error('usr_plz'); ?>
      <label for="usr_plz"><?php echo $this->lang->line('usr_plz');?></label>
      <?php echo form_input($usr_plz); ?>
    </div>          

    <div class="form-group">
             <?php echo form_error('usr_town_city'); ?>
      <label for="usr_town_city"><?php echo $this->lang->line('usr_town_city');?></label>
      <?php echo form_input($usr_town_city); ?>
    </div>         
   <div class="form-group">
             <?php echo form_error('usr_phone'); ?>
      <label for="usr_phone"><?php echo $this->lang->line('usr_phone');?></label>
      <?php echo form_input($usr_phone); ?>
    </div>         
    <div class="form-group">
                 <?php echo form_error('usr_access_level'); ?>
      <label for="usr_access_level"><?php echo $this->lang->line('usr_access_level');?></label>
      <?php echo form_dropdown('usr_access_level', $usr_access_level, 'large'); ?> 
    </div>  
    <div class="form-group">
                 <?php echo form_error('usr_is_active'); ?>
      <label for="usr_is_active"><?php echo $this->lang->line('usr_is_active');?></label>
      <?php echo form_dropdown('usr_is_active', $usr_is_active, 'large'); ?> 
    </div>     

    <div class="form-group">
      <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_go');?></button>     <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button> 
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
            
            
