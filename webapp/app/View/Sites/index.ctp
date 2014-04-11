
<?php //pr($applications); ?>
<div class = "row-fluid">
	<div class = "col-md-8">
		<h3>Feautured App's</h3>
		<table class="table table-striped" cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo "Title"; ?></th>
			<th><?php echo "Description"; ?></th>
			<th><?php echo "Rating"; ?></th>
		</tr>
		<?php
			$count = 1; 
			$app_rating = array();
		?>
		<?php foreach ($applications as $application): ?>
			<tr>
				<td><?php echo $this->Html->link($application['Application']['title'], array('controller'=>'applications', 'action'=>'view', $application['Application']['id'])); ?>&nbsp;</td>
				<td><?php echo h($application['Application']['description']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link(null, array(), array('id' => 'rating'.$count));
							array_push($app_rating, $application['Application']['rating']);  ?>&nbsp;</td>

			</tr>
			<?php $count = $count+1; ?>
		<?php endforeach; ?>
		</table>
	</div>
	<?php 
	if($this->Session->read('User.id') == NULL) { ?>
	<div class = "col-md-4">
		<?php $options = array('div' => array('class' => 'form-group'), 'class'=>'form-control'); ?>
		<?php echo $this->Form->create('User', array('url' =>array('controller' => 'users', 'action' => 'login')));?>
		<fieldset>
			<legend>Login</legend>
			<?php
			echo $this->Form->input('email', $options, array( 'placeholder' => 'Email-id..', 'size' => '30', 'required' => true, 'div' => array('class' => 'required')));
			echo $this->Form->input('password', $options, array('placeholder' => 'enter your password...', 'autocomplete' =>"off", 'size' => '30', 'required' => true, 'div' => array('class' => 'required')));
			echo $this->Html->link('Forgot password?', array('controller' => 'users', 'action' => 'forgot_password'), array());
			?><div>
			<?php 

			echo $this->Form->submit('Login', array('div' => false, 'type'=>'button', 'class'=>'btn btn-success', 'onclick'=>'submit();'));
			echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'add'), array('type' => 'button', 'class'=>'btn btn-warning'));
			?></div>
			<?php
			echo $this->Form->end();?>
		</fieldset>
	</div>
	<?php } ?>
</div>

<?php echo $this->Html->script('jquery.raty.js')?>
<script type="text/javascript">
var app_ratings = new Array();
<?php foreach($app_rating as $rating): ?>
	app_ratings.push('<?php echo $rating; ?>');
<?php endforeach; ?>
 for(var i=1;i<"<?php echo $count; ?>";i++) {
	var id = '#rating'+i;
	$(id).raty({
		score: 3.7,//app_ratings[i-1],
		path: 'img'
	});
 }
</script>