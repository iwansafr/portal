<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Atur Jadwal Mapel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../library/css/bootstrap.min.css" rel="stylesheet">
	<script src="../library/js/jquery.min.js"></script>
	<script src="../library/js/bootstrap.min.js"></script>
	<script src="../library/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../library/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
	<?php
	if(!empty($_SESSION['user']))
	{
		include_once '../classes/database.php';
		include_once '../classes/mapel.php';
		include_once '../classes/kelas.php';
		include_once '../initial.php';
		?>
		<div class="container">
			<div class="row">
				<?php include 'menu.php';
				if(!empty($_GET['kata']))
				{
					$mapel = new mapel($db);
					$kelas = new kelas($db);
					$data = $mapel->search_mapel($_GET['kata']);
					$data_kelas = $kelas->getAll(TRUE);
				}
				?>
				<div class="row">
					<div class="col-md-3">
						<form action="" method="get">
							<div class="form-group">
								<input type="text" name="kata" placeholder="cari" class="form-control">
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel panel-heading">
								data mapel
							</div>
							<div class="panel panel-body">
								<?php echo @$msg; ?>
								<div class="table-responsive">
									<table id="mapel" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>TITLE</th>
										<th>kode</th>
										<th>link</th>
										<th>kelas</th>
										<th>tanggal</th>
										<th>mulai</th>
										<th>selesai</th>
										<th>action</th>
									</tr>
									</thead>
									<tbody>
											<?php 
											if(!empty($data))
											{
												foreach ($data as $key => $value) 
												{
													?>
													<tr>
														<td><?php echo $value['title'] ?></td>
														<td><?php echo $value['kode'] ?></td>
														<td><a href="<?php echo $value['link'] ?>"><?php echo $value['link'] ?></a></td>
														<td><?php echo $data_kelas[$value['kelas_id']] ?></td>
														<td><?php echo $value['date'] ?></td>
														<td><?php echo $value['start'] ?></td>
														<td><?php echo $value['end'] ?></td>
														<td><a href="mapel.php?hapus=<?php echo $value['id']?>" title="">hapus</a> | <a href="mapel.php?edit=<?php echo $value['id']?>" title="">Ubah</a></td>
													</tr>
													<?php		
												} 
											}
											?>
									</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}else{
		header('location: login.php');
	}?>
</body>
</html>