<div class="page-header">
  <h1>
    <?php echo form_open('rechnung/index') ; ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
              <input type="text" style=" width: 90%; float: left;" class="form-control" name="search_string" placeholder="<?php echo $this->lang->line('jobs_view_search'); ?>">
            <span class="input-group-btn" style="float: left;">
              <button class="btn btn-default" type="submit"><?php echo $this->lang->line('jobs_view_search'); ?></button>
            </span>
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    <?php echo form_close() ; ?>
  </h1>
</div>

<table class="table table-hover">
  <?php foreach ($query->result() as $row) : ?>
  <tr>
    <td><?php echo  $row->tour_title ; ?><br />
    </td>
    <td>Reiseabfahrt: <?php echo $row->reiseabfahrt ; ?><br />Gesamtkosten &pound;
    </td>
    <td><?php echo anchor ('rechnung/apply/'.$row->tour_id, $this->lang->line('jobs_view_apply')) ; ?>
    </td>                    
  </tr>
<?php endforeach ; ?>
</table>