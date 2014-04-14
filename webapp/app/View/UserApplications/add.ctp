<div class="userApplications form">
<?php echo $this->Form->create('UserApplication'); ?>
	<fieldset>
		<legend><?php echo __('Add User Application'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('app_id');
		echo $this->Form->input('downloaded_on');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Applications'), array('action' => 'index')); ?></li>
	</ul>
</div>
