<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Config</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../library/css/bootstrap.min.css" rel="stylesheet">
	<script src="../library/js/jquery.min.js"></script>
	<script src="../library/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<?php
			include 'menu.php';
			include '../classes/config.php';
			include '../classes/database.php';
			include '../initial.php';

			$conf = new config($db);
			$conf->save('main');
			$data = $conf->get_config('main');
			?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						Configuration
					</div>
					<div class="panel-body panel">
						<form action="" method="post">
							<div class="form-group">
								<label for="judul">judul</label>
								<input type="text" name="judul" class="form-control" placeholder="judul" value="<?php echo @$data['judul'] ?>">
							</div>
							<div class="form-group">
								<button class="btn btn-sm btn-success">simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>