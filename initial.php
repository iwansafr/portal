<?php
$database = new Database();
$db = $database->getConnection();

function pr($data = array())
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function msg($msg = 'alert', $alert = 'default')
{
	?>
	<div class="alert alert-<?php echo $alert; ?>">
	  <strong><?php echo $alert; ?>!</strong> <?php echo $msg; ?>.
	</div>
	<?php
}