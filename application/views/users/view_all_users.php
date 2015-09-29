
<!-- Haupttitelanzeige -->
<h2><?php echo $page_heading; ?></h2>

<!-- Tabelle wird generiert durch Bootstrap -->
<table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr class="info">
            <th><a href="<?= site_url('/users/index/' . $per_page . '/usr_id/' . $order['usr_id'] . '/0') ?>">ID</a></th>
            <th><a href="<?= site_url('/users/index/' . $per_page . '/usr_lname/' . $order['usr_lname']  . '/0') ?>">Name</a></th>
            <th><a href="<?= site_url('/users/index/' . $per_page . '/usr_fname/' . $order['usr_fname']  . '/0') ?>">Vorname</a></th>
            <th><a href="<?= site_url('/users/index/' . $per_page . '/usr_email/' . $order['usr_email']  . '/0') ?>">Email</a></th>
            <th>Aktion</th>                     
        </tr>
    </thead>	
    <tbody>
        <?php if ($query->num_rows() > 0) : ?>
            <?php foreach ($query->result() as $row) : ?>
                <tr>
                    <td><?php echo $row->usr_id; ?></td>
                    <td><?php echo $row->usr_lname; ?></td>
                    <td><?php echo $row->usr_fname; ?></td>
                    <td><?php echo $row->usr_email; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo anchor('users/edit_user/' .
                $row->usr_id, '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit'));
                ?> </button>
                        &nbsp;&nbsp;&nbsp;
                        <?php echo anchor('users/delete_user/' .
                                $row->usr_id, '<span class="glyphicon glyphicon-remove"data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete'));
                        ?> </button> 
                    </td>
                </tr>	        
    <?php endforeach; ?>
<?php else : ?>
            <tr>
                <td colspan="12" class="info">Keine User hier!</td>
            </tr>			
<?php endif; ?>
            
    <div class="form-group">
        <a href="<?php echo base_url() . 'index.php/users/new_user';?>"><button class="btn btn-primary"><?php echo $this->lang->line('common_form_elements_new_user'); ?></button></a>       
        <button class="btn btn-primary" style="float: left;" onClick="window.location.href = '<?php echo base_url(); ?>index.php/makepdf/tour';
             return false;"><?php echo $this->lang->line('common_form_elements_make_pdf'); ?></button>
    </div>
    
</tbody>
</table>



<!-- Anzeige der Einträge, die gerade angezeigt werden, im Verhältnis zu allen Einträgen. -->

<div style="margin-left: 82%;"><?php echo 'Einträge ' . ($offset + 1) . ' bis ' . (($offset + $per_page) <= $total_rows ? ($offset + $per_page) : $total_rows) . ' von ' . $total_rows ?></div>


<!-- Dropdown-Menue zur Auswahl wieviele Einträge angezeigt werden sollen -->

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Anzahl Einträge
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/users/index/5"  class="pPage" data-tableid="smpl_tbl">
                5 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/users/index/10"  class="pPage" data-tableid="smpl_tbl">
                10 Einträge pro Seite
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/users/index/25"  class="pPage" data-tableid="smpl_tbl">
                25 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/users/index/9999" id="all" class="pPage" data-tableid="smpl_tbl">
                Alle Einträge
            </a>
        </li>
    </ul>
</div>

<!-- Paginationsanzeige -->

<ul class="tsc_pagination pagination-sm">
    <li><div class="center-block"><?php echo $this->pagination->create_links(); ?></div></li> 
</ul>
