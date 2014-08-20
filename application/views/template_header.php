<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <title>Bug Tracker</title>
        <link type='text/css' rel='stylesheet' href= '<?php echo asset_url(); ?>css/semantic.css'/>
        <link type='text/css' rel='stylesheet' href = '<?php echo asset_url(); ?>css/main.css'/>
        <script language='javascript' src = '<?php echo asset_url(); ?>javascript/semantic.js'></script>
    </head>
    <body>
    <nav class="ui fixed top transparent inverted main menu">
        <div class="container">
            <?php if($this->session->userdata('session_user_id') != NULL):?>
                <a href="<?php echo site_url('users/show')?>"><h3 class="ui header left floated item blue">Bug Tracking System</h3></a>
            <?php else: ?>
                <a href="<?php echo site_url('users')?>"><h3 class="ui header left floated item blue">Bug Tracking System</h3></a>
            <?php endif; ?>

            <?php if($this->session->userdata('session_user_id') != NULL){?>
                <span class="ui icon input right floated item small">
                Welcome: <?php echo $this->session->userdata('session_user_name'); ?> |
                <a href="<?php echo site_url('users/logout');?>" class="linked"><i class="sign out icon" title="Log Out"></i></a>
        </span>
            <?php } ?>
        </div>
    </nav>