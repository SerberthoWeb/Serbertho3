
<!--/*
 *Dieses Formular dient zur Übersicht aller Kosten. Ist die Anlaufstelle von der Navigation.
 */-->

<h2><?php echo $page_heading; ?></h2>
<br/>    

<!-- Buttons für Kosten erfassen, Kostenstelle erfassen und PDF erstellen-->
<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/kosten/new_kosten';
        return false;"><?php echo $this->lang->line('common_form_elements_new_kosten'); ?></button>         
<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/kosten/kostenstelle';
        return false;"><?php echo $this->lang->line('common_form_elements_kostenstelle'); ?></button>          
<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/makepdf/kosten';
        return false;"><?php echo $this->lang->line('common_form_elements_make_pdf'); ?></button>




<div>
    <!-- Suchfeld für die Kostenstelle -->
<?php echo form_open('kosten/index'); ?><br/>
    <div class="row" style="float: left; position: relative; left: 0px;">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_ks'); ?>">
                <span class="input-group-btn" style="float: left;">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

<!-- Suchfeld für den Reisenamen -->
<?php echo form_open('kosten/reisename'); ?>
    <div class="row" style="float: left; position: relative; left: 25px;">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_reisename'); ?>">
                <span class="input-group-btn" style="float: left;">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

<!-- Suchfeld für die Rechnungsnummer -->
<?php echo form_open('kosten/rechnungsnummer'); ?>
    <div class="row" style="float: left; position: relative; left: 50px;">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('kosten_view_search_rn'); ?>">
                <span class="input-group-btn" style="float: left;">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>


</div><br/><br/>



<!--/*
 * Listet alle Kosten die im System sind und erlaubt dem User zu
 * editieren und zu löschen.
 */-->

<table class="table table-hover table-bordered table-condensed">
    <thead>
        <tr class="info">
<!--          <th>#</th>-->
             <th><a href="<?= site_url('/kosten/index/' . $per_page . '/kostenstelle_name/' . $order['kostenstelle_id'] . '/0') ?>">Kostenstelle</a></th>
            <th><a href="<?= site_url('/kosten/index/' . $per_page . '/tour_title/' . $order['tour_id'] . '/0') ?>">Reisename</a></th>
            <th><a href="<?= site_url('/kosten/index/' . $per_page . '/kosten/' . $order['kosten'] . '/0') ?>">Kosten</a></th>
            <th><a href="<?= site_url('/kosten/index/' . $per_page . '/r_nummer/' . $order['r_nummer'] . '/0') ?>">Rechnungsnummer</a></th>
            <th><a href="<?= site_url('/kosten/index/' . $per_page . '/datum/' . $order['datum'] . '/0') ?>">Erfassungsdatum</a></th>
            <th>Aktion</th>    

        </tr>
    </thead>	
    <tbody>
<?php if ($query->num_rows() > 0) : ?>
    <?php foreach ($query->result() as $row) : ?>
                <tr >
        <!--        <td><?php echo $row->kosten_id; ?></td>-->
                    <td><?php echo $row->kostenstelle_name; ?></td>
                    <td><?php echo $row->tour_title; ?></td>
                    <td><?php echo $row->kosten; ?></td>
                    <td><?php echo $row->r_nummer; ?></td>
                    <td><?php echo $row->datum; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;<?php echo anchor('kosten/edit_kosten/' .
                        $row->kosten_id, '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Bearbeiten"></span>', $this->lang->line('common_form_elements_action_edit'));
        ?> </button>
                        &nbsp;&nbsp;&nbsp;
                <?php echo anchor('kosten/delete_kosten/' .
                        $row->kosten_id, '<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Löschen"></span>', $this->lang->line('common_form_elements_action_delete'));
                ?> </button> 
                    </td>
                </tr>	        
            <?php endforeach; ?>
<?php else : ?>
            <tr>
                <td colspan="5" class="info">Keine Kosten erfasst!</td>
            </tr>			
<?php endif; ?>
    <div class="form-group">


    </div>
</tbody>
</table>
</div>


<!-- Anzeige der Einträge, die gerade angezeigt werden, im Verhältnis zu allen Einträgen. -->

<div style="margin-left: 82%;"><?php echo 'Einträge ' . ($offset + 1) . ' bis ' . (($offset + $per_page) <= $total_rows ? ($offset + $per_page) : $total_rows) . ' von ' . $total_rows ?></div>


<!-- Dropdown-Menue zur Auswahl wieviele Einträge angezeigt werden sollen -->

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Anzahl Einträge
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li>
            <a href="<?php echo base_url(); ?>index.php/kosten/index/5"  class="pPage" data-tableid="smpl_tbl">
                5 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/kosten/index/10"  class="pPage" data-tableid="smpl_tbl">
                10 Einträge pro Seite
            </a>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/kosten/index/25"  class="pPage" data-tableid="smpl_tbl">
                25 Einträge pro Seite
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>index.php/kosten/index/9999" id="all" class="pPage" data-tableid="smpl_tbl">
                Alle Einträge
            </a>
        </li>
    </ul>
</div>

<!-- Paginationsanzeige -->

<ul class="tsc_pagination pagination-sm">
    <li><div class="center-block"><?php echo $this->pagination->create_links(); ?></div></li> 
</ul>
