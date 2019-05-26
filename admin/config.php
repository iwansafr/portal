<?php session_start();?>
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
			$msg = $conf->save('main');
			$options = $conf->get_options();
			$data = $conf->get_config('main');
			?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						Configuration
					</div>
					<div class="panel-body panel">
						<?php if (!empty($msg['status'])): ?>
							<?php echo $msg['msg'] ?>
						<?php endif ?>
						<form action="" method="post">
							<div class="form-group">
								<label for="judul">judul</label>
								<select class="form-control" name="judul">
									<?php if (!empty($options)): ?>
										<?php foreach ($options as $key): ?>
											<option value="<?php echo $key['id'].'_'.$key['title'] ?>"><?php echo $key['title'] ?></option>
										<?php endforeach ?>			
									<?php endif ?>
								</select>
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