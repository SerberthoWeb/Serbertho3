<!--
/*
 * Erlaubt dem User oder Admin sich anzumelden mit dem Username und Passwort.
 * Das Passwort ist nicht gespeichert in der User-Tabelle der Datenbank. Nur der Hashwert 
 * des Passworts ist gespeichert. Um den Hash zu supporten wird im config File von Codeigniter 
 * der encryption key ein Passwort eingetragen.
 */-->


<?php if (isset($login_fail)) : ?>
  <div class="alert alert-danger"><?php echo $this->lang->line('admin_login_error') ; ?></div>
<?php endif ; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open('signin/index', 'class="form-signin" role="form"') ; ?>
    <h2 class="form-signin-heading" style="font-weight: bold"><?php echo $this->lang->line('admin_login_header') ; ?></h2>
    <input type="email" name="usr_email" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_email') ; ?>" required autofocus>
    <input type="password" name="usr_password" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_password') ; ?>" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('admin_login_signin') ; ?></button>
    <br />
    <?php echo anchor('password',$this->lang->line('signin_forgot_password')); ?>
  <?php echo form_close() ; ?>
</div>
