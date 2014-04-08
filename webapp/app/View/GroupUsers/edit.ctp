<div class="groupUsers form">
<?php echo $this->Form->create('GroupUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('role');
		echo $this->Form->input('status');
		echo $this->Form->input('added_on');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GroupUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Group Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
