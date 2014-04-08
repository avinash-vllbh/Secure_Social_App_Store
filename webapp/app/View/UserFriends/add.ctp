<div class="userFriends form">
<?php echo $this->Form->create('UserFriend'); ?>
	<fieldset>
		<legend><?php echo __('Add User Friend'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('friend_user_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Friends'), array('action' => 'index')); ?></li>
	</ul>
</div>
