<div>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email');
		echo $this->Form->input('password', array('autocomplete' => 'off'));
		echo $this->Form->input('password_confirmation', array('type' => 'password', 'autocomplete' => 'off'));
		echo $this->Form->input('phone', array('between' => 
             "<div class='annotation'>xxx-xxx-xxxx</div>"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div> -->
