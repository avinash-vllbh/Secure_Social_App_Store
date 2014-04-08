<div class="groupUsers index">
	<h2><?php echo __('Group Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('added_on'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($groupUsers as $groupUser): ?>
	<tr>
		<td><?php echo h($groupUser['GroupUser']['id']); ?>&nbsp;</td>
		<td><?php echo h($groupUser['GroupUser']['group_id']); ?>&nbsp;</td>
		<td><?php echo h($groupUser['GroupUser']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($groupUser['GroupUser']['role']); ?>&nbsp;</td>
		<td><?php echo h($groupUser['GroupUser']['status']); ?>&nbsp;</td>
		<td><?php echo h($groupUser['GroupUser']['added_on']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $groupUser['GroupUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $groupUser['GroupUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $groupUser['GroupUser']['id']), null, __('Are you sure you want to delete # %s?', $groupUser['GroupUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Group User'), array('action' => 'add')); ?></li>
	</ul>
</div>
