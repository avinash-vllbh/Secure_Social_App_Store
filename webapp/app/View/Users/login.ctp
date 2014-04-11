<div class="col-md-6">
	<?php $options = array('div' => array('class' => 'form-group'), 'class'=>'form-control'); ?>
	<?php echo $this->Form->create('User');?>
		<fieldset>
			<legend>Login</legend>
			<?php
			echo $this->Form->input('email', $options, array( 'placeholder' => 'Email-id..', 'required' => true, 'div' => array('class' => 'required')));
			echo $this->Form->input('password', $options, array('placeholder' => 'enter your password...', 'autocomplete' =>"off", 'required' => true, 'div' => array('class' => 'required')));
			echo $this->Html->link('Forgot password?', array('controller' => 'users', 'action' => 'forgot_password'), array());
			?><div>
			<?php 
			echo $this->Form->submit('Login', array('div' => false, 'type'=>'button', 'class'=>'btn btn-success', 'onclick'=>'submit();'));
			echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'add'), array('type' => 'button', 'class'=>'btn btn-warning btn-login'));
			?></div>
		</fieldset>
		<?php echo $this->Form->end();?>
</div>