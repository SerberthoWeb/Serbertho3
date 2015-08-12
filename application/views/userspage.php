<div id="containerHolder">
			<div id="container" style="background:#FFF;">        		 
                
                  <?php 				  
				  $page_num = (int)$this->uri->segment(2);
				  if($page_num==0) $page_num=1;
				  $order_seg = $this->uri->segment(5,"asc"); // if the 5th segment not present,it will return asc. default value.
				  if($order_seg == "asc") $order = "desc"; else $order = "asc";
				  ?>                             
                <!-- // #main -->
                <div id="main" style="padding-top:5px;">  
                                	
                    <div style="float:left;"><h3>Users</h3></div><br />
                    <div style="float:left; margin-left:550px;padding-top:5px;padding-bottom:13px;">                            	
                                <?php echo form_button(array('name' =>'new','id'=>'new','value'=>'Add User','class'=>'button large blue','content'=>'Add User'),'', 'onclick="gotonewuser();"'); ?>                                
                    </div>
                    <span class="largefont"><?php echo $this->session->flashdata('status_msg'); ?></span>
                    	<table cellpadding="0" cellspacing="0">
							<tr>
                                <td><b><a href="<?php echo base_url();?>users/<?=$page_num?>/usr_id/<?=$order?>">ID</a></b></td>
                                <td><b><a href="<?php echo base_url();?>users/<?=$page_num?>/usr_fname/<?=$order?>">First Name</a></b></td>
                                <td><b><a href="<?php echo base_url();?>users/<?=$page_num?>/usr_uname/<?=$order?>">Last Name</a></b></td>
                                <td><b><a href="<?php echo base_url();?>users/<?=$page_num?>/usr_email/<?=$order?>">Email</a></b></td>
                                <td class="action"><b>Action</b></td>
                            </tr>
                            <?php 
							$i = 0;					
														
							foreach($usersdata as $val) { ?>
                               <tr class="odd">
                                    <td style="text-align:left;"><?=$val["usr_id"];?></td>
                                    <td style="text-align:left; vertical-align:middle;"><?=$val['usr_fname']?></td>
                                    <td style="text-align:left; vertical-align:middle;"><?=$val['usr_lname']?></td>
                                    <td style="text-align:left; vertical-align:middle;"><?=$val['usr_email']?></td>
                                    <td class="action"><?php echo anchor("useredit/".$val["usr_id"],"Edit",array("class"=>"edit")); ?>&nbsp;&nbsp;<?php echo anchor("userdelete/".$val["usr_id"]."/".$page_num,"Delete",array("class"=>"edit","onclick"=>"return deleteuser();")); ?></td>
                                </tr>
                            <?php } ?>
                                         
                        </table><br /><br /> 
                        <center><?php echo $page_links; ?></center>
                         <br /><br />  
                                  
                </div>
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>