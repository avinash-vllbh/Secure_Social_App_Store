<?php //pr($result); ?>
<div class="row-fluid">
	<div class="span3">
		<ul>
			<li><h4><?php echo $this->Html->link('My Profile', array('action' => 'view', $result['User']['id'])); ?></h4></li>
			<!-- <li><h4>My Applications</h4></li> -->
		</ul>
	</div>
	<div class="span8">
		<h4> Your Applications </h4>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo "Title"; ?></th>
			<th><?php echo "Description"; ?></th>
			<th><?php echo "Rating"; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($result['Application'] as $application): ?>
	<tr>
		<td><?php echo $this->Html->link($application['title'], array('controller' =>'applications', 'action' => 'download_app', $application['id'])); ?>&nbsp;</td>
		<td><?php echo h($application['description']); ?>&nbsp;</td>
		<td><?php echo h($application['rating']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller' =>'applications', 'action' => 'edit', $application['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller' =>'applications', 'action' => 'delete', $application['id']), null, __('Are you sure you want to delete # %s?', $application['title'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
		<br></br>
		<h5>Click below to upload a new application<h5>
			<?php echo $this->Html->link('New Application', array('controller' => 'applications', 'action' => 'add'), array('type'=>'button', 'class'=>'btn btn-success'));
			?>

	</div>
</div>












<!-- <div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login_time'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_login']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
	</ul>
</div>
 -->