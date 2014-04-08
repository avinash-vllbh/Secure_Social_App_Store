
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend>Login</legend>
		<?php
		echo $this->Form->input('email', array( 'placeholder' => 'Email-id..', 'size' => '30', 'required' => true, 'div' => array('class' => 'required')));
		echo $this->Form->input('password', array('placeholder' => 'enter your password...', 'autocomplete' =>"off", 'size' => '30', 'required' => true, 'div' => array('class' => 'required')));
		?><div>
		<?php 
		echo $this->Form->submit('Login', array('div' => false, 'type'=>'button', 'class'=>'btn btn-success', 'onclick'=>'submit();'));
		echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'add'), array('type' => 'button', 'class'=>'btn btn-warning btn-login'));
		?></div>
		<?php
		echo $this->Form->end();?>
	</fieldset>