<?php //pr($applications); ?>
<div class="col-md-2 actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Application'), array('action' => 'add')); ?></li>
	</ul>
</div>
<div class="col-md-10 applications index">
	<h2><?php echo __('Applications'); ?></h2>
	<table class="table table-striped" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('developer'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('counts'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
			$count = 1; 
			$app_rating = array();
		?>
	<?php foreach ($applications as $application): ?>
	<tr>
		<td><?php echo $this->Html->link($application['Application']['title'], array('controller' =>'applications', 'action' => 'download_app', $application['Application']['id'])); ?></td>
		<td><?php echo h($application['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['description']); ?>&nbsp;</td>
		<td><?php echo h($application['Application']['count_rating']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link(null, array(), array('id' => 'rating'.$count));
					array_push($app_rating, $application['Application']['rating']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $application['Application']['id'])); ?>
			<?php if($application['User']['id'] == $this->Session->read('User.id')) { ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $application['Application']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $application['Application']['id']), null, __('Are you sure you want to delete # %s?', $application['Application']['id'])); ?>
			<?php } ?>
		</td>
	</tr>
	<?php $count = $count+1; ?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
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
		score: app_ratings[i-1],
		path: 'img'
	});
 }
</script>

