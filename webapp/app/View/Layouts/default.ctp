<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>Secure Social App Store</title>
<?php
echo $this->Html->meta('icon');

// echo $this->Html->css('cake.generic');
echo $this->Html->css('bootstrap');
echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('style');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<?php echo $this->Html->script('bootstrap.min.js') ?>
</head>
<body>
	<div class="container wrapper">
			<div class="container-fluid" id="header">
				<?php if($this->Session->check('User.id') && $this->Session->read('User.role') == "admin" ) { ?>
				<div class="row">
					<nav class="navbar navbar-inverse" role="navigation">
						<div class="container">
							<div class="navbar-inner">
								<ul class="nav navbar-nav">
									<li><a class="navbar-brand" href="#">Admin Panel</a></li>
									<li><?php echo $this->Html->link('Users', array('controller' => 'admin', 'action' => 'index')); ?></li>
				         			<li><?php echo $this->Html->link('Applications', array('controller' => 'admin', 'action' => 'index')); ?></li>
				         			<li><?php echo $this->Html->link('Notification', array('controller' => 'admin', 'action' => 'index')); ?></li>
				         		</ul>
				        	</div>
			        	</div>
			        </nav>
				</div>
				<?php } ?>
					<div class = "row">
						<div class = "col-md-9">
						<?php echo $this->Html->image('ss_logo.png', array("alt" => "Secure Social",
				 														'url' => array('controller' => 'sites', 'action'=>'index'))); ?>
						</div>
						<div class = "col-md-3 text-center">
							<br></br>
							<?php
								if($this->Session->check('User.id')) {
									echo "welcome, ";
									echo $this->Html->link($this->Session->read('User.first_name'), array('controller' => 'users', 'action' => 'view', $this->Session->read('User.id'))); ?>
									|
									<?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'), array('type'=>'button', 'class' => 'btn btn-primary'));
								} else {
									echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'));
								}
							 ?>
						</div>
					</div>
			</div>
		<?php 
		function echoActiveClassIfRequestMatches($requestUri)
		{
		    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		    if ($current_file_name == $requestUri)
		        echo 'class="active"';
		}
		?>
		<br></br>
		<div id="container">
			<div class="row-fluid">
				<!-- <div class="container-fluid"> -->
					<nav class="navbar navbar-inverse">
						<ul class="nav navbar-nav" id="main-nav">
							<li <?=echoActiveClassIfRequestMatches("users")?>><?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); ?></li>
		         			<li <?=echoActiveClassIfRequestMatches("applications")?>><?php echo $this->Html->link('Applications', array('controller' => 'applications', 'action' => 'index')); ?></li>
		         
		            	</ul>
		            </nav>
				<!-- </div> -->
			</div>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		
		<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div class="footer">
		&#64;2014 Arizona State University
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
<script type="text/javascript">
$(document).ready(function() {
$('#main-nav li').on('click', function() {
    $(this).parent().parent().find('.active').removeClass('active');
    $(this).parent().addClass('active').css('font-weight', 'bold');
});
});
</script>
</html>
