<!--/*
 *Navigationsleiste mit den Attributen:
*Userverwaltung
*Kosten
*Kunden
*Reisen
*Tour
*Rechnung
*Logout
 */-->

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo anchor('home', $this->lang->line('system_system_name'), 'class="navbar-brand"'); ?>
        </div>
        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                <?php if ($this->session->userdata('usr_access_level') == 1) : ?>
                    <li <?php if ($this->uri->segment(1) == 'users') {
                    echo 'class="active"';
                }; ?>><?php echo anchor('users', $this->lang->line('top_nav_users')); ?></li>


                <?php else : ?>

                <?php endif; ?>

                <?php if ($this->session->userdata('usr_access_level') == 2) : ?>
                    <li <?php if ($this->uri->segment(1) == 'me') {
                        echo 'class="active"';
                    }; ?>><?php echo anchor('me', $this->lang->line('top_nav_profil')); ?></li>

<?php else : ?>

<?php endif; ?> 

                <li <?php if ($this->uri->segment(1) == 'kosten') {
    echo 'class="active"';
}; ?>><?php echo anchor('kosten', $this->lang->line('top_nav_kosten')); ?></li>
                <li <?php if ($this->uri->segment(1) == 'kunden') {
    echo 'class="active"';
}; ?>><?php echo anchor('kunden', $this->lang->line('top_nav_kunden')); ?></li>

                <li <?php if ($this->uri->segment(1) == 'reisen') {
    echo 'class="active"';
}; ?>><?php echo anchor('reisen', $this->lang->line('top_nav_reisen')); ?></li>

                <li <?php if ($this->uri->segment(1) == 'tour') {
    echo 'class="active"';
}; ?>><?php echo anchor('tour', $this->lang->line('top_nav_tour')); ?></li>


                <li <?php if ($this->uri->segment(1) == 'rechnung') {
    echo 'class="active"';
}; ?>><?php echo anchor('rechnung', $this->lang->line('top_nav_Kosten_erfassen')); ?></li>


            </ul>

            <ul class="nav navbar-nav navbar-right">
<?php if ($this->session->userdata('logged_in') == TRUE) : ?>
                    <li><?php echo anchor('signin/signout', $this->lang->line('top_nav_signout')); ?></li>
<?php else : ?>
                    <li><?php echo anchor('signin/signin', $this->lang->line('top_nav_signin')); ?></li>
<?php endif; ?>
            </ul>       
        </div>
    </div>
</div>



<div class="maintable">

    <div class="container theme-showcase" role="main">
