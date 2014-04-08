<?php //pr($application); ?>
<div class="applications view">
<h2><?php echo __('Application'); ?></h2>
	<dl class="dl-horizontal">
		<!-- <dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($application['Application']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($application['Application']['user_id']); ?>
			&nbsp;
		</dd> -->
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($application['Application']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Developer'); ?></dt>
		<dd>
			<?php echo $application['User']['first_name']." ".$application['User']['last_name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo $application['Application']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo $application['ApplicationRevision'][0]['size']." "."KB"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Of Users Rated'); ?></dt>
		<dd>
			<?php echo h($application['Application']['count_rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
		<dd>
			<?php echo h($application['Application']['rating']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if($application['User']['id'] == $this->Session->read('User.id')) { ?>
		<li><?php echo $this->Html->link(__('Edit Application'), array('action' => 'edit', $application['Application']['id']), array('type'=>'button', 'class'=>'btn btn-warning')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Application'), array('action' => 'delete', $application['Application']['id']), null, __('Are you sure you want to delete # %s?', $application['Application']['id'])); ?> </li>
		<?php } ?>
		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('action' => 'add')); ?> </li>
	</ul>
</div>
