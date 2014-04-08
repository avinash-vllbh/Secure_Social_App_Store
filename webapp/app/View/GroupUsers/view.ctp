<div class="groupUsers view">
<h2><?php echo __('Group User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Id'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['group_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Added On'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['added_on']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group User'), array('action' => 'edit', $groupUser['GroupUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group User'), array('action' => 'delete', $groupUser['GroupUser']['id']), null, __('Are you sure you want to delete # %s?', $groupUser['GroupUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
