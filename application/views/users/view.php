<div class="ui one column relaxed grid" style="margin-top: 3%;">
    <div class="column">
        <div class="ui fluid form segment">
            <div class="two fields">
                <div class="field">
                    <h4 class="ui header">Enter New Bug</h4>
                    <?php
                        echo $bug->render_form(
                            array('title', 'description'),
                            $url,
                            array('save_button' => 'Save New Bug', 'reset_button' => 'Reset')
                        );
                    ?>
                </div>
                <div class="field">
                    <h4 class="ui header">Previous Bugs</h4>
                    <?php $this->load->view('bugs/view', array('bugs' => $bugs)); ?>
                </div>
            </div>
        </div>
    </div>
</div>