<div class="userFriends view">
<h2><?php echo __('User Friend'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Friend User Id'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['friend_user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Friend'), array('action' => 'edit', $userFriend['UserFriend']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Friend'), array('action' => 'delete', $userFriend['UserFriend']['id']), null, __('Are you sure you want to delete # %s?', $userFriend['UserFriend']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Friends'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Friend'), array('action' => 'add')); ?> </li>
	</ul>
</div>
