<!--/*
 *Dieses Formular dient zur Übersicht aller Kunden. Ist die Anlaufstelle von der Navigation her.
 */-->

<h2><?php echo $page_heading; ?></h2> 

<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/kunden/new_kunde';
        return false;"><?php echo $this->lang->line('common_form_elements_new_kunde'); ?></button>         
<button class="btn btn-primary"  onClick="window.location.href = '<?php echo base_url(); ?>index.php/makepdf/kunden';
        return false;"><?php echo $this->lang->line('common_form_elements_make_pdf'); ?></button>


<div class="page-header">

    <?php echo form_open('kunden/index'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kunden_view_search'); ?>">
                <span class="input-group-btn" style="float: left;">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

</div>

<!--/*
 * Listet alle Kunden die im System sind.
 */-->

<table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr class="info">
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/kunde_id/' . $order['kunde_id'] . '/0') ?>">ID</a></th> 
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/fname/' . $order['fname'] . '/0') ?>">Vorname</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/lname/' . $order['lname'] . '/0') ?>">Nachname</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/strasse/' . $order['strasse'] . '/0') ?>">Strasse</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/plz/' . $order['plz'] . '/0') ?>">PLZ</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/ort/' . $order['ort'] . '/0') ?>">Ort</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/telnr/' . $order['telnr'] . '/0') ?>">Telefonnummer</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/email/' . $order['email'] . '/0') ?>">Email</a></th>
            <th><a href="<?= site_url('/kunden/index/' . $per_page . '/tour_id/' . $order['tour_id'] . '/0') ?>">Reise</a></th>
            <th>Aktion</th>                     
        </tr>
    </thead>	
    <tbody>
        <?php if ($query->num_rows() > 0) : ?>
            <?php foreach ($query->result() as $row) : ?>
                <tr>
                    <td><?php echo $row->kunde_id; ?></td>
                    <td><?php echo $row->fname; ?></td>
                    <td><?php echo $row->lname; ?></td>
                    <td><?php echo $row->strasse; ?></td>
                    <td><?php echo $row->plz; ?></td>
                    <td><?php echo $row->ort; ?></td>
                    <td><?php echo $row->telnr; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->tour_title; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;<?php
                        echo anchor('kunden/edit_kunde/' .
                                $row->kunde_id, '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit'));
                        ?> </button>
                        &nbsp;&nbsp;&nbsp;
                        <?php
                        echo anchor('kunden/delete_kunde/' .
                                $row->kunde_id, '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete'));
                        ?> </button> 

                                <!--//'<button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'-->

                    </td>
                </tr>	        
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="12" class="info">Keine Kunden hier!</td>
            </tr>			
        <?php endif; ?>
    <div class="form-group">



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
            <a href="<?php echo base_url(); ?>index.php/kunden/index/5"  class="pPage" data-tableid="smpl_tbl">
                5 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/kunden/index/10"  class="pPage" data-tableid="smpl_tbl">
                10 Einträge pro Seite
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/kunden/index/25"  class="pPage" data-tableid="smpl_tbl">
                25 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/kunden/index/9999" id="all" class="pPage" data-tableid="smpl_tbl">
                Alle Einträge
            </a>
        </li>
    </ul>
</div>

<!-- Paginationsanzeige -->

<ul class="tsc_pagination pagination-sm">
    <li><div class="center-block"><?php echo $this->pagination->create_links(); ?></div></li> 
</ul>
