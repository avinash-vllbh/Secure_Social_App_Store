<div class="col-md-8">
	<!-- <form role="form"> -->
	<?php $options = array('div' => array('class' => 'form-group'), 'class'=>'form-control'); ?>
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Add User'); ?></legend>
					<?php
						echo $this->Form->input('first_name', $options);
						echo $this->Form->input('last_name', $options);
						echo $this->Form->input('email', $options);
						echo $this->Form->input('password', $options, array('autocomplete' => 'off'));
						echo $this->Form->input('password_confirmation', $options, array('type' => 'password', 'autocomplete' => 'off'));
						echo $this->Form->input('phone',$options,array('between' => 
				             "<div class='annotation'>xxx-xxx-xxxx</div>"));
						echo $this->Form->submit('Register', array('div' => false, 'type'=>'button', 'class'=>'btn btn-warning', 'onclick'=>'submit();'));
					?>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	<!-- </form> -->
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div> -->
