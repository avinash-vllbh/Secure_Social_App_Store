<?php //pr($this->request->data); ?>
<div class="applications form">
<?php echo $this->Form->create('Application', array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Application'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('user_id', array('type' => 'hidden'));
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('revision_number', array('value' => $this->request->data['ApplicationRevision'][0]['revision_number'], 'between' => 
             "<div class='annotation'>***Change if you are uploading new files***</div>"));
		echo $this->Form->input('file',    array("type" => 'file'));
		echo $this->Form->submit('Save', array('type' => 'button', 'div'=>false, 'class'=>'btn btn-success', 'onclick'=>'submit();'));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Application.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Application.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?></li>
	</ul>
</div> -->
