<div class="applications form">
<?php echo $this->Form->create('Application', array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add New Application'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('file',    array("type" => 'file'));
		echo $this->Form->submit('Save', array('type' => 'button', 'div'=>false, 'class'=>'btn btn-success', 'onclick'=>'submit();'));

	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?></li>
	</ul>
</div> -->
