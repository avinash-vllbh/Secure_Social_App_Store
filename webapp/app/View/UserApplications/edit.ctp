<div class="userApplications form">
<?php echo $this->Form->create('UserApplication'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Application'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserApplication.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserApplication.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Applications'), array('action' => 'index')); ?></li>
	</ul>
</div>
