

<!--/*
 * Bestätigungsseite für den Admin. Wird aufgerufen, wenn der Admin einen der
 * view_all_users-View einen User löscht. Sie fragt ob der Admin den User
 * wirklich löschen will.
 */-->


<h2><?php echo $page_heading ; ?></h2>
<p class="lead"><?php echo $this->lang->line('delete_confirm_message');?></p>
<?php echo form_open('users/delete_user'); ?>
    <?php if (validation_errors()) : ?>
        <h3>Ups! Ein Fehler ist aufgetreten:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo $row->usr_fname . ' ' . $row->usr_lname; ?>
        <br /><br />
        <?php echo form_submit('submit', $this->lang->line('common_form_elements_action_delete'), 'class="btn btn-primary"'); ?>
        <button class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>index.php/users';return false;"><?php echo $this->lang->line('common_form_elements_cancel');?></button>
        <?php echo form_hidden('id', $row->usr_id); ?>
    <?php endforeach; ?>
<?php echo form_close() ; ?>
