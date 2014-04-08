<div class="applicationRevisions view">
<h2><?php echo __('Application Revision'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($applicationRevision['ApplicationRevision']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('App Id'); ?></dt>
		<dd>
			<?php echo h($applicationRevision['ApplicationRevision']['app_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Revision Number'); ?></dt>
		<dd>
			<?php echo h($applicationRevision['ApplicationRevision']['revision_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($applicationRevision['ApplicationRevision']['path']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Application Revision'), array('action' => 'edit', $applicationRevision['ApplicationRevision']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Application Revision'), array('action' => 'delete', $applicationRevision['ApplicationRevision']['id']), null, __('Are you sure you want to delete # %s?', $applicationRevision['ApplicationRevision']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Application Revisions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application Revision'), array('action' => 'add')); ?> </li>
	</ul>
</div>
