


<!--/*
 * Zeigt Formular um die ausgewählte Reise zu löschen.
 */-->


<h2><?php echo $page_heading ; ?></h2>
<p class="lead"><?php echo $this->lang->line('delete_confirm_message');?></p>
<?php echo form_open('reisen/delete_reise'); ?>
    <?php if (validation_errors()) : ?>
        <h3>Ups! Ein Fehler ist aufgetreten:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo $row->reiseort; ?>
        <br /><br />
        <?php echo form_submit('submit', $this->lang->line('common_form_elements_action_delete'), 'class="btn btn-primary"'); ?>
        <?php echo anchor('reisen',$this->lang->line('common_form_elements_cancel'), 'class="btn btn-primary"');?>
        <?php echo form_hidden('id', $row->reiseort_id); ?>
    <?php endforeach; ?>
<?php echo form_close() ; ?>
