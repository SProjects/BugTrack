<div class="ui three column relaxed grid" style="margin-top: 3%;">
    <div class="column"></div>
    <div class="column">
        <div class="ui fluid form segment">
            <h4 class="ui header">Sign In</h4>
            <?php
                echo $user->render_form(
                    $form_fields,
                    $url,
                    array('save_button' => 'Log In',)
                );
            ?>
        </div>
    </div>
    <div class="column"></div>
</div>