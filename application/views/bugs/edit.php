<div class="ui one column relaxed grid" style="margin-top: 1%;">
    <div class="column">
        <a href="<?php echo site_url('users/show/'); ?>" style="padding: 5px;">
            <div class="ui labeled icon button small">
                Back <i class="circle left icon"></i>
            </div>
        </a>
        <div class="ui fluid form segment">
            <h4 class="ui header">Bug Details / Edit Page</h4>
            <?php
                echo $bug->render_form(
                    $form_fields,
                    $url,
                    array('save_button' => 'Submit update', 'reset_button' => 'Reset')
                );
            ?>
        </div>
    </div>
</div>