<div class="userApplications view">
<h2><?php echo __('User Application'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userApplication['UserApplication']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($userApplication['UserApplication']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('App Id'); ?></dt>
		<dd>
			<?php echo h($userApplication['UserApplication']['app_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Downloaded On'); ?></dt>
		<dd>
			<?php echo h($userApplication['UserApplication']['downloaded_on']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Application'), array('action' => 'edit', $userApplication['UserApplication']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Application'), array('action' => 'delete', $userApplication['UserApplication']['id']), null, __('Are you sure you want to delete # %s?', $userApplication['UserApplication']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Applications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Application'), array('action' => 'add')); ?> </li>
	</ul>
</div>
