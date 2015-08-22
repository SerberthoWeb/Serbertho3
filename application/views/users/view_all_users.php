
    <h2><?php echo $page_heading ; ?></h2><br/>	
    <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url();?>index.php/users/new_user';return false;"><?php echo $this->lang->line('common_form_elements_new_user');?></button>         
    <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url();?>index.php/makepdf/tour';return false;"><?php echo $this->lang->line('common_form_elements_make_pdf');?></button>
       <br/><br/>
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

<br/>
<ul class="tsc_pagination pagination-sm">
 <li><div class="center-block"><?php echo $page_links; ?></div></li> 
</ul>
 <br/><br/> 
    