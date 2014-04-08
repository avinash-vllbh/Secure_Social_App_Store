<div class="userFollowers form">
<?php echo $this->Form->create('UserFollower'); ?>
	<fieldset>
		<legend><?php echo __('Add User Follower'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('follower_user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Followers'), array('action' => 'index')); ?></li>
	</ul>
</div>
