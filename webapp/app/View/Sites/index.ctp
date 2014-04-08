
<?php //pr($applications); ?>
<div class = "row-fluid">
	<div class = "span8">
		<h3>Feautured App's</h3>
		<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo "Title"; ?></th>
			<th><?php echo "Description"; ?></th>
			<th><?php echo "Rating"; ?></th>
		</tr>
		<?php foreach ($applications as $application): ?>
			<tr>
				<td><?php echo $this->Html->link($application['Application']['title'], array('controller'=>'applications', 'action'=>'view', $application['Application']['id'])); ?>&nbsp;</td>
				<td><?php echo h($application['Application']['description']); ?>&nbsp;</td>
				<td><?php echo h($application['Application']['rating']); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
	<?php 
	if($this->Session->read('User.id') == NULL) { ?>
	<div class = "span4">
		<?php echo $this->Form->create('User', array('url' =>array('controller' => 'users', 'action' => 'login')));?>
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
	</div>
	<?php } ?>
</div>