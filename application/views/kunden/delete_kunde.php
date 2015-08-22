

<!--/*
 * Bestätigungsseite für den Admin. Wird aufgerufen, wenn der Admin einen der
 * view_all_users-View einen User löscht. Sie fragt ob der Admin den User
 * wirklich löschen will.
 */-->


<p class="lead"><?php echo $this->lang->line('delete_confirm_message');?></p>
<?php echo form_open('kunden/delete_kunde'); ?>
    <?php if (validation_errors()) : ?>
        <h3>Ups! Ein Fehler ist aufgetreten:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo $row->fname . ' ' . $row->lname . ', ' . $row->plz . ' ' . $row->ort ; ?>
        <br /><br />
        <?php echo form_submit('submit', $this->lang->line('common_form_elements_action_delete'), 'class="btn btn-primary"'); ?>
        <?php echo anchor('kunden',$this->lang->line('common_form_elements_cancel'), 'class="btn btn-primary"');?>
        <?php echo form_hidden('id', $row->kunde_id); ?> 
    <?php endforeach; ?>
<?php echo form_close() ; ?><br/>
