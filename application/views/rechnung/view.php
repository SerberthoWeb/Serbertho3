

<!--/*
 * Zeigt die Hauptansicht der Rechnungen von der Navigation her.
 */-->
<h1><?php echo $page_heading; ?></h1>

<div class="page-header">

    <?php echo form_open('rechnung/past'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('rechnung_view_search_tour'); ?>">
                <span class="input-group-btn" style="float: left;">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </span>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

</div>

<table class="table table-hover">
    <?php foreach ($query->result() as $row) : ?>
        <tr>
            <td><?php echo $row->tour_title; ?><br />
            </td>
            <td>Abfahrt: <?php echo $row->reiseabfahrt; ?><br />
            </td>
            <td>Rückankunft: <?php echo $row->reiseankunft; ?><br />
            </td>
            <td>&nbsp;<?php echo anchor('rechnung/apply/' .
            $row->tour_id, '<span class="glyphicon glyphicon-zoom-in"></span>', $this->lang->line('rechnung_view_apply'));
        ?> </button>
                &nbsp;&nbsp;

            </td>                  
        </tr>
<?php endforeach; ?>
</table>
<br/>
<button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url(); ?>index.php/rechnung/past';
        return false;"><?php echo $this->lang->line('past_reisen'); ?></button><br/>       
<br/>
