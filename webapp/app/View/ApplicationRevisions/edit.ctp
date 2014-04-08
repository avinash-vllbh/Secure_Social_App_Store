<div class="applicationRevisions form">
<?php echo $this->Form->create('ApplicationRevision'); ?>
	<fieldset>
		<legend><?php echo __('Edit Application Revision'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('app_id');
		echo $this->Form->input('revision_number');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ApplicationRevision.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ApplicationRevision.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Application Revisions'), array('action' => 'index')); ?></li>
	</ul>
</div>
