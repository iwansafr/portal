<?php
session_start();
if(empty($_SESSION['user']))
{
	if(!empty($_POST))
	{
		include_once 'auth.php';
	}
	?>
  <!-- <link href="../library/css/bootstrap.css" rel="stylesheet" media="screen" /> -->
  <link href="../library/css/bootstrap.min.css" rel="stylesheet">
  <script src="../library/js/bootstrap.min.js"></script>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<h2>login</h2>			
					</div>
					<div class="panel panel-body">
						<form action="" method="post">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="username">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="password">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-sm">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}else{
	header('location: index.php');
}