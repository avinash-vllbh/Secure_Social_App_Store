<div class="col-md-5">
	<div class="applications form">
	<?php $options = array('div' => array('class' => 'form-group'), 'class'=>'form-control'); ?>
	<?php echo $this->Form->create('Application', array('enctype' => 'multipart/form-data')); ?>
		<fieldset>
			<legend><?php echo __('Add New Application'); ?></legend>
		<?php
			echo $this->Form->input('title', $options);
			echo $this->Form->input('description', $options);
			echo $this->Form->input('file', array("type" => 'file')); ?>
			<br>
		<?php echo $this->Form->submit('Save', array('type' => 'button', 'div'=>false, 'class'=>'btn btn-success', 'onclick'=>'submit();'));

		?>
		</fieldset>
	<?php echo $this->Form->end(); ?>
	</div>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?></li>
	</ul>
</div> -->
