<?php
	if( ! isset($save_button))
	{
		$save_button = 'Save';
	}
	if( ! isset($reset_button))
	{
		$reset_button = FALSE;
	}
	else
	{
		if($reset_button === TRUE)
		{
			$reset_button = 'Reset';
		}
	}
?>
<?php if( ! empty($object->error->all)): ?>
<div class="ui error message">
	<div class="header">ERROR</div>
	<ul><?php foreach($object->error->all as $k => $err): ?>
		<li><?php echo $err; ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('message') != ''){ ?>
    <?php if($this->session->flashdata('color_code') == "blue"):?>
        <div class="ui visible blue message small">
            <div class="header">NOTICE</div>
    <?php elseif($this->session->flashdata('color_code') == "green"): ?>
        <div class="ui visible success message small">
            <div class="header">SUCCESS</div>
    <?php else: ?>
        <div class="ui visible error message small">
            <div class="header">ERROR</div>
    <?php endif; ?>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
<?php } ?>

<form action="<?php echo $url; ?>" method="post">
    <div class="ui form segment">
    <?php echo $rows; ?>
	<input type="submit" name="submit" class="ui blue submit button small" value="<?php echo $save_button; ?>" /><?php
			if($reset_button !== FALSE)
			{
				?> <input type="reset" class="ui red submit button small" value="<?php echo $reset_button; ?>" /><?php
			}
		?>
    </div>
</form>
